<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_input pop_view_header">
                    <h1>{{title}}</h1>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <div class="pop_view_input_div">
                        <a>{{start_date}}</a>
                    </div>
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
                    <div class="icon_inputs_view">
                        <svg enable-background="new 0 0 48 48"  id="Layer_1" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="M43,43H5c-2.209,0-4-1.791-4-4V9c0-2.209,1.791-4,4-4h38c2.209,0,4,1.791,4,4v30  C47,41.209,45.209,43,43,43z M45,9c0-1.104-0.896-2-2-2H5C3.896,7,3,7.896,3,9v6h42V9z M45,17H3v22c0,1.104,0.896,2,2,2h38  c1.104,0,2-0.896,2-2V17z M41,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C42,30.553,41.553,31,41,31z M41,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C42,23.553,41.553,24,41,24z M33,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C34,30.553,33.553,31,33,31z M33,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C34,23.553,33.553,24,33,24z M25,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C26,30.553,25.553,31,25,31z M25,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C26,23.553,25.553,24,25,24z M17,38h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,37.553,17.553,38,17,38z M17,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C18,30.553,17.553,31,17,31z M17,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,23.553,17.553,24,17,24z M9,38H7c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2C10,37.553,9.553,38,9,38  z M9,31H7c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2C10,30.553,9.553,31,9,31z M23,34h2  c0.553,0,1,0.447,1,1v2c0,0.553-0.447,1-1,1h-2c-0.553,0-1-0.447-1-1v-2C22,34.447,22.447,34,23,34z" fill-rule="evenodd"/></svg>
                    </div>
                    <a>Wydarzenie z kalendarza o nazwie {{cal_name}}</a>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Zamknij</button>
                <button class="pop_view_buttons_submit" @click="oepn_are_sure" >Usuń wydarzenie</button>
            </div>
            <are_sure v-if="pop_sure" :text="'Czy na pewno chcesz usunąc to wydarzenie z tego kalendarza?'" @close_pop="oepn_are_sure" @accept="del_ev"/>
            <loading_pop v-show="loading_show"/>
        </div>
    </div>
</template>

<script>
import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

import loading_pop from './loading_pop.vue'
import are_sure from './are_sure.vue'
import send from '../../libs/send.js'

export default {
    name: 'show_event',
    data: function() {
        return {
            loading_show: false,
            pop_sure: false,
            title: '',
            content: '',
            start_date: '',
            cal_name: '',
            ev_id: 0
        }
    },
    components: {
        loading_pop,
        simplebar,
        are_sure
    },
    methods: {
        oepn_are_sure() {
            if (this.pop_sure) this.pop_sure = false
            else this.pop_sure = true
        },
        close() {
            this.$emit('close')
        },
        del_ev() {
            let vm = this
            send.send_post(this.$root.$refs.app_view.url_path + '/api/events/del_event.php?ID=' + this.ev_id.toString(), 
            function(resp) {
                if (resp.responseText == "OK") {
                    vm.$root.$refs.main.alert_pop(4, 'Usunięto!' , 'Pomyślnie usunięto wydarzenie z tego kalendarza!')
                    vm.$root.$refs.main.refresh_cal()
                    vm.oepn_are_sure()
                    vm.close()
                } else {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć wydarzenia z tego kalendarza!')
                }
            }, function() {
                vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się usunąć wydarzenia z tego kalendarza!')
            })
        },
        download_data(id) {
            let vm = this
            this.ev_id = id
            this.loading_show = true
            function is_json(data) {
                try {
                    JSON.parse(data)
                    return true
                } catch (e) {
                    return false
                }
            }
            function make_time(times, timee) {
                let month_name = {
                    0: "Styczeń",
                    1: "Luty",
                    2: "Marzec",
                    3: "Kwiecień",
                    4: "Maj",
                    5: "Czerwiec",
                    6: "Lipiec",
                    7: "Sierpień",
                    8: "Wrzesień",
                    9: "Październik",
                    10: "Listopad",
                    11: "Grudzien",
                }
                let day_name = {
                    0: "Niedziela",
                    1: "Poniedziałek",
                    2: "Wtorek",
                    3: "Środa",
                    4: "Czwartek",
                    5: "Piątek",
                    6: "Sobota",
                    7: "Niedziela",
                }

                let timed = new Date(times.split(' ')[0].split('-')[0], times.split(' ')[0].split('-')[1], times.split(' ')[0].split('-')[2])
                let timeeb = new Date(timee.split(' ')[0].split('-')[0], timee.split(' ')[0].split('-')[1], timee.split(' ')[0].split('-')[2])
                if (timed.getTime() === timeeb.getTime()) {
                    vm.start_date = day_name[timed.getDay()] + ', ' + timed.getDate() + ' ' + month_name[timed.getMonth() - 1] + ' ' + times.split(' ')[1].split(':')[0] + ':' + times.split(' ')[1].split(':')[1] + ' - '  + timee.split(' ')[1].split(':')[0] + ':' + timee.split(' ')[1].split(':')[1]
                } else {
                    vm.start_date = day_name[timed.getDay()] + ', ' + timed.getDate() + ' ' + month_name[timed.getMonth() - 1] + ' ' + times.split(' ')[1].split(':')[0] + ':' + times.split(' ')[1].split(':')[1] + ' - '  + timee.split(' ')[1].split(':')[0] + ':' + timee.split(' ')[1].split(':')[1] +
                    ' ' + day_name[timeeb.getDay()] + ', ' + timeeb.getDate() + ' ' + month_name[timeeb.getMonth() - 1]
                }
            }
            send.send_get(
                this.$root.$refs.app_view.url_path + '/api/events/event_info.php?evid=' + id.toString(),
                function(resp) {
                    if (is_json(resp.responseText)) {
                        let item = JSON.parse(resp.responseText)
                        vm.title = item['Title']
                        vm.content = item['Content']
                        vm.$refs.editor_pop_cal.innerHTML = item['Content']
                        if (item['Mode'] == 1 || item['Mode'] == 0 || item['Mode'] == 6) make_time(item['Time_start'], item['Time_end'])
                        else if (item['Mode'] == 5) vm.start_date = 'Powtarzanie codziennie'
                        else if (item['Mode'] == 2) vm.start_date = 'Powtarzanie co tydzień'
                        else if (item['Mode'] == 3) vm.start_date = 'Powtarzanie co miesiąc'
                        else if (item['Mode'] == 4) vm.start_date = 'Powtarzanie co rok'
                        vm.cal_name = item['Cal_name'] 

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
        this.$root.$refs.show_info_pop = this
    }
}
</script>

<style scoped>
   .main_view_pop {
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
        height: 70%;
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
        margin-top: 20px;
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
        position: absolute;
        width: 90%;
        display: flex;
        flex-direction: row;
        justify-content: right;
        left: 50%;
        transform: translate(-50%, 0);
        bottom: 40px;
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

    /* .hour_select_bt input:focus ~ .hour_select_bt_select {
        display: block;
    } */

    /* .calendar_pop_view_bt {
        display: none;
    }

    .day_select_bt input:focus ~ .calendar_pop_view_bt {
        display: block;
    } */

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
            .pop_view {
                font-size: 1.8vh;
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
            .pop_view_buttons {
                position: relative;
            }
        }
    }
</style>