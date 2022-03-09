<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Udostępnij kalendarz</h1>
                </div>
                <div class="cal_set_main_view">
                    <div class="cal_set_main_view_info">
                        <a @click="select_all">Zaznacz wszystko</a>
                        <div class="pop_view_line_2"></div>
                    </div>
                    <div class="cal_set_main_view_calendars">
                        <simplebar style="width: 100%; height: 88%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                            <div class="cal_set_main_view_calendars_list">
                                <div class="calnder_set_item" v-for="item in cals" :key="item">
                                    <div class="calnder_set_item_info">
                                        <div class="main_view_bar_item_logo">
                                            <img class="avata_bar" :src='item.Image'/>
                                        </div>
                                        <a>{{item.Name}}</a>    
                                        <label  class="container">
                                            <input onclick="return false;" type="checkbox" v-bind:checked="item.Selected == 1 ? true : false">
                                            <span @click="change_select(item.ID)" class="checkmark"></span>
                                        </label>     
                                    </div>
                                </div>
                                <a v-if="cals.length == 0" style="position: absolute; text-align: center; top: 120px">Brak użytkowników z możliwością posiadania dostepu do tego kalendarza!</a>                         
                            </div>
                        </simplebar>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Anuluj</button>
                <button class="pop_view_buttons_submit" v-if="cals.length > 0" @click="sumbit" >Udostępnij</button>
            </div>
        </div>
    </div>
</template>

<script>

// lista kalendarzy (zaznaczanie check i zastosuje aby wysiewetlic z tych kalendarzy)
// towrzenie kalendarzy
// udostepnianie i edytowanie kalendarzy

import send from '../../libs/send.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';


export default {
    name: 'cal_share',
    data: function() {
        return {
            user_id: 0,
            cals: [],
            cal_id: 0,
            can_scrol: false,
            page_scroll: 1
        }
    },
    components: {
        simplebar,

    },
    methods: {
        close() {
            this.cals = []
            this.page_scroll = 1
            this.$emit('close')
        },
        refresh() {
            this.cals = []
            this.page_scroll = 1
            this.$emit('refresh')
        },
        sumbit() {
            let vm = this
            function get_selected() {
                let output = []
                vm.cals.forEach(e => {
                    if (e['Selected'] == 1) output.push(e['ID'])
                })
                return output
            }
            if (this.cals.length > 0) {
                
                let data = {cal_id : this.cal_id, ids: get_selected()}

                send.send_post_json(
                JSON.stringify(data),
                this.$root.$refs.app_view.url_path + 'api/calendars/cal_perm.php',
                function(resp) {
                    if (resp.responseText == 'OK') {
                        vm.$root.$refs.main.alert_pop(4, 'Udostępniono!' , 'Pomyślnie udostępniono dostęp do tego kalendarz!')
                        vm.refresh()
                    } else {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się udostępnić dostępu do tego kalendarz!')
                    }
                }, function() {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się udostępnić dostępu do tego kalendarz!')
                })
            }
        },
        get_data(id) {
            let vm = this
            this.cal_id = id
            function is_json(data) {
                try {
                JSON.parse(data)
                return true
                } catch (e) {
                return false
                }
            }

            function is_empty(row) {
                for(let item in row) {
                if (row[item] == null || row[item] == undefined) return false
                }
                return true
            }

            send.send_get(this.$root.$refs.app_view.url_path + 'api/calendars/perm_list.php?id=' + id + '&mode=2&page=' + this.page_scroll, 
            function(resp) {
                if (is_json(resp.responseText)) {
                    let dat = JSON.parse(resp.responseText)
                    dat.forEach(element => {
                        if (is_empty(element)) {
                            vm.cals.push({
                                ID : element['User_ID'],
                                Name : element['User_name'],
                                Image : (vm.$root.$refs.app_view.url_path.slice(-1) == '/' ? vm.$root.$refs.app_view.url_path.slice(0, -1) :  vm.$root.$refs.app_view.url_path ) + element['Image'],
                                Selected : 0,
                            })
                        } 
                    });
                    if (Object.entries(dat).length == 25) vm.can_scrol = true
                }
            }, function() {

            })
        },
        scroll_fun(e, vm=this) {
            // if (e.target.scrollHeight - e.target.scrollTop === e.target.clientHeight) console.log("scroll")
            if (vm.can_scrol && e.target.scrollHeight - e.target.scrollTop === e.target.clientHeight) {
                vm.can_scrol = false
                vm.page_scroll += 1
                vm.get_data(vm.cal_id)
            }
        },
        select_all() {
            this.cals.forEach( e=>{
                e['Selected'] = 1
            })
        },
        change_select(id) {
            // console.log(this.cals)
            this.cals.forEach(e => {
                if (e['ID'] == id) {
                    if (e['Selected'] == 1) e['Selected'] = 0
                    else e['Selected'] = 1
                    // console.log('znaleziono', e['Selected'])
                }
            })
        }
    },
    mounted: function() {
        // this.$root.$refs.cal_share_view = this
        this.$refs.scroll_cal.scrollElement.addEventListener(
            "scroll",
            this.scroll_fun
        );
    }
}
</script>

