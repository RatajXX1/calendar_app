<template>
    <div class="main_window">
        <div ref="cal_haeder" class="calendar_header">
            <div class="calendar_header_days">
                <div id="calendar_header_empty"></div>
                <div class="calendar_header_item">
                    <a ref="day_head_1">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_2">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_3">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_4">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_5">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_6">Pon., 27</a>
                </div>
                <div class="calendar_header_item">
                    <a ref="day_head_7">Pon., 27</a>
                </div>                
            </div>
            <div v-if="multi_days.length > 0" class="clendar_mutli_days_events">
                <button v-if="multi_days.length > 3" @click="show_more_button" class="clendar_mutli_days_events_show_more">
                    <svg ref="buton_info_more" xmlns="http://www.w3.org/2000/svg"  class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
                <div style="left: -1px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 200px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 400px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 600px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 800px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 1000px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 1200px" class="clendar_mutli_days_events_line"></div>
                <div style="left: 1400px" class="clendar_mutli_days_events_line"></div>
                <div class="mulit_event_days">
                    <div @click="click_ev(item.RID)" v-bind:style="{width: 200 * ((item.date_end.getDay() === 0 ? 7 : item.date_end.getDay()) - (item.date_start.getDay() === 1 ? 0 : item.date_start.getDay() - 1) )  + 'px', left: 200 * ((item.date_start.getDay() === 0 ? 7 : item.date_start.getDay())-1) + 'px'}" class="clendar_mutli_days_event_item" :class="['clolor_' + item.colors]" v-for="item in long_days" :key="item"> 
                        <a>{{item.time_start}} - {{item.time_end}} {{item.text}}</a>
                    </div>                    
                </div>
                <div v-if="multi_days.length > 3 && !show_more_info" class="more_info_space">
                    <div v-if="multi_days_index[0]  > 0" @click="show_more_button" style="left: 0px"  class="info_more"><a>+{{multi_days_index[0]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[1]  > 0" @click="show_more_button" style="left: 200px"  class="info_more"><a>+{{multi_days_index[1]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[2]  > 0" @click="show_more_button" style="left: 400px"  class="info_more"><a>+{{multi_days_index[2]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[3]  > 0" @click="show_more_button" style="left: 600px"  class="info_more"><a>+{{multi_days_index[3]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[4]  > 0" @click="show_more_button" style="left: 800px"  class="info_more"><a>+{{multi_days_index[4]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[5]  > 0" @click="show_more_button" style="left: 1000px"  class="info_more"><a>+{{multi_days_index[5]}} wydarzenie</a></div>
                    <div v-if="multi_days_index[6]  > 0" @click="show_more_button" style="left: 1200px"  class="info_more"><a>+{{multi_days_index[6]}} wydarzenie</a></div>
                </div>
            </div>
        </div>

        <simplebar style="width: 100%; height: 93%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
            <div ref="window_cal" class="calendar_window">
                <div class="calendar_time_hours">
                    <div class="calendar_time_hours_item" v-for="index in 24" :key="index">
                        <a v-if="index > 1" >{{index - 1}}:00</a>
                    </div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)" @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID" v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_1" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)"  @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID" v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_2" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)"  @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID" v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_3" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>                
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)" @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID"  v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_4" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)" @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID" v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_5" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)" @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID"  v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_6" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline"></div>
                </div>
                <div class="calendar_time_day">
                    <div class="calendar_time_day_block" v-for="index in 48" :key="index"></div>
                    <div @click="click_ev(item.RID)" @mouseover="mouse_over_ev" @mouseleave="mouse_leave" :ref="'event_' + item.ID"  v-bind:style="{top: item.time_start + '%', height: item.time_end + 'px'}" class="calendar_time_day_item" :class="['clolor_' + item.colors]" v-for="item in day_7" :key="item"> 
                        <b>{{item.text}}</b>
                    </div>
                    <div v-bind:style="{top: time_top + '%'}" class="calendar_timeline" ref='timeline'></div>
                </div>
                
                
            </div>            
        </simplebar>
        
    </div>
</template>

<script>
// let utlis = require("../libs/utilis")

import utilis from '../libs/utilis.js'
import utlis from '../libs/utilis.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';

export default ({
    name: 'calendar',
    data: function() {
        return {
            unique: 0,
            multi_days_index: [0,0,0,0,0,0,0],
            show_more_info: false,
            multi_days: [
                // {text: "Test", time_start: '1:00', time_end: '16:00', date_start: new Date(2022, 0, 17), date_end: new Date(2022, 0, 22)},
            ],
            time_week: new Date(),
            time_top: 0,
            times:false,
            day_1: [
                // {text: 'wydarzenie', desc: 'opis', time_start: 0, time_end: 101}
            ],
            day_2: [],
            day_3: [],
            day_4: [],
            day_5: [],
            day_6: [],  
            day_7: [],
        }
    },
    components: {
        simplebar
    },
    methods: {
        clear_cal() {
            this.unique = 0
            this.multi_days_index = [0,0,0,0,0,0,0]
            this.multi_days = []
            this.day_1 = []
            this.day_2 = []
            this.day_3 = []
            this.day_4 = []
            this.day_5 = []
            this.day_6 = []
            this.day_7 = []
            this.show_more_info = false
        },
        is_in_day(day_id, parsed_time_start, parsed_time_end) {
            let count = 0
            function time_end_to_pro(time_end, time_start){
                return ((time_end - (( time_end - time_end % 100) / 100) * 2) + (time_start*24))/24
            }
            parsed_time_end = time_end_to_pro(parsed_time_end, parsed_time_start)
            function count_of(table) { 
                table.forEach((e) => {
                    let endx = time_end_to_pro(e.time_end, e.time_start)
                    // if (e.time_start >= parsed_time_start && endx <= parsed_time_end) count += 1
                    if (endx !== parsed_time_start) {
                        if ((e.time_start >= parsed_time_start && endx <= parsed_time_end) || 
                        (parsed_time_start >= e.time_start && parsed_time_start <= endx) ||
                        (parsed_time_end >= e.time_start && parsed_time_end <= endx)) count += 1
                    }
                    
                    
                })
            }
            if (day_id == 0) count_of(this.day_7)
            else if (day_id == 1) count_of(this.day_1)
            else if (day_id == 2) count_of(this.day_2)
            else if (day_id == 3) count_of(this.day_3)
            else if (day_id == 4) count_of(this.day_4)
            else if (day_id == 5) count_of(this.day_5)
            else if (day_id == 6) count_of(this.day_6)
            return count
        },
        segregate_column(day_id,parsed_time_start, parsed_time_end) {
            let vm = this
            function time_end_to_pro(time_end, time_start){
                return ((time_end - (( time_end - time_end % 100) / 100) * 2) + (time_start*24))/24
            }
            function get_event_with_col(table, timed_start, timed_end) {
                let output = []
                table.forEach((e) => {
                    let endx = time_end_to_pro(e.time_end, e.time_start)
                    // if (e.time_start >= timed_start && endx <= timed_end) output.push(e.ID)
                    if (endx !== parsed_time_start) {
                        if ((e.time_start >= timed_start && endx <= timed_end) || 
                        (timed_start >= e.time_start && timed_start <= endx) ||
                        (timed_end >= e.time_start && timed_end <= endx)) output.push(e.ID)  
                    }
                     
                })
                return output
            }
            function get_event_with_col_by_id(data, table) {
                let output = {}
                function get_col_by_id(id) {
                    let time_out = []
                    table.forEach(d => {
                        if (d.ID == id) {
                            let endx = time_end_to_pro(d.time_end, d.time_start)
                            time_out = get_event_with_col(table, d.time_start, endx)
                            time_out = time_out.filter((c) => { return c !== id })
                        }
                    })
                    return time_out
                }
                data.forEach(e => {
                    output[e] = get_col_by_id(e)
                })

                function second_tour() {
                    let count = false
                    for(let key in output) {
                        if (output[key] != undefined) {
                            output[key].forEach(e => {
                                if (output[parseInt(e)] != undefined) return
                                else {
                                    output[e] = get_col_by_id(e)
                                    count = true
                                }
                            })
                        }
                    }
                    if (count) second_tour()
                }
                second_tour()

                return output
            }
            function to_columns(data) {
                let output = {}
                function contains(val) {
                    let con = false
                    for(let key in output) {
                        if (key != undefined)
                        output[key].forEach(e => {
                            if (e == val) {
                                con = true
                                return con
                            }
                        })
                    }
                    return con
                }
                function add_to(id, val) {
                    if (output[id]) output[id].push(val)
                    else output[id] = [val]    
                }
                let last_id = 1
                let firs_el = false
                // for (let tiem in tab) {console.log(tiem)}
                for (let key in data) {
                    // console.log(key, data[key])
                    if (key != undefined) 
                    if (!firs_el) {
                        add_to(1, key)
                        data[key].forEach(d => {
                            if (parseInt(key) !== parseInt(d))
                            if (data[d] === undefined) {
                                if (!contains(d))
                                {last_id += 1
                                add_to(last_id, d)}
                            }
                            // if (data[d].length == 0) adds = true
                            // else adds = false
                        })
                        firs_el = true
                        continue
                    }
                    if (data[key].length === 0) add_to(1, key)
                    else {
                        // let adds = false
                        last_id +=1
                        add_to(last_id, key)
                        data[key].forEach(d => {
                            if (parseInt(key) !== parseInt(d))
                            if (data[d] === undefined) {
                                if (!contains(d))
                                {last_id += 1
                                add_to(last_id, d)}
                            }
                            // if (data[d].length == 0) adds = true
                            // else adds = false
                        })   
                        // if (!adds) add_to(last_id-1, key)
                        // else     
                        
                        
                    }
                }                
                return output
            }
            function make_columns(data) {
                let offset = 1
                let counts = Object.keys(data).length
                for(let key in data) {
                    if (key != undefined) {
                        data[parseInt(key)].forEach(e => {
                            if (e != undefined) {
                                vm.$nextTick(() => {
                                    if (vm.$refs["event_" + e]) {
                                        vm.$refs["event_" + e][0].style.transform = 'unset'
                                        // console.log(((100 / counts) * parseInt(key)).toString(), counts, key)
                                        vm.$refs["event_" + e][0].style.width = ((100 / counts) - offset).toString() + '%'
                                        vm.$refs["event_" + e][0].style.left = (((100 / counts) * key) - (100 / counts)) .toString() + '%'
                                    }
                                })
                            }
                        })
                    }
                }   
            }
            if (this.is_in_day(day_id, parsed_time_start, parsed_time_end) > 1) {
                let tab = []
                if (day_id == 0) tab = this.day_7
                else if (day_id == 1) tab = this.day_1
                else if (day_id == 2) tab = this.day_2
                else if (day_id == 3) tab = this.day_3
                else if (day_id == 4) tab = this.day_4
                else if (day_id == 5) tab = this.day_5
                else if (day_id == 6) tab = this.day_6
                parsed_time_end = time_end_to_pro(parsed_time_end, parsed_time_start)
                let op_tab = get_event_with_col(tab, parsed_time_start, parsed_time_end)
                // console.log("Get col", op_tab)
                let end_tab = get_event_with_col_by_id(op_tab, tab)

                // console.log("Get col by id", end_tab)
                op_tab = to_columns(end_tab)
                // console.log("Columns", op_tab)
                make_columns(op_tab)
                // console.log('Columns done')
            }
        },
        add_event: function(time_hour_start,time_minute_start, time_hour_end, time_minute_end, title, time_start,time_end, rid, color_id=1, mode=1) {
            function time_to_number(hour, minutes) {return ((hour * 100) + (((minutes * 100) / 6) / 10))}
            function time_to_text(hour, minutes) {return hour.toString() + ':' + (minutes.toString().length == 1 ? '0' + minutes.toString() : minutes.toString())}

            function leapYear(year)
            {
                return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
            }

            let day_start = new Date(time_start.getFullYear(), time_start.getMonth(), time_start.getDate())
            let day_end = new Date(time_end.getFullYear(), time_end.getMonth(), time_end.getDate())
            if (mode == 3) { // co miesiac
                if (day_start.getMonth() == 1 && day_start.getDate() > 28 && !leapYear(this.time_week.getFullYear())) return
                else if (day_end.getMonth() == 1 && day_end.getDate() > 28 && !leapYear(this.time_week.getFullYear())) return
                day_start.setMonth(this.time_week.getMonth())
                day_end.setMonth(this.time_week.getMonth())
            } else if (mode == 4) { // co rok
                if (day_start.getMonth() == 1 && day_start.getDate() > 28 && !leapYear(this.time_week.getFullYear())) return
                else if (day_end.getMonth() == 1 && day_end.getDate() > 28 && !leapYear(this.time_week.getFullYear())) return
                day_start.setFullYear(this.time_week.getFullYear())
                day_end.setFullYear(this.time_week.getFullYear())
            } else if (mode == 2) { // co tydzien
                let days = utilis.get_week(this.time_week)
                day_start = days[day_start.getDay()]
                day_end = days[day_end.getDay()]
            }
           
            // if (!utlis.is_in_week(day_start, this.time_week) && mode < 2) return
            if (mode == 5) {
                let start_i = 0
                if (utlis.is_in_week(day_start, this.time_week)) {
                    start_i = day_start.getDay()
                    let start = time_to_number( time_hour_start , time_minute_start ) 
                    let end = time_to_number(  time_hour_end, time_minute_end) - time_to_number( time_hour_start ,time_minute_start)
                    this.day_7.push({ID: this.unique ,RID: rid , text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2, colors: color_id   })
                    this.unique += 1
                    this.segregate_column(0,start/24, end + (  ( end - end % 100) / 100 ) * 2)
                }
                for(let i=start_i; i < 7; i++) {
                    let start = time_to_number( time_hour_start , time_minute_start ) 
                    let end = time_to_number(  time_hour_end, time_minute_end) - time_to_number( time_hour_start ,time_minute_start)
                    switch (i) {
                        case 0:
                            this.day_7.push({ID: this.unique ,RID: rid , text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2, colors: color_id   })
                            break
                        case 1:
                            this.day_1.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 2:
                            this.day_2.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 3:
                            this.day_3.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 4:
                            this.day_4.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 5:
                            this.day_5.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 6:
                            this.day_6.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id  })
                            break
                    }
                    this.unique += 1
                    this.segregate_column(i,start/24, end + (  ( end - end % 100) / 100 ) * 2)
                                                     
                }    
            }
            else if (day_start.getTime() < day_end.getTime()) 
            {
                this.multi_days.push({text: title, 
                                    time_start: time_to_text(time_hour_start, time_minute_start),
                                    time_end:time_to_text(time_hour_end, time_minute_end),
                                    date_start: day_start,
                                    date_end: utlis.is_in_week(time_end, this.time_week) ? time_end: utilis.last_day_of_week(day_start),
                                    colors: color_id,
                                    RID: rid
                                    })
                
                if (this.multi_days.length > 3)
                utilis.from_date_to_week(day_start, utlis.is_in_week(time_end, this.time_week) ? time_end: utilis.last_day_of_week(day_start)).forEach( e => {
                    switch (e.getDay()) {
                        case 0:
                            this.multi_days_index[6] += 1
                            break
                        case 1:
                            this.multi_days_index[0] += 1
                            break
                        case 2:
                            this.multi_days_index[1] += 1
                            break
                        case 3:
                            this.multi_days_index[2] += 1
                            break
                        case 4:
                            this.multi_days_index[3] += 1
                            break
                        case 5:
                            this.multi_days_index[4] += 1
                            break
                        case 6:
                            this.multi_days_index[5] += 1
                            break
                    }
                })
            } else if (day_start.getTime() === day_end.getTime() && utlis.is_in_week(day_start, this.time_week)) {
                // console.log('jest')
                let start = time_to_number( time_hour_start , time_minute_start ) 
                let end = time_to_number(  time_hour_end, time_minute_end) - time_to_number( time_hour_start ,time_minute_start) 
                if (utlis.is_in_week(day_start, this.time_week))
                {
                    // console.log('dupa')
                    switch (day_start.getDay()) {
                        case 0:
                            this.day_7.push({ID: this.unique ,RID: rid , text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2, colors: color_id   })
                            break
                        case 1:
                            this.day_1.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 2:
                            this.day_2.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 3:
                            this.day_3.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 4:
                            this.day_4.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 5:
                            this.day_5.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id   })
                            break
                        case 6:
                            this.day_6.push({ID: this.unique ,RID: rid ,text: title, time_start: start/ 24, time_end: end + (  ( end - end % 100) / 100 ) * 2 , colors: color_id  })
                            break
                    }
                    this.unique += 1
                    this.segregate_column(day_start.getDay(),start/24, end + (  ( end - end % 100) / 100 ) * 2)
                }
            
            }
        },
        to_timeline() {
            this.$refs.window_cal.scrollTo(0, this.$refs['timeline'].offsetTop)
        },
        to_week(date_time) {
            let vm = this
            this.clear_cal()
            function add_day(czas) {
                // console.log(czas.getDay(), czas)
                switch (czas.getDay()) {
                    case 0:
                        vm.$refs.day_head_7.innerHTML = "Niedz., " + czas.getDate()
                        break
                    case 1:
                        vm.$refs.day_head_1.innerHTML = "Pon., " + czas.getDate()
                        break
                    case 2:
                        vm.$refs.day_head_2.innerHTML = "Wt., " + czas.getDate()
                        break
                    case 3:
                        vm.$refs.day_head_3.innerHTML = "Śr., " + czas.getDate()
                        break
                    case 4:
                        vm.$refs.day_head_4.innerHTML = "Czw., " + czas.getDate()
                        break
                    case 5:
                        vm.$refs.day_head_5.innerHTML = "Pi., " + czas.getDate()
                        break
                    case 6:
                        vm.$refs.day_head_6.innerHTML = "Sob., " + czas.getDate()
                        break
                }
            }
            let times = new Date(date_time)
            this.time_week = new Date(date_time)
            times.setDate(times.getDate() - (times.getDay() == 0 ? 7 : times.getDay()) + 1)
            for(let i = 0; i < 7; i++) {
                add_day(times)
                times.setDate(times.getDate() + 1)
            }
        },
        show_more_button() {
            let vm = this
            if (!this.show_more_info) {
                this.show_more_info = true
                this.$nextTick(()=> {
                    vm.$refs.buton_info_more.parentElement.style.top = 'unset'
                    vm.$refs.buton_info_more.parentElement.style.bottom = '10px'
                    vm.$refs.buton_info_more.style.transform = 'rotate(180deg) translate(50%, 50%)'
                })
            } else {
                this.show_more_info = false
                this.$nextTick(()=> {
                    vm.$refs.buton_info_more.parentElement.style.top = ''
                    vm.$refs.buton_info_more.parentElement.style.bottom = ''
                    vm.$refs.buton_info_more.style.transform = ''
                })
            }
        },
        on_scroll_call(e, vm=this) {
            // console.log('scroll')
            // let vm = this
            vm.$nextTick(() => {
                vm.$refs.cal_haeder.scrollLeft = e.target.scrollLeft - 10
                if (vm.$refs.cal_haeder.scrollLeft > 0) {
                    document.querySelector('.calendar_time_hours').style.position = 'fixed'
                    if (window.localStorage.getItem('DarkMode') == 'true') document.querySelector('.calendar_time_hours').style.backgroundColor = '#18191A'
                    else document.querySelector('.calendar_time_hours').style.backgroundColor = 'white'
                    document.querySelector('.calendar_time_hours').style.zIndex = '3'
                    document.querySelector('.calendar_time_hours').style.paddingBottom= '500px'
                    document.querySelector('.calendar_time_hours').style.borderLeft = '1px solid #ececec'
                    document.querySelector('#calendar_header_empty').style.display = 'none'
                    if (document.querySelector('.clendar_mutli_days_events')) document.querySelector('.clendar_mutli_days_events').style.left = '0px'
                    document.querySelector('.calendar_time_hours').scrollTop = e.target.scrollTop
                } else {
                    document.querySelector('.calendar_time_hours').style.position = ''
                    document.querySelector('.calendar_time_hours').style.backgroundColor = ''
                    document.querySelector('.calendar_time_hours').style.zIndex = ''
                    document.querySelector('.calendar_time_hours').style.paddingBottom= ''
                    document.querySelector('.calendar_time_hours').style.borderLeft = ''
                    if (document.querySelector('.clendar_mutli_days_events')) document.querySelector('.clendar_mutli_days_events').style.left = ''
                    document.querySelector('#calendar_header_empty').style.display = ''
                }
            })
            
        },
        click_ev(id) {
            // console.log(id)
            this.$root.$refs.show_info_pop.download_data(id)
            this.$root.$refs.main.show_info_ev_pop()
        },
        mouse_over_ev(evs) {
            document.querySelectorAll(".calendar_time_day_item").forEach(e=> {
                e.style.opacity = '0.5'
            })
            // console.log(evs)
            evs.currentTarget.style.opacity = ''
            // evs.style.opacity = '1'
        },
        mouse_leave() {
            document.querySelectorAll(".calendar_time_day_item").forEach(e=> {
                e.style.opacity = ''
            })
        }
    },
    computed: {
        long_days() {
            let vm = this 
            return this.multi_days.filter((v,i) => {
                if (!vm.show_more_info) {
                    if (i < 3 && v !== undefined) return v
                } else return v                
            })
        }
    },
    created: function() {

        this.$root.$refs.calendar = this

    },
    mounted:function() {
        // let vm = this
        setInterval(() => {
            let date = new Date();
            function time_to_number(hour, minutes) {return ((hour * 100) + (((minutes * 100) / 6) / 10))}
            // console.log(time_to_number(date.getHours(), date.getMinutes()) / 24)
            this.time_top = time_to_number(date.getHours(), date.getMinutes()) / 24
            if (!this.times) {
                this.to_timeline()
                this.times = true
            }
        }, 100)
        this.$refs.scroll_cal.scrollElement.addEventListener(
            "scroll",
            this.on_scroll_call
        );
        // this.to_week(new Date())

    }
})
</script>

