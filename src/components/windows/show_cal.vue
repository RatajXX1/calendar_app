<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_input pop_view_header">
                    <!-- <input style="font-size: 23px" type="text" placeholder="Dodaj tytuł" ref="title"/> -->
                    <h1>{{title}}</h1>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <a>Opis</a>
                    <div class="pop_view_editor_in">
                        <simplebar style="width: 100%; height: 88%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                            <div ref="editor_pop_cal" class="pop_view_editor" ></div>
                        </simplebar>
                    </div>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    <!-- <a>Informacje</a> -->
                    <div class="pop_view_input_div">
                        <a>Kalendarz został utworzony {{start_date}} przez użytkownika {{Owner_Name}}</a>
                    </div>
                    <div id="menage_button_div"  class="pop_view_input_div">
                        <a @click="oepn_menage_pop" class="menage_button">Zarządzaj kalendarzem</a>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Zamknij</button>
                <button class="pop_view_buttons_submit" v-if="Owner_id == this.$root.$refs.cal_set_view.user_id" @click="oepn_are_sure" >Usuń kalendarz</button>
            </div>
            <loading_pop v-show="loading_show"/>
            <are_sure v-if="pop_sure" :text="'Czy na pewno chcesz usunąc ten kalendarz?'" @close_pop="oepn_are_sure" @accept="delete_acout"/>
        </div>
        <menage_cal @close="oepn_menage_pop" v-show="pop_menage"/>
    </div>
</template>

<script>

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

import loading_pop from './loading_pop.vue'

import send from '../../libs/send.js'

import menage_cal from './menage_cal.vue'

import are_sure from './are_sure.vue'

export default {
    name: 'show_cal',
    data: function() {
        return {
            cal_id: 0,
            loading_show: false,
            pop_sure: false,
            pop_menage: false,
            title: '',
            content: '',
            start_date: '',
            Owner_id: 0,
            Owner_Name: '',
        }
    },
    components: {
        loading_pop,
        simplebar,
        are_sure,
        menage_cal
    },
    methods: {
        close() {
            this.$emit('close')
        },
        delete_acout() {
            let vm = this 
            if (this.cal_id != 0) {
                send.send_post(this.$root.$refs.app_view.url_path  + 'api/calendars/del_cal.php?ID=' + this.cal_id,
                function(resp) {
                    if (resp.responseText == "OK") {
                        vm.$root.$refs.main.alert_pop(4, 'Usunięto!' , 'Pomyślnie usunięto kalendarz!')
                        vm.oepn_are_sure()
                        vm.close()
                        vm.$root.$refs.cal_set_view.cals = []
                        vm.$root.$refs.cal_set_view.get_data()
                    } else {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć kalendarza!')
                    }
                }, function() {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć kalendarza!')
                })
            }
        },
        oepn_are_sure() {
            if (this.pop_sure) this.pop_sure = false
            else this.pop_sure = true
        },
        oepn_menage_pop() {
            if (this.pop_menage) this.pop_menage = false
            else {
                this.$root.$refs.cal_menage_view.get_data(this.cal_id)
                this.pop_menage = true
            }
        },
        download_data(id) {
            let vm = this
            this.cal_id = id
            this.loading_show = true
            function is_json(data) {
                try {
                    JSON.parse(data)
                    return true
                } catch (e) {
                    return false
                }
            }
            send.send_get(
                this.$root.$refs.app_view.url_path + 'api/calendars/info_cal.php?id=' + id.toString(),
                function(resp) {
                    if (is_json(resp.responseText)) {
                        let item = JSON.parse(resp.responseText)
                        vm.title = item['Cal_name']
                        vm.$nextTick(() => {
                            vm.$refs.editor_pop_cal.innerHTML = item['Cal_desc']                            
                        })
                        vm.start_date = item['Cal_date']
                        vm.Owner_id = item['Cal_owner_id']
                        vm.Owner_Name = item['Cal_owner_name']
                    } else vm.close()
                    vm.loading_show = false
                }, function(resp) {
                    console.log(resp)
                    vm.close()
                    vm.loading_show = false
                }
            )

        }
    },
    created: function() {
        this.$root.$refs.show_info_cal_pop = this
    }
}
</script>

