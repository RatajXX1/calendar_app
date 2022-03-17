<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_input">
                    <input style="font-size: 23px" type="text" placeholder="Dodaj tytuł" ref="title"/>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <div class="pop_view_input_div">
                        <!-- <a>Czwartek, 17 marzec</a> -->
                        <div v-if="!mobile_view" style="display: flex;flex-direction: row;justify-items: center;">
                            <div class="hour_select_bt day_select_bt">
                                <div v-bind:style="{'display': date_1}" v-on:click="hide_num(3)" class="background_view_click"></div>
                                <input ref="date_intput_start" type="text" value="Czwartek, 17 marzec" @click="show_num(3)"/>
                                <calendar_pop ref="calnedar_com_1" @changecal="focused_on(1)" @clickcal="calendar_1" v-bind:style="{'display': date_1}"/>
                            </div>
                            <div class="hour_select_bt">
                                <div v-bind:style="{'display': number_1}" ref="hide_num_1" v-on:click="hide_num(1)" class="background_view_click"></div>
                                <input ref="start_hour" type="text" value="15:00" maxlength="5" @focus="show_num(1)" @change="change_hour_inp(1)"/>
                                <div v-bind:style="{'display': number_1}" class="hour_select_bt_select">
                                    <div class="hour_select_bt_select_div">
                                        <simplebar style="width: 100%; height: 100%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                                            <div v-on:click="set_hour(1, index)" class="hour_select_bt_select_item" v-for="index in 24" :key="index">
                                                <a>{{index}}:00</a>
                                            </div>
                                        </simplebar>
                                    </div>
        
                                </div>
                            </div>
                            <a> - </a>
                            <div class="hour_select_bt">
                                <div v-bind:style="{'display': number_2}" ref="hide_num_2" v-on:click="hide_num(2)" class="background_view_click"></div>
                                <input ref="end_hour" value="16:00"  type="text" maxlength="5" @focus="show_num(2)" @change="change_hour_inp(2)"/>
                                <div v-bind:style="{'display': number_2}" class="hour_select_bt_select">
                                    <div class="hour_select_bt_select_div">
                                        <simplebar style="width: 100%; height: 100%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                                            <div v-on:click="set_hour(2, index)" class="hour_select_bt_select_item" v-for="index in 24" :key="index">
                                                <a>{{index}}:00</a>
                                            </div>  
                                        </simplebar>
                                    </div>    
                                </div>
                            </div>
                            <div class="hour_select_bt day_select_bt">
                                <div v-bind:style="{'display': date_2}" v-on:click="hide_num(4)" class="background_view_click"></div>
                                <input ref="date_intput_end" type="text" value="Czwartek, 17 marzec" @click="show_num(4)" />
                                <calendar_pop ref="calnedar_com_2" @changecal="focused_on(2)" @clickcal="calendar_2" v-bind:style="{'display': date_2}" />
                            </div>                            
                        </div>
                        <div v-else> 
                            <a style="display: inline-block; width: 30px">Od</a>
                            <div style="display: inline-block" class="hour_select_bt day_select_bt">
                                <div v-bind:style="{'display': date_1}" v-on:click="hide_num(3)" class="background_view_click"></div>
                                <input ref="date_intput_start" type="text" value="Czwartek, 17 marzec" @click="show_num(3)"/>
                                <calendar_pop ref="calnedar_com_1" @changecal="focused_on(1)" @clickcal="calendar_1" v-bind:style="{'display': date_1}"/>
                            </div>
                            <div style="display: inline-block" class="hour_select_bt">
                                <div v-bind:style="{'display': number_1}" ref="hide_num_1" v-on:click="hide_num(1)" class="background_view_click"></div>
                                <input ref="start_hour" type="text" value="15:00" maxlength="5" @focus="show_num(1)" @change="change_hour_inp(1)"/>
                                <div v-bind:style="{'display': number_1}" class="hour_select_bt_select">
                                    <div class="hour_select_bt_select_div">
                                        <simplebar style="width: 100%; height: 100%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                                            <div v-on:click="set_hour(1, index)" class="hour_select_bt_select_item" v-for="index in 24" :key="index">
                                                <a>{{index}}:00</a>
                                            </div>
                                        </simplebar>
                                    </div>
        
                                </div>
                            </div>
                            <!-- <a> - </a> -->
                            <br>
                            <a style="display: inline-block; width: 30px">Do</a>
                            <div style="display: inline-block" class="hour_select_bt day_select_bt">
                                <div v-bind:style="{'display': date_2}" v-on:click="hide_num(4)" class="background_view_click"></div>
                                <input ref="date_intput_end" type="text" value="Czwartek, 17 marzec" @click="show_num(4)" />
                                <calendar_pop ref="calnedar_com_2" @changecal="focused_on(2)" @clickcal="calendar_2" v-bind:style="{'display': date_2}" />
                            </div>  
                            <div  style="display: inline-block" class="hour_select_bt">
                                <div v-bind:style="{'display': number_2}" ref="hide_num_2" v-on:click="hide_num(2)" class="background_view_click"></div>
                                <input ref="end_hour" value="16:00"  type="text" maxlength="5" @focus="show_num(2)" @change="change_hour_inp(2)"/>
                                <div v-bind:style="{'display': number_2}" class="hour_select_bt_select">
                                    <div class="hour_select_bt_select_div">
                                        <simplebar style="width: 100%; height: 100%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                                            <div v-on:click="set_hour(2, index)" class="hour_select_bt_select_item" v-for="index in 24" :key="index">
                                                <a>{{index}}:00</a>
                                            </div>  
                                        </simplebar>
                                    </div>    
                                </div>
                            </div>                           
                        </div>

                    </div>
                    <div v-on:click='show_mode' ref="text_mode_item_bac_div_click" class="itemt_type_select">
                        <a ref="text_mode_item">{{text_mode}}</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                        </svg>
                        <div v-on:mouseleave='close_mode' v-bind:style="{'display': desc }" style="width: 220px;height: 164px;bottom: -130px" class="hour_select_bt_select">
                            <div class="hour_select_bt_select_div">
                                <div @click="set_commnand(1)" class="hour_select_bt_select_item">
                                    <a>Nie powtarzaj</a>
                                </div>       
                                <div @click="set_commnand(5)" class="hour_select_bt_select_item">
                                    <a>Powtarzaj co dziennie</a>
                                </div>       
                                <div @click="set_commnand(2)" class="hour_select_bt_select_item">
                                    <a>Powtarzaj co tydzien</a>
                                </div>       
                                <div @click="set_commnand(3)" class="hour_select_bt_select_item">
                                    <a>Powtarzaj co miesiac</a>
                                </div>       
                                <div @click="set_commnand(4)" class="hour_select_bt_select_item">
                                    <a>Powtarzaj co rok</a>
                                </div>  
                            </div>                              
                        </div>
                    </div>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <a>Opis</a>
                    <div class="pop_view_editor_in">
                        
                        <div ref="editor_pop_cal" id="main_editor" class="pop_view_editor" ></div>
                    </div>
                </div>
                <div class="pop_view_input">
                    <svg  class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                        <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8zm-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7z"/>
                    </svg>
                    <a>Kolory</a>
                    <div class="pop_view_input_div_colors">
                        <div class="color_button_back" @click="select_color(1)">
                           
                            <div class="color_button_content"></div>
                            <svg v-show="color == 1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>                             
                        </div>

                        <div class="color_button_back" @click="select_color(2)">
                            <div style="background-color: #d50000"  class="color_button_content"></div>
                            <svg v-show="color == 2"   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>                            
                        </div>
                        <div class="color_button_back" @click="select_color(3)">
                            
                            <div style="background-color: #06c" class="color_button_content"></div>
                            <svg v-show="color == 3"   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>                            
                        </div>
                        <div class="color_button_back" @click="select_color(4)">
                        
                            <div style="background-color: #008a00" class="color_button_content"></div>
                            <svg v-show="color == 4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>                                
                        </div>
                        <div class="color_button_back" @click="select_color(5)">
                          
                            <div style="background-color: #ebeb17" class="color_button_content"></div>
                            <svg v-show="color == 5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>                              
                        </div>
                        <div class="color_button_back" @click="select_color(6)">                 
                            <div style="background-color: #8d1bff" class="color_button_content"></div>
                            <svg v-show="color == 6" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                            </svg>   
                        </div>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Anuluj</button>
                <button class="pop_view_buttons_submit" v-on:click="open_add_to_cal">Dodaj</button>
            </div>
        </div>
        <cal_select v-show="add_cal" @close="open_add_to_cal"/>
    </div>
