<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Zarządzaj dostępem</h1>
                </div>
                <div class="cal_set_main_view">
                    <div class="cal_set_main_view_info">
                        <a @click="open_cal_share">Dodaj użytkownika</a>
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
                                        <span class="del_button" @click="oepn_are_sure(item.ID)">Usuń dostęp</span>
                                    </div>
                                </div>
                                <a v-if="cals.length == 0" style="position: absolute; text-align: center; top: 120px">Brak użytkowników z możliwością posiadania dostepu do tego kalendarza!</a>                         
                            </div>
                        </simplebar>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Zamknij</button>
            </div>
        </div>
        <are_sure v-if="pop_sure" :text="'Czy na pewno chcesz usunąc temu użytkownikowi dostęp do tego kalendarza?'" @close_pop="oepn_are_sure" @accept="delete_acout"/>
        <cal_share ref="cal_share_view" @close="open_cal_share" @refresh="refresh_data" v-show="cal_share_pop"/>
    </div>
</template>

<script>

import send from '../../libs/send.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

import are_sure from './are_sure.vue'
import cal_share from './cal_share.vue'

export default {
    name: 'cal_manage',
    data: function() {
        return {
            user_id: 0,
            cals: [],
            cal_id: 0,
            can_scrol: false,
            pop_sure: false,
            cal_share_pop: false,
            page_scroll: 1
        }
    },
    components: {
        simplebar,
        are_sure,
        cal_share
    },
    methods: {
        close() {
            this.cals = []
            this.page_scroll = 1
            this.$emit('close')
        },
        refresh_data() {
            this.cal_share_pop = false
            this.cals = []
            this.page_scroll = 1
            this.get_data(this.cal_id)
        },
        open_cal_share() {
            if (this.cal_share_pop){
                this.cal_share_pop = false
            }
            else {
                this.$refs.cal_share_view.get_data(this.cal_id)
                this.cal_share_pop = true
            }
        },
        oepn_are_sure(id=0) {
            this.user_id = id
            if (this.pop_sure) this.pop_sure = false
            else this.pop_sure = true
        },
        delete_acout() {
            let vm = this
            send.send_post(this.$root.$refs.app_view.url_path + 'api/calendars/del_perm.php?ID=' + this.user_id.toString(), function(resp) {
                if (resp.responseText == 'OK') {
                    vm.$root.$refs.main.alert_pop(4, 'Usunięto!' , 'Pomyślnie usunięto dostęp do tego kalendarza!')
                    vm.oepn_are_sure()
                    vm.refresh_data()
                } else {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć dostępu do tego kalendarza!')
                }
            }, function() {
                vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć dostępu do tego kalendarza!')
            })
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

            send.send_get(this.$root.$refs.app_view.url_path + 'api/calendars/perm_list.php?id=' + id + '&mode=1&page=' + this.page_scroll, 
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
        }
    },
    mounted: function() {
        this.$root.$refs.cal_menage_view = this
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

    .del_button {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translate(0, -50%);
        cursor: pointer;
    }

    .del_button:hover {
        text-decoration: underline;
    }

    @media (max-width: 394px) {
        .pop_view {
            width: 100%;
        }
    }

</style>