<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Dodaj do kalendarza</h1>
                    <div class="pop_view_line_2"></div>
                </div>
                <div class="cal_set_main_view">
                    <div class="cal_set_main_view_calendars">
                        <simplebar style="width: 100%; height: 88%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                            <a v-if="cals.length == 0" style="display: block;position: relative;top: 30px;width: 100%; text-align: center">Brak kalendarza</a>
                            <div class="cal_set_main_view_calendars_list">
                                <div class="calnder_set_item add_to_cal_calnder_set_item" @click="sumbit(item.ID)" v-for="item in cals" :key="item">
                                    <div class="calnder_set_item_info">
                                        <svg enable-background="new 0 0 48 48"  id="Layer_1" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="M43,43H5c-2.209,0-4-1.791-4-4V9c0-2.209,1.791-4,4-4h38c2.209,0,4,1.791,4,4v30  C47,41.209,45.209,43,43,43z M45,9c0-1.104-0.896-2-2-2H5C3.896,7,3,7.896,3,9v6h42V9z M45,17H3v22c0,1.104,0.896,2,2,2h38  c1.104,0,2-0.896,2-2V17z M41,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C42,30.553,41.553,31,41,31z M41,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C42,23.553,41.553,24,41,24z M33,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C34,30.553,33.553,31,33,31z M33,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C34,23.553,33.553,24,33,24z M25,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C26,30.553,25.553,31,25,31z M25,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C26,23.553,25.553,24,25,24z M17,38h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,37.553,17.553,38,17,38z M17,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C18,30.553,17.553,31,17,31z M17,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,23.553,17.553,24,17,24z M9,38H7c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2C10,37.553,9.553,38,9,38  z M9,31H7c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2C10,30.553,9.553,31,9,31z M23,34h2  c0.553,0,1,0.447,1,1v2c0,0.553-0.447,1-1,1h-2c-0.553,0-1-0.447-1-1v-2C22,34.447,22.447,34,23,34z" fill-rule="evenodd"/></svg>
                                        <a>{{item.Name}}</a>    
                                    </div>
                                </div>                                
                            </div>
                        </simplebar>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Anuluj</button>
            </div>
        </div>
    </div>
</template>

<script>

import send from '../../libs/send.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';


export default {
    name: 'cal_select',
    data: function() {
        return {
            cals: [],
            page: 0,
            can_scroll: false
        }
    },
    components: {
        simplebar,
    },
    methods: {
        close() {
            this.cals = []
            this.page = 0
            this.can_scroll = false
            this.$emit('close')
        },
        sumbit(id) {
            this.$root.$refs.add_event_pop.create_event(id)
            this.close()
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

            send.send_get(this.$root.$refs.app_view.url_path  +'api/calendars/cal_selected.php?page=' + this.page.toString(), 
            function(resp) {
                if (is_json(resp.responseText)) {
                    let dat = JSON.parse(resp.responseText)
                    if (Object.entries(dat).length == 1) {
                        vm.sumbit(dat[0]['ID'])
                    } else {
                        dat.forEach(element => {
                            if (is_empty(element)) {
                                vm.cals.push({
                                    ID : element['ID'],
                                    Name : element['Name']
                                })
                            } 
                        })
                        if (Object.entries(dat).length == 25) vm.can_scroll = true

                    }
                }
            }, function() {

            })
        },
        scroll_fun(e, vm=this) {
            if (vm.can_scrol && e.target.scrollHeight - e.target.scrollTop === e.target.clientHeight) {
                vm.can_scrol = false
                vm.page += 1
                vm.get_data()
            }
        },
    },
    mounted: function() {
        this.$root.$refs.cal_select = this
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
        width: 420px;
        height: 510px;
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
        height: 40px;
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
        /* display: flex;
        flex-direction: row;
        justify-content: space-between; */
        cursor: pointer;
        background-color: #ececec;
        border-radius: 10px;
        margin-bottom: 5px;
    }

    .calnder_set_item:hover {
        background-color: rgb(45, 45, 45);
        color: white;
        fill: white;
        /* border-radius: 10px; */
    }

    .calnder_set_item_info {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .calnder_set_item_info svg {
        position: absolute;
        display: block;
        left: 8px;
        top: 2px;
        width: 25px;
        height: 25px;
    }

    .calnder_set_item_info a {
        position: relative;
        display: block;
        padding-left: 40px;
        line-height: 32px;
        cursor: pointer;
    }

    /* .calnder_set_item_info a:hover {
        text-decoration: underline;
    } */

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
        /* @media (max-width: 500px) {
            .pop_view {
                width: 100%;
            }
            .icon_inputs_view{
                display: none;
            }
        } */
        @media (max-height: 2000px) {
            .pop_view {
                font-size: 1.8vh;
                /* height: 100vh; */
                /* top: -30px; */
                /* left: 0px; */
                /* transform: unset; */
            }
        }
    }


</style>