</template>

<script>

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

import calendar_pop from './pop_calendar.vue'
import cal_select from './add_to_cal.vue'

import send from '../../libs/send.js'
import Quill from 'quill';

export default {
    name: 'add_event',
    data: function() {
        return {
            desc: 'none',
            number_1: 'none',
            number_2: 'none',
            date_1: 'none',
            date_2: 'none',
            mode: 1,
            text_mode: 'Nie powtarzaj',
            start_day: new Date(),
            end_day: new Date(),
            editror_rich: null,
            color: 1,
            add_cal: false,
            mobile_view: false
        }
    },
    components: {
        calendar_pop,
        cal_select,
        simplebar
    },
    methods: {
        open_add_to_cal() {
            if (!this.add_cal) {
                this.$root.$refs.cal_select.get_data()
                this.add_cal = true
            }
            else this.add_cal = false
        },
        set_commnand(id) {
            let vm = this
            if (id == 1) {
                this.mode = 1
                this.text_mode = "Nie powtarzaj"
                vm.$nextTick(()=> {
                    vm.$refs.text_mode_item.parentNode.style.width = ''
                    vm.$refs.text_mode_item.parentNode.style.width = 140 + 'px'
                })
            } else if (id == 2) {
                this.mode = 2
                this.text_mode = "Powtarzaj co tydzień"
                vm.$nextTick(()=> {
                    vm.$refs.text_mode_item.parentNode.style.width = ''
                    vm.$refs.text_mode_item.parentNode.style.width = 185 + 'px'
                })
            } else if (id == 3) {
                this.mode = 3
                this.text_mode = "Powtarzaj co miesiąc"
                vm.$nextTick(()=> {
                    vm.$refs.text_mode_item.parentNode.style.width = ''
                    vm.$refs.text_mode_item.parentNode.style.width = 185 + 'px'
                })
            } else if (id == 4) {
                this.mode = 4
                this.text_mode = "Powtarzaj co rok"                
                vm.$nextTick(()=> {
                    vm.$refs.text_mode_item.parentNode.style.width = ''
                    vm.$refs.text_mode_item.parentNode.style.width = 150 + 'px'
                })
            }
            else if (id == 5) {
                this.mode = 5
                this.text_mode = "Powtarzaj co dziennie"                
                vm.$nextTick(()=> {
                    vm.$refs.text_mode_item.parentNode.style.width = ''
                    vm.$refs.text_mode_item.parentNode.style.width = 190 + 'px'
                })
            }
        },
        focused_on(id) {
            if (id == 1) this.$refs.date_intput_start.focus()
            else this.$refs.date_intput_end.focus()
        },
        calendar_1(day, month, year, vm) {
            let time = new Date(year, month, day)
            // console.log(vm)
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
            function getTextWidth(text, font) {
                // re-use canvas object for better performance
                const canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
                const context = canvas.getContext("2d");
                context.font = font;
                const metrics = context.measureText(text);
                return metrics.width;
            }

            this.$refs.date_intput_start.value = day_name[time.getDay()] + ", " + day.toString() + " " + month_name[time.getMonth()]
            vm.set_selected(time)
            if (!this.mobile_view ) this.$refs.date_intput_start.parentNode.style.width = (getTextWidth(this.$refs.date_intput_start.value, 'regular 17pt Avenir') * 1.6) + 'px'
            this.start_day = new Date(year, month, day)
            this.hide_all()
            if (vm.selected_time.getTime() > this.$refs.calnedar_com_2.selected_time.getTime()) {
                if (this.$refs.text_mode_item_bac_div_click.style.display == 'none') this.$refs.text_mode_item_bac_div_click.style.display = ''
                this.$refs.calnedar_com_2.set_selected(new Date(time))
                this.end_day = new Date(time.getFullYear(), time.getMonth(), time.getDate())
                this.$refs.date_intput_end.value = day_name[time.getDay()] + ", " + day.toString() + " " + month_name[time.getMonth()]
                if (!this.mobile_view )  this.$refs.date_intput_end.parentNode.style.width = (getTextWidth(this.$refs.date_intput_start.value, 'regular 17pt Avenir') * 1.6) + 'px'
            } else {
                if (this.$refs.text_mode_item_bac_div_click.style.display == 'none') this.$refs.text_mode_item_bac_div_click.style.display = ''
            }
            this.check_hour(true)
        },
        calendar_2(day, month, year, vm) {
            let time = new Date(year, month, day)
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
            function getTextWidth(text, font) {
                // re-use canvas object for better performance
                const canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
                const context = canvas.getContext("2d");
                context.font = font;
                const metrics = context.measureText(text);
                return metrics.width;
            }
            this.$refs.date_intput_end.value = day_name[time.getDay()] + ", " + day.toString() + " " + month_name[time.getMonth()]
            this.end_day = new Date(year, month, day)
            vm.set_selected(time)
            if (!this.mobile_view ) this.$refs.date_intput_end.parentNode.style.width = (getTextWidth(this.$refs.date_intput_end.value, 'regular 17pt Avenir') * 1.6) + 'px'
            this.hide_all()
            if (vm.selected_time.getTime() < this.$refs.calnedar_com_1.selected_time.getTime()) {
                if (this.$refs.text_mode_item_bac_div_click.style.display == 'none') this.$refs.text_mode_item_bac_div_click.style.display = ''
                this.$refs.calnedar_com_1.set_selected(new Date(time))
                this.start_day = new Date(time.getFullYear(), time.getMonth(), time.getDate())
                this.$refs.date_intput_start.value = day_name[time.getDay()] + ", " + day.toString() + " " + month_name[time.getMonth()]
                if (!this.mobile_view ) this.$refs.date_intput_start.parentNode.style.width = (getTextWidth(this.$refs.date_intput_start.value, 'regular 17pt Avenir') * 1.6) + 'px'
            } else if (vm.selected_time.getTime() > this.$refs.calnedar_com_1.selected_time.getTime()) {
                this.$refs.text_mode_item_bac_div_click.style.display = 'none'
                this.set_commnand(1)
            } else {
                if (this.$refs.text_mode_item_bac_div_click.style.display == 'none') this.$refs.text_mode_item_bac_div_click.style.display = ''
            }
            this.check_hour(true)
        },
        hide_all() {
            this.number_1 = 'none'
            this.number_2 = 'none'
            this.date_1 = 'none'
            this.date_2 = 'none'
            // this.$refs.calnedar_com_1.view_to_start()
        },
        show_num(id) {
            this.hide_all()
            if (id == 1) {
                this.number_1 = 'block'
                if (this.mobile_view) this.$refs.end_hour.parentNode.style.display = 'none'
            }
            else if (id == 2) this.number_2 = 'block'
            else if (id == 3) this.date_1 = 'block'
            else if (id == 4) this.date_2 = 'block'
            if (id != 1) {
                this.$refs.end_hour.parentNode.style.display = 'inline-block'
            }
        },
        hide_num(id) {
            if (id == 1) {
                this.number_1 = 'none'
                this.$refs.end_hour.parentNode.style.display = 'inline-block'
            }
            else if (id == 2) this.number_2 = 'none'
            else if (id == 3) {
                this.date_1 = 'none'
                this.$refs.calnedar_com_1.view_to_start()
            }
            else if (id == 4) {
                this.date_2 = 'none'
                this.$refs.calnedar_com_2.view_to_start()
            }
        },
        reset_pop_up() {
            this.editror_rich.root.innerHTML = ""
            this.start_day = new Date(),
            this.start_day.setHours(0,0,0,0)
            this.end_day = new Date(this.start_day),
            this.desc = 'none'
            this.$refs.title.value = ''
            this.$refs.start_hour.value = '15:00'
            this.$refs.end_hour.value = '16:00'
            this.mode= 1
            this.color = 1
            this.text_mode = 'Nie powtarzaj'
            this.$refs.text_mode_item.parentNode.style.width = ''
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
            function getTextWidth(text, font) {
                // re-use canvas object for better performance
                const canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
                const context = canvas.getContext("2d");
                context.font = font;
                const metrics = context.measureText(text);
                return metrics.width;
            }
            this.$refs.calnedar_com_1.set_selected(new Date(this.start_day))
            this.$refs.calnedar_com_2.set_selected(new Date(this.start_day))
            this.$refs.date_intput_start.value = day_name[this.start_day.getDay()] + ", " + this.start_day.getDate().toString() + " " + month_name[this.start_day.getMonth()]
            this.$refs.date_intput_start.parentNode.style.width = (getTextWidth(this.$refs.date_intput_start.value, 'regular 17pt Avenir') * 1.6) + 'px'
            this.$refs.date_intput_end.value = day_name[this.end_day.getDay()] + ", " + this.end_day.getDate().toString() + " " + month_name[this.start_day.getMonth()]
            this.$refs.date_intput_end.parentNode.style.width = (getTextWidth(this.$refs.date_intput_end.value, 'regular 17pt Avenir') * 1.6) + 'px'

        }, 
        close() {
            this.reset_pop_up()
            this.$emit('close')
        },
        show_mode() {
            if (this.desc == 'none') this.desc = 'block'
            else this.desc = 'none'
        },
        close_mode() { 
            this.desc = 'none'
        },
        create_event(cal_id=0) {
            let vm = this
            // function make_hours(time) {
            //     time = time.split(':')
            //     return [parseInt(time[0]) , parseInt(time[1])]
            // }
            // console.log('Zawartosc' ,this.editror_rich.root.innerHTML)
            function parse_time(date_time, time) {
                return date_time.toLocaleDateString("en-CA") + ' ' + time
            }

            if (this.$refs.title.value != "" && this.$refs.start_hour.value != this.$refs.end_hour.value && this.editror_rich.root.innerHTML.replaceAll(' ', "") != '') {

                // let start_hour = make_hours(this.$refs.start_hour.value)
                // let end_hour = make_hours(this.$refs.end_hour.value)
                if (this.start_day.getMonth() != this.end_day.getMonth() ||
                    this.start_day.getDate() != this.end_day.getDate() ||
                    this.start_day.getFullYear() != this.end_day.getFullYear()) {
                    this.mode = 6
                }
                send.send_post_json(
                    JSON.stringify({
                        "title": this.$refs.title.value,
                        "start_date": parse_time(this.start_day, this.$refs.start_hour.value),
                        "end_date": parse_time(this.end_day, this.$refs.end_hour.value),
                        "content": this.editror_rich.root.innerHTML,
                        "calendar": cal_id,
                        "color": this.color,
                        "mode": this.mode
                    }),
                    this.$root.$refs.app_view.url_path + 'api/events/add_event.php',
                    function(e) {
                        if (e.responseText == "OK") {
                            // alert("Dodano")
                            vm.$root.$refs.main.alert_pop(4, 'Zapisano!' , 'Pomyślnie zapisanno wydarzenie!')
                            vm.$root.$refs.main.add_event_to_cal()
                            // console.log(e.responseText)
                            vm.close()
                        } else {
                            this.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zapisać wydarzenia!')
                            // console.log(e.responseText)
                        }
                    }, function() {
                        // alert("Error send 1")
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zapisać wydarzenia!')
                        // console.log(e)
                    }
                )
            } else this.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Wypełniej każde wymagane pole!')
        },
        set_hour(id , hour) {
            if (id == 1) {
                this.$refs.start_hour.value = hour.toString() + ":00"
                this.hide_num(1)
            }
            else if (id == 2) {
                this.$refs.end_hour.value = hour.toString() + ":00"
                // this.$refs.end_hour.focus()
                this.hide_num(2)
            }
            this.check_hour()
            // alert("godzina zmieniona")
            // console.log(id, hour)
        },
        check_hour(mode=false) {
            let vm = this
            vm.$nextTick(() => {
                function getTextWidth(text, font) {
                    // re-use canvas object for better performance
                    const canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
                    const context = canvas.getContext("2d");
                    context.font = font;
                    const metrics = context.measureText(text);
                    return metrics.width;
                }
                if (vm.$refs.calnedar_com_2.selected_time.getTime() === vm.$refs.calnedar_com_1.selected_time.getTime()) {
                    let t1 = parseInt(vm.$refs.start_hour.value.replace(":", ""))
                    let t2 = parseInt(vm.$refs.end_hour.value.replace(":", ""))

                    if (t1 > t2) {
                        if (!mode) {
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
                            let time = new Date(vm.$refs.calnedar_com_1.selected_time)
                            time.setDate(time.getDate() + 1)
                            vm.$refs.calnedar_com_2.set_selected(time)
                            vm.$refs.date_intput_end.value = day_name[time.getDay()] + ", " + time.getDate().toString() + " " + month_name[time.getMonth()]
                            vm.$refs.date_intput_end.parentNode.style.width = (getTextWidth(this.$refs.date_intput_end.value, 'regular 17pt Avenir') * 1.6) + 'px'
                        } else {
                            t1 = vm.$refs.start_hour.value
                            vm.$refs.start_hour.value = vm.$refs.end_hour.value
                            vm.$refs.end_hour.value = t1
                        }
                        
                    }                
                }                
            }) 
        },
        change_hour_inp(id) {
            let vm = this
            if (id == 1) {
                this.$nextTick(() => {
                    if (!vm.$refs.start_hour.value.includes(':')) {
                        vm.$refs.start_hour.value = new Date().getHours().toString() + ':00'
                    } else {
                        let val = vm.$refs.start_hour.value.split(":")
                        try {
                            val[0] = parseInt(val[0])
                            val[1] = parseInt(val[1])
                            if (val[1] < 0 || val[0] < 0) {
                                vm.$refs.start_hour.value = new Date().getHours().toString() + ':00'
                            } else {
                                if ((val[0] == 24 && val[1] != 0 )|| val[0] > 24) {
                                    vm.$refs.start_hour.value = '24:00'
                                } else {
                                    vm.$refs.start_hour.value = val[0].toString() + ":" + (val[1].toString().length == 1 ? '0' + val[1].toString() : val[1].toString())
                                }
                            }
                        } catch (e) {
                            vm.$refs.start_hour.value = new Date().getHours().toString() + ':00'
                        }
                    }
                })
            } else {
                this.$nextTick(() => {
                    if (!vm.$refs.end_hour.value.includes(':')) {
                        vm.$refs.end_hour.value = new Date().getHours().toString() + ':00'
                    } else {
                        let val = vm.$refs.end_hour.value.split(":")
                        try {
                            val[0] = parseInt(val[0])
                            val[1] = parseInt(val[1])
                            if (val[1] < 0 || val[0] < 0) {
                                vm.$refs.end_hour.value = new Date().getHours().toString() + ':00'
                            } else {
                                if ((val[0] == 24 && val[1] != 0 )|| val[0] > 24) {
                                    vm.$refs.end_hour.value = '24:00'
                                } else {
                                    vm.$refs.end_hour.value = val[0].toString() + ":" + (val[1].toString().length == 1 ? '0' + val[1].toString() : val[1].toString())
                                }
                            }
                        } catch (e) {
                            vm.$refs.end_hour.value = new Date().getHours().toString() + ':00'
                        }
                    }
                })
            }
            this.check_hour()
        },
        select_color(id) {
            this.color = id
        }
    },
    mounted: function() {
        this.$root.$refs.add_event_pop = this
        this.editror_rich = new Quill('#main_editor',
            {
                modules: {
                    toolbar: true
                },
                theme: 'snow'
            }
        )
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
        function getTextWidth(text, font) {
            // re-use canvas object for better performance
            const canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
            const context = canvas.getContext("2d");
            context.font = font;
            const metrics = context.measureText(text);
            return metrics.width;
        }
        this.$refs.date_intput_start.value = day_name[this.start_day.getDay()] + ", " + this.start_day.getDate().toString() + " " + month_name[this.start_day.getMonth()]
        this.$refs.date_intput_start.parentNode.style.width = (getTextWidth(this.$refs.date_intput_start.value, 'regular 17pt Avenir') * 1.6) + 'px'
        this.$refs.date_intput_end.value = day_name[this.end_day.getDay()] + ", " + this.end_day.getDate().toString() + " " + month_name[this.start_day.getMonth()]
        this.$refs.date_intput_end.parentNode.style.width = (getTextWidth(this.$refs.date_intput_end.value, 'regular 17pt Avenir') * 1.6) + 'px'

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
        /* display: flex;
        flex-direction: row;
        justify-items: center; */
        margin-bottom: 10px;
    }

    .pop_view_input_div_colors {
        position: relative;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-items: right;
        margin-top: 5px;
        height: 30px;
    }

    .pop_view_input_div_colors svg {
        position: absolute;
        display: block;
        width: 90%;
        height: 90%;
        left: 50%;
        top: 50%;
        fill: white;
        transform: translate(-50%, -50%);
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
        
        min-height: 25px;
        max-height: 250px;
        border: 1px solid #ececec;
        background-color: #ececec;
        border-radius: 0px 0px 15px 15px;
        transition: 1s;
        /* overflow-x: hidden; */
    }

    .pop_view_editor {
        position: relative;
        outline: none;
        margin-top: 20px;
        width: 95%;
        height: 170px;
        overflow-y: auto;
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
        /* top: 15px; */
        left: 50%;
        transform: translate(-50%, 0);
        bottom: 20px;
    }

    .pop_view_buttons button {
        width: 150px;
        height: 40px;
        outline: none;
        margin-right: 20px;
        /* margin-top: 20px; */
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
        transition: .5s;
    }

    .color_button_back:hover {
        width: 40px;
        height: 40px;
    }

    .color_button_content {
        position: absolute;
        width: 100%;
        height: 100%;
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
        white-space: nowrap;
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
        white-space: nowrap;
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
                font-size: 3vw;
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
            .pop_view_buttons {
                bottom: 15%;
            }
        }
    }

</style>