<style scoped>

    .main_window {
        position: relative;
        width: 100%;
        height: 94%;
    }

    .calendar_header {
        position: relative;
        width: 100%;
        min-height: 50px;
        max-height: 400px;
        box-sizing: content-box;
        /* border: 1px solid red; */
        border-bottom: 1px solid #d0d0d0;
        /* display: flex;
        flex-direction: row; */
        margin-bottom: 5px;
        transition: 1s;
        overflow: hidden;
    }

    .calendar_header_days {
        position: relative;
        display: block;
        display: flex;
        flex-direction: row;
    }

    .clendar_mutli_days_events {
        direction: block;
        position: relative;
        width: 1400px;
        left: 50px;
        padding-top: 5px;
        /* padding-bottom: 20px; */
        /* transform: translate(-50%, -50%); */
        /* border: 1px solid red; */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .mulit_event_days {
        position: relative;
        width: 100%;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .clendar_mutli_days_event_item {
        position: relative;
        width: 100%;
        height: 25px;
        /* background-color: rgb(45, 45, 45); */
        color: white;
        margin-bottom: 10px;
        border-radius: 5px;
        -webkit-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        cursor: pointer;
    }

    .clendar_mutli_days_events_line {
        position: absolute;
        display: block;
        border-right: 1px solid #d0d0d0;
        width: 1px;
        height: 100%;
        top: 0px;
    }

    .clendar_mutli_days_event_item a {
        position: relative;
        display: block;
        width: 80%;
        height: 100%;
        left: 10px;
    }

    .clendar_mutli_days_events_show_more {
        position: absolute;
        background: transparent;
        outline: none;
        border: none;
        cursor: pointer;
        width: 35px;
        height: 35px;
        top: 75px;
        left: -42px;
    }

    .clendar_mutli_days_events_show_more svg {
        position: relative;
        display: block;
        width: 45px;
        height: 45px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .clendar_mutli_days_events_show_more:hover{
        background-color: rgb(45, 45, 45);
        border-radius: 15px;
        fill: white;
    }

    .more_info_space {
        position: relative;
        display: block;
        width: 100%;
        height: 20px;
    }

    .info_more {
        position: absolute;
        width: 200px;
        height: 20px;
        bottom: 0px;
        color: rgb(45, 45, 45);
        text-align: center;
    }

    .info_more a {
        position: relative;
        display: block;
        top: 50%;
        transform: translate(0, -50%);
        cursor: pointer;
    }

    .info_more a:hover {
        text-decoration: underline;
    }

    .calendar_window {
        position: relative;
        max-width: 100%;
        /* min-height: 300px; */
        /* max-height: 100%; */
        /* height: 100%; */
        /* border: 1px solid green; */
        display: flex;
        flex-direction: row;
        /* overflow-y: auto; */
    }

    .calendar_time_hours {
        width: 50px;
        height: 100%;
        /* border: 1px solid purple; */
        border-right: 1px solid #d0d0d0;
        flex-shrink: 0;
        overflow: hidden;
        box-sizing: border-box;
    }

    #calendar_header_empty {
        width: 50px;
        height: 100%;
        flex-shrink: 0;
    }

    .calendar_header_item {
        position: relative;
        width: 200px;
        height: 100%;
        /* border: 1px solid red; */
        flex-shrink: 0;
    }

    .calendar_header_item a {
        position: relative;
        text-align: center;
        line-height: 50px;
        display: block;
        width: 90%;
        height: 90%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, 0%);
    }

    .calendar_time_hours_item {
        position: relative;
        width: 100%;
        height: 100px;
        border-top: 1px solid transparent;
        border-bottom: 1px solid transparent;
    }
    
    .calendar_time_hours_item a {
        display: block;
        position: absolute;
        text-align: center;
        line-height: 51px;
        width: 100%;
        height: 50%;
        left: 50%;
        top: -25px;
        transform: translate(-50%, 0);
    }

    .calendar_time_day {
        position: relative;
        width: 200px;
        height: 100%;
        /* padding-top: 50px; */
        /* border: 1px solid springgreen; */
        box-sizing: border-box;
        margin-bottom: 250px;
    }

    .calendar_time_day_block {
        width: 200px;
        height: 50px;
        box-sizing: content-box;
        border-right: 1px solid #ececec;
        border-bottom: 1px solid #ececec;
    }

    .calendar_time_day_item {
        position: absolute;
        /* background-color: rgb(45, 45, 45); */
        width: 180px;
        left: 50%;
        transform: translate(-50%, 0);
        color: white;
        height: 102px;
        top: 20%;
        cursor: pointer;
        border-radius: 5px;
        -webkit-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
    }

    .calendar_time_day_item b {
        position: relative;
        display: block;
        width: 95%;
        left: 50%;
        transform: translate(-50%, 0);
        margin-top: 5px;
        overflow: hidden;
    }

    .calendar_time_day_item a {
        text-align: left;
        position: relative;
        display: block;
        width: 95%;
        left: 50%;
        /* top: 50%; */
        transform: translate(-50%, 0);
    }

    .calendar_timeline {
        position: absolute;
        width: 100%;
        /* left: ; */
        height: 1px;
        background-color: red;
    }

    .clolor_1 {
        background-color: rgba(45, 45, 45, .5);
        border: 3px solid rgb(45, 45, 45);
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;        
    }
    .clolor_2 {
        background-color: #d5000088;
        border: 3px solid #d50000;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;        
    }
    .clolor_3 {
        background-color: #06c8;
        border: 3px solid #06c;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;        
    }
    .clolor_4 {
        background-color: #008a0088;
        border: 3px solid #008a00;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
    .clolor_5 {
        background-color: #b2b20088;
        border: 3px solid #ebeb17;

        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;        
    }
    .clolor_6 {
        background-color: #8d1bff88;
        border: 3px solid #8d1bff;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;

    }

</style>