<style scoped>
    .main_view_pop {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }

    .pop_view {
        position: relative;
        width: 395px;
        height: 517px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 5px;
    }

    .pop_view_inputs {
        position: relative;
        width: 85%;
        left: 50%;
        height: 85%;
        top: 30px;
        transform: translate(-50%, 0);
        margin-top: 30px;
    }

    .pop_view_buttons {
        position: relative;
        width: 90%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .pop_view_buttons button {
        width: 150px;
        height: 40px;
        outline: none;
        /* margin-right: 20px; */
        margin-top: 20px;
        cursor: pointer;
        border: 1px solid rgb(45, 45, 45);
        border-radius: 15px;
        font-size: 17px;
    }

    .pop_view_buttons_close {
        color: rgb(45, 45, 45);
        background-color: transparent;
    }

    .pop_view_buttons_submit {
        background-color: rgb(45, 45, 45);
        color: white;
    }

    .pop_view_haeder {
        position: relative;
        display: block;
        width: 100%;
        height: 30px;
        margin-bottom: 10px;
    }

    .pop_view_haeder h1 {
        display: block;
        position: relative;
        margin: 0;
        float: left;
        line-height: 30px;
        text-align: center;
    }

    .pop_view_line {
        display: block;
        position: relative;
        width: 97%;
        height: 1px;
        left: 50%;
        transform: translate(-50%, 0);
        background-color: #ececec;
    }
    .pop_view_line_2 {
        display: block;
        position: absolute;
        width: 97%;
        height: 1px;
        left: 50%;
        transform: translate(-50%, 0);
        bottom: 0px;
        background-color: #ececec;
    }

    .cal_set_main_view {
        display: block;
        position: relative;
        margin-top: 5px;
        width: 100%;
        height: 440px;
    }

    .cal_set_main_view_calendars {
        position: relative;
        display: block;
        margin-top: 5px;
        width: 100%;
        height: 80%;
    }

    .cal_set_main_view_calendars_list {
        position: relative;
        width: 100%;
    }

    .container {
        display: block;
        position: absolute;
        /* padding-left: 35px; */
        /* margin-bottom: 12px; */
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        top: 13%;
        transform: translate(0,-50%);
        right: 40px;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }


    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
        border: 1px solid rgb(45, 45, 45);
        border-radius: 5px;

    }

    
    .container:hover input ~ .checkmark {
        background-color: #ccc;
    }

    
    .container input:checked ~ .checkmark {
        background-color: rgb(45, 45, 45);
    }

    
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }


    .container input:checked ~ .checkmark:after {
        display: block;
    }

    
    .container .checkmark:after {
        left:5px;
        top: 2px;
        width: 6px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        /* transform: translate(-50); */
    }


    .calnder_set_item {
        position: relative;
        width: 100%;
        height: 45px;
        /* cursor: pointer;
        display: flex;
        flex-direction: row;
        justify-content: space-between; */
        margin-bottom: 10px;
    }

    .calnder_set_item_info {
        position: relative;
        width: 100%;
        height: 100%;
        
    }

    .calnder_set_item_info a {
        position: relative;
        display: block;
        padding-left: 50px;
        line-height: 45px;
        /* cursor: pointer; */
    }

    .button_ca_pop {
        display: block;
        position: relative;
        background-color: rgb(45, 45, 45);
        color: white;
        outline: none;
        border: none;
        cursor: pointer;
        border-radius: 15px;
        height: 30px;
        padding: 5px 10px 5px 10px;
        float: right;
    }

    .cal_set_main_view_info {
        display: block;
        position: relative;
        width: 100%;
        height: 40px;
        margin-top: 10px;
    }

    .cal_set_main_view_info a {
        position: relative;
        display: block;
        line-height: 32px;
        /* padding-left: 30px; */
        float: left;
        cursor: pointer;
    }

    .main_view_bar_item_logo {
        position: absolute;
        width: 40px;
        height: 40px;
        border: 1px solid rgb(45, 45, 45);
        border-radius: 25px;
        /* margin-left: 10px; */
        overflow: hidden;
        top: 50%;
        transform: translate(0 ,-50%);
    }

    .main_view_bar_item_logo img {
        background-color: #d0d0d0;
        position: absolute;
        display: block;
        width: 100%;
        height: auto;

    }

</style>