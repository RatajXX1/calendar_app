<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Kalendarze</h1>
                </div>
                <div class="cal_set_main_view">
                    <div class="cal_set_main_view_info">
                        <a @click="select_all">Zaznacz wszystko</a>
                        <button @click="open_cal_add" class="button_ca_pop">Stwórz nowy kalendarz</button>
                        <div class="pop_view_line_2"></div>
                    </div>
                    <div class="cal_set_main_view_calendars">
                        <simplebar style="width: 100%; height: 88%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                            <div class="cal_set_main_view_calendars_list">
                                <div class="calnder_set_item" v-for="item in cals" :key="item">
                                    <div class="calnder_set_item_info">
                                        <a @click="open_cal_inf(item.ID)">{{item.Name}}</a>    
                                        <label  class="container">
                                            <input onclick="return false;" type="checkbox" v-bind:checked="item.Selected == 1 ? true : false">
                                            <span @click="change_select(item.ID)" class="checkmark"></span>
                                        </label>     
                                    </div>
                                    <div class="calnder_set_item_buttons">
                                        <span v-if="item.Owner == user_id" @click="open_cal_edit(item.ID)">Edytuj</span>
                                        <span @click="open_cal_share(item.ID)">Udostępnij</span>
                                    </div>
                                </div>                                
                            </div>
                        </simplebar>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Zamknij</button>
                <button class="pop_view_buttons_submit" @click="sumbit" >Wyświetl</button>
            </div>
        </div>
        <show_cal @close="open_cal_inf" v-show="cal_info"/>
        <cal_add @close="open_cal_add" v-show="cal_adds_pop"/>
        <edit_cal @close="open_cal_edit" v-show="cal_edit_pop"/>
        <cal_share ref="cal_share_view" @close="open_cal_share" @refresh="open_cal_share" v-show="cal_share_pop"/>
    </div>
</template>

<script>


import send from '../../libs/send.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

import show_cal from './show_cal.vue'
import cal_add from './cal_add.vue'
import edit_cal from './edi_cal.vue'
import cal_share from './cal_share.vue'

export default {
    name: 'cal_set',
    data: function() {
        return {
            user_id: 0,
            cals: [],
            cal_info: false,
            cal_adds_pop: false,
            cal_edit_pop: false,
            cal_share_pop: false,
            can_scrol: false,
            page_scroll: 1
        }
    },
    components: {
        simplebar,
        show_cal,
        cal_add,
        edit_cal,
        cal_share
    },
    methods: {
        open_cal_inf(id=0) {
            if (!this.cal_info) {
                this.$root.$refs.show_info_cal_pop.download_data(id)
                this.cal_info = true
            } else this.cal_info = false
        },
        open_cal_edit(id=0) {
            if (!this.cal_edit_pop) {
                this.$root.$refs.cal_edit_pop.download_data(id)
                this.cal_edit_pop = true
            } else this.cal_edit_pop = false
        },
        open_cal_share(id=0) {
            if (!this.cal_share_pop) {
                this.$refs.cal_share_view.get_data(id)
                this.cal_share_pop = true
            } else this.cal_share_pop = false
        },
        open_cal_add() {
            if (!this.cal_adds_pop) {
                this.cal_adds_pop = true
            } else this.cal_adds_pop = false
        },
        close() {
            this.cals = []
            this.$root.$refs.main.show_cal_pop()
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
            function get_noselected() {
                let output = []
                vm.cals.forEach(e => {
                    if (e['Selected'] == 0) output.push(e['ID'])
                })
                return output
            }
            if (this.cals.length > 0) {
                let data = {ids: get_selected(), idn: get_noselected()}
                send.send_post_json(
                JSON.stringify(data),
                this.$root.$refs.app_view.url_path + 'api/calendars/perm_set.php',
                function(resp) {
                    if (resp.responseText == 'OK') {
                        vm.$root.$refs.main.alert_pop(4, 'Zastosowano!' , 'Pomyślnie zapisano zmiany!')
                        vm.$root.$refs.main.refresh_cal()
                        vm.close()
                    } else {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zapisac zmian!')
                    }
                }, function() {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zapisac zmian!')
                })
            }
        },
        get_data() {
            let vm = this
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

            send.send_get(this.$root.$refs.app_view.url_path + 'api/calendars/?page=' + this.page_scroll.toString(), 
            function(resp) {
                if (is_json(resp.responseText)) {
                    let dat = JSON.parse(resp.responseText)
                    dat.forEach(element => {
                        if (is_empty(element)) {
                            vm.cals.push({
                                ID : element['ID'],
                                Name : element['Name'],
                                Owner : element['Owner'],
                                Selected : element['Selected'],
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
                vm.get_data()
            }
        },
        select_all() {
            this.cals.forEach( e=>{
                e['Selected'] = 1
                // if (e['Selected'] == 1) e['Selected'] = 0
                // else e['Selected'] = 1
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
        this.$root.$refs.cal_set_view = this
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
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }

    .pop_view {
        position: relative;
        width: 700px;
        height: 600px;
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
        justify-content: right;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .pop_view_buttons button {
        width: 150px;
        height: 40px;
        outline: none;
        margin-right: 20px;
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
        height: 30px;
        cursor: pointer;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .calnder_set_item_info {
        position: relative;
        width: 45%;
        height: 100%;
    }

    .calnder_set_item_info a {
        position: relative;
        display: block;
        padding-left: 30px;
        line-height: 32px;
        cursor: pointer;
    }

    .calnder_set_item_info a:hover {
        text-decoration: underline;
    }

    .calnder_set_item_buttons {
        position: relative;
        width: 45%;
        height: 100%;

    }
    .calnder_set_item_buttons span {
        float: right;
        margin-left: 15px;
        line-height: 32px;
    }
    .calnder_set_item_buttons span:hover {
        text-decoration: underline;
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

    .cal_set_main_view_info a:hover {
        text-decoration: underline;
    }

    @media (max-width: 699px) {
        .pop_view {
            width: 100%;
        }
        @media (max-width: 500px) {
            .pop_view {
                width: 100%;
            }
            .icon_inputs_view{
                display: none;
            }
        }
        @media (max-height: 2000px) {
            .pop_view_inputs {
                height: 77%;
            }
            .calnder_set_item_buttons{
                font-size: 1.3vh;
            }
            .pop_view {
                /* font-size: 1.3vh; */
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
        }
    }

</style>