<style scoped>
   .main_view_pop {
        top: 0px;
        left: 0px;
        position: fixed;
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

    .pop_view h1 {
        position: relative;
        display: block;
        width: 95%;
        height: 20px;
        left: 50%;
        transform: translate(-50%, 0);
        top: 10px;
    }

    .pop_view_inputs {
        position: relative;
        width: 85%;
        left: 50%;
        height: 500px;
        top: 30px;
        transform: translate(-50%, 0);
        margin-top: 30px;
    }

    .pop_view_input {
        margin-bottom: 30px;
        position: relative;
        width: 95%;
        float: right;
        /* display: flex;
        flex-direction: row;
        justify-items: left; */
    }

    .pop_view_header {
        height: 50px;
        margin-bottom: 20px;
        border-bottom: 1px solid #d0d0d0;
    }

    .pop_view_header h1 {
        display: block;
        position: absolute;
        margin: 0;
        top: 0px;
        left: 50%;
        width: 100%;
        text-align: left;
        transform: translate(-50%, 0);
        height: 30px;
        color: rgb(45, 45, 45);
    }

    .icon_inputs_view {
        position: absolute;
        display: block;
        width: 25px;
        height: auto;
        top: -3px;
        fill: rgb(45, 45, 45);
        /* transform: translate(0, -50%); */
        left: -50px;
    }

    .pop_view_input input {
        outline: none;
        position: relative;
        width   : 100%;
        background-color: transparent;
        border: none;
        padding-bottom: 5px;
        border-bottom: 2px solid #d0d0d0 ;
        cursor: pointer;
        font-size: 21px;
        transition: .5s;
    }

    .pop_view_input input:focus {
        border-color: rgb(45, 45, 45);
    }


    .pop_view_input_div {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-items: center;
        margin-bottom: 10px;
    }

    .pop_view_input_div_colors {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-items: right;
        margin-top: 5px;
    }

    .pop_view_input_div a {
        position: relative;
        height: 31px;
        line-height: 31px;
        /* margin-right: 10px; */
    }

    /* .pop_view_input a {
        width: 20%;
    } */

    .pop_view_input_in {
        position: relative;
        width: 100%;
        height: 25px;
        border: 1px solid #d0d0d0;
    }

    .pop_view_editor_in {
        position: relative;
        width: 100%;
        height: 250px;
        border: 1px solid #ececec;
        background-color: #ececec;
        border-radius: 0px 0px 15px 15px;
        transition: 1s;
    }

    .pop_view_editor {
        position: relative;
        outline: none;
        margin-top: 5px;
        width: 95%;
        padding-bottom: 5px;
        /* height: 170px; */
        /* overflow-y: auto; */
        left: 50%;
        transform: translate(-50%, 0);
        transition: 5s;
        /* background-color: #ececec; */
        /* background-color: ; */
    }

    .pop_view_editor_buttons {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: left;
        background-color: #d0d0d0;
        transition: .5s;
    }

    .pop_view_editor_select {
        padding-top: 5px;
        position: relative;
        width: 100%;
        background-color: #d0d0d0;
    }

    .pop_view_editor_select span {
        margin-right: 10px;
        margin-left: 10px;
    }

    .pop_view_editor_select select {
        border: none;
        outline: none;
        cursor: pointer;
    }

    .pop_view_editor_buttons button{
        background-color: transparent;
        border: none;
        outline: none;
        cursor: pointer;
        width: 30px;
        height: 30px;
    }

    .pop_view_editor_buttons button:hover{
        background-color: #ececec;
    }


    .pop_view_input_in input {
        position: relative;
        width: 98%;
        height: 90%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: none;
        outline: none;
        background-color: transparent;
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

    .pop_view_input_editor_border {
        position: relative;
        border: 1px solid #d0d0d0;
        min-height: 30px;
    }

    .pop_view_input_editor {
        position: relative;
        outline: none;
        width: 98%;
        top: 10px;
        /* padding-bottom: 10px; */
        margin-bottom: 20px;
        height: 100%;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .pop_view_buttons_close {
        color: rgb(45, 45, 45);
        background-color: transparent;
    }

    .pop_view_buttons_submit {
        background-color: rgb(45, 45, 45);
        color: white;
    }

    .color_button_back {
        position: relative;
        width: 30px;
        height: 30px;
        background-color: #d0d0d0;
        cursor: pointer;
        border-radius: 50px;
        margin-right: 5px;
    }

    .color_button_content {
        position: absolute;
        width: 25px;
        height: 25px;
        left: 50%;
        right: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: rgb(45, 45, 45);
        border-radius: 50px;
    }

    .select_button {
        position: relative;
        display: block;
        background-color: transparent;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        outline: none;
        font-size: 16px;
        padding: 2px 5px 2px 5px;
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-weight: normal;
        /* color: #ececec; */
    }

    .select_button:hover {
        background-color: #d0d0d0;
    }

    .hour_select_bt {
        display: block;
        position: relative;
        width: 50px;
        height: 29px;
        margin-right: 5px;
        margin-left: 5px;
        border: unset;
        box-sizing: border-box;
    }

    .day_select_bt {
        position: relative;
        width: 150px;
        /* min-width: 150px;
        max-width: 200px; */
        height: 29px;
        margin-right: 5px;
        /* margin-left: 5px; */
        border: unset;
        box-sizing: border-box;
    }

    .hour_select_bt input {
        /* box-sizing: border-box; */
        z-index: 3  ;
        line-height: 29px;
        /* padding-top: 5px; */
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: unset;
        position: relative;
        width: 100%;
        font-size: unset;
        text-align: center;
        border: unset;
        font-weight: normal;
        left: 50%;
        transform: translate(-50%, 0);
        border-bottom: 1px solid transparent;
        border-color: transparent;
        transition: 1s;
    }

    .day_select_bt input {
        z-index: 3;
        text-align: left;
        padding: none;
    }

    .hour_select_bt input:hover {
        background-color: #ececec;
        border-color: rgb(45, 45, 45);

    }

    .hour_select_bt input:focus {
        background-color: #ececec;
    }

    .hour_select_bt_select {
        display: none;
        position: absolute;
        z-index: 2;
        bottom: -143px;
        left: -10%;
        width: 150px;
        /* min-height: 50px; */
        height: 140px;
        background-color: white;
        -webkit-box-shadow: 0px 0px 12px 0px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 12px 0px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 12px 0px rgba(66, 68, 90, 1);
        /* overflow: auto; */
        /* padding: 2px 5px 2px 5px; */
        /* border-radius: 15px; */
        /* transform: translate(-50%, 0); */
        border-radius: 5px;
    }

    .hour_select_bt_select_div {
        position: relative;
        width: 85%;
        height: 95%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        overflow: auto;
    }

    .hour_select_bt_select_item {
        position: relative;
        cursor: pointer;
        height: 31px;
        width: 100%;
    }

    .hour_select_bt_select_item:hover {
        background-color: rgb(45, 45, 45);
        color: white;
    }

    .hour_select_bt_select_item a {
        position: relative;
        display: block;
        line-height: 31px;
        margin-left: 10%;
    }
    .oepn_menage_pop {
        cursor: pointer;
    }
    .oepn_menage_pop:hover {
        text-decoration: underline;
    }

    .itemt_type_select {
        display: block;
        position: relative;
        cursor: pointer;
        height: 31px;
        width: 140px;
        padding-right: 5px;
        border-radius: 5px;
    }

    .itemt_type_select a {
        position: relative;
        display: block;
        line-height: 31px;
        margin-left: 10px;
    }

    .itemt_type_select svg {
        position: absolute;
        display: block;
        width: 20px;
        height: 20px;
        top: 5px;
        right: 10px;
    }

    .itemt_type_select:hover {
        background-color: #ececec;
    }

    .background_view_click {
        position: fixed;
        display: block;
        z-index: 2;
        width: 110vw;
        height: 110vh;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        /* background-color: rgb(45, 45, 45); */
    }

    .menage_button {
        cursor: pointer;
        font-weight: bold;

    }

    .menage_button:hover {
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
            /* .pop_view_inputs {
                height: 76%;
            } */
            #menage_button_div {
                margin-top: 30px;
            }
            .pop_view_haeder h1{
                font-size: 1.8vh;
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