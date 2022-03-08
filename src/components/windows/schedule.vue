<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Harmonogram</h1>
                    <div class="button_header_year">
                        <button v-on:click="change_yaer(1)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg>
                        </button>
                        <h1>{{year_date}}</h1>
                        <button v-on:click="change_yaer(2)">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="pop_view_line"></div>
                <simplebar style="width: 100%; height: 88%; outline: none;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none; -moz-user-select: none;-ms-user-select: none;user-select: none;" ref="scroll_cal" data-simplebar-auto-hide="false" >
                    <div class="pop_view_scrol_view">
                        <div class="pop_view_scrol_view_item">
                            <div class="liste_event_month">
                                <h3 ref="month1">Styczen</h3>
                                <h3 id="sch_month_2" ref="month2">Luty</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_3" ref="month3">Marzec</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_4" ref="month4">Kwiecień</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_5" ref="month5">Maj</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_6" ref="month6">Czerwiec</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_7" ref="month7">Lipiec</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_8" ref="month8">Śierpień</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_9" ref="month9">Wrzesień</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_10" ref="month10">Październik</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_11" ref="month11">Listopad</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                                <h3 id="sch_month_12" ref="month12">Grudzien</h3>
                                <!-- <a>Brak wydarzeń</a> -->
                            </div>
                        </div>
                    </div>
                </simplebar>
                
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" @click="close_pop">Zamknij</button>
            </div>
        </div>
        <loading_pop :theme_dark="true" v-show="loading_show"/>
    </div>
</template>


<script>
import loading_pop from './loading_pop.vue'

import send from '../../libs/send.js'

import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';
import $ from "jquery";
// import utilis from '../../libs/utilis.js'

export default {
    name: 'schedule',
    data: function() {
        return {
            year_date: new Date().getFullYear(),
            loading_show: false,
            Observe : null,
            maked_data :{
                2: false,
                3: false,
                4: false,
                5: false,
                6: false,
                7: false,
                8: false,
                9: false,
                10: false,
                11: false,
                12: false,
            }
        }
    },
    components: {
        simplebar,
        loading_pop
    },
    methods: {
        clear_days() {
            document.querySelectorAll(".liste_event_month_item").forEach(e=>{e.remove()})
        },
        close_pop() {
            this.$root.$refs.main.show_sch()
        },
        change_yaer(dir) {
            if (dir == 1) {
                this.year_date -= 1
                this.clear_sch()
                this.get_date(1)
                setTimeout(this.setup_points(), 5000)
            } else if (dir == 2) {
                this.year_date += 1
                this.clear_sch()
                this.get_date(1)
                setTimeout(this.setup_points(), 5000)
            }
        },
        get_date( month=1) {
            let vm = this
            this.loading_show = true
            const get_lenght = 25
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

            function parse_time(time_string) {
                return 'E' + time_string.split(' ')[0].replaceAll('-', '_')
            } 

            function un_parse_time(time_string) {
                return time_string.replaceAll('E', '').split('_')
            }

            function leapYear(year)
            {
                return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
            }

            function sort_month(month_id, vm) {
                let items = [...document.querySelectorAll('[id^="sch_event_' + month_id.toString() +'_"]')]
                items.sort((a,b) => {
                    return parseInt(a.id.split('_')[3])>parseInt(b.id.split('_')[3])?1:-1
                })
                vm.$nextTick(() => {
                    switch(month_id) {
                        case 1:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month1.parentNode.insertBefore(e, vm.$refs.month1.nextSibling)
                            })
                            break
                        case 2:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month2.parentNode.insertBefore(e, vm.$refs.month2.nextSibling)
                            })
                            break
                        case 3:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month3.parentNode.insertBefore(e, vm.$refs.month3.nextSibling)
                            })
                            break
                        case 4:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month4.parentNode.insertBefore(e, vm.$refs.month4.nextSibling)
                            })
                            break
                        case 5:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month5.parentNode.insertBefore(e, vm.$refs.month5.nextSibling)
                            })
                            break
                        case 6:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month6.parentNode.insertBefore(e, vm.$refs.month6.nextSibling)
                            })
                            break
                        case 7:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month7.parentNode.insertBefore(e, vm.$refs.month7.nextSibling)
                            })
                            break
                        case 8:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month8.parentNode.insertBefore(e, vm.$refs.month8.nextSibling)
                            })
                            break
                        case 9:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month9.parentNode.insertBefore(e, vm.$refs.month9.nextSibling)
                            })
                            break
                        case 10:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month10.parentNode.insertBefore(e, vm.$refs.month10.nextSibling)
                            })
                            break
                        case 11:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month11.parentNode.insertBefore(e, vm.$refs.month11.nextSibling)
                            })
                            break
                        case 12:
                            items.slice().reverse().forEach(e => {
                                vm.$refs.month12.parentNode.insertBefore(e, vm.$refs.month12.nextSibling)
                            })
                            break
                    }
                })
                // return items
            }
            let data = {}
            let special_event = []
            let adde=false

            function add_this() {
                // console.log('doodanie')
                let ids = []
                // let iterator = 0
                let days_names = {
                    0: "Ni",
                    1: "Po",
                    2: "Wt",
                    3: "Śr",
                    4: "Cz",
                    5: "Pi",
                    6: "So",
                }
                // let lenghts = Object.entries(data).length
                // let lenghts_spec = special_event.length
                // console.log('specila', special_event.length)
                special_event.forEach( value => {
                    vm.$nextTick( () => {
                        let timed = un_parse_time(parse_time(value['Time_start']))
                        let time_date = new Date(timed[0],timed[1] -1,timed[2])
                        let loop = 1
                        if (value['Mode'] == 2) { // co tydzien
                            loop = 52
                            time_date.setMonth(1)
                        } else if (value['Mode'] == 3) { // co miesiac
                            loop = 12
                            time_date.setMonth(1)
                            time_date.setDate(1)
                        }else if (value['Mode'] == 4) { // co rok
                            time_date.setFullYear(vm.year_date)
                        }else if (value['Mode'] == 5) { // co dzienie 
                        // console.log('day')
                            if (leapYear(vm.year_date)) loop = 366
                            else loop = 365
                            time_date.setMonth(0)
                            time_date.setDate(1)
                        }
                        
                        for (let i = 1; i <= loop; i++) {
                            if (value['Mode'] == 2) { // co tydzien
                                time_date.setDate(time_date.getDate() + 7)
                            } else if (value['Mode'] == 3) { // co miesiac
                                time_date.setMonth(time_date.getMonth() + 1)
                            }else if (value['Mode'] == 5) { // co dzienie 
                                time_date.setDate(time_date.getDate() + 1)
                            }
                            if (!document.body.contains(document.querySelector(`#sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}`))) {
                                let d = `<div id="sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}" class="liste_event_month_item">
                                    <div class="liste_event_month_item_time_widget">
                                        <p>${days_names[time_date.getDay()]}<br>${time_date.getDate()}</p> 
                                    </div>                                   
                                </div>`
                                let div = document.createElement('div')
                                // let ids = []
                                div.innerHTML = d.trim()
                                // value.forEach(e => {
                                if (!ids.includes(value["ID"]) ) ids.push(value['ID'])
                                div.querySelector('.liste_event_month_item').innerHTML += `                                
                                <div class="liste_event_month_item_events">
                                    <div id="sch_event_bt_${time_date.getMonth() + 1}_${value['ID']}" class="liste_event_month_item_events_item  ${'clolor_' + value['colors']} ">
                                        <p>${value['title']}</p>
                                        <p>${value['Time_start'].split(' ')[1].split(':')[0] + ':' + value['Time_start'].split(' ')[1].split(':')[1]} - ${value['Time_end'].split(' ')[1].split(':')[0] + ':' + value['Time_end'].split(' ')[1].split(':')[1]}</p>
                                    </div>
                                </div> `
                                // })
                                // console.log('MM',time_date.getMonth() + 1)
                                // vm.$nextTick(() => {
                                // iterator += 1
                                switch(time_date.getMonth() + 1) {
                                    case 1:
                                        vm.$refs.month1.parentNode.insertBefore(div.firstChild, vm.$refs.month1.nextSibling)
                                        break
                                    case 2:
                                        vm.$refs.month2.parentNode.insertBefore(div.firstChild, vm.$refs.month2.nextSibling)
                                        break
                                    case 3:
                                        vm.$refs.month3.parentNode.insertBefore(div.firstChild, vm.$refs.month3.nextSibling)
                                        break
                                    case 4:
                                        vm.$refs.month4.parentNode.insertBefore(div.firstChild, vm.$refs.month4.nextSibling)
                                        break
                                    case 5:
                                        vm.$refs.month5.parentNode.insertBefore(div.firstChild, vm.$refs.month5.nextSibling)
                                        break
                                    case 6:
                                        vm.$refs.month6.parentNode.insertBefore(div.firstChild, vm.$refs.month6.nextSibling)
                                        break
                                    case 7:
                                        vm.$refs.month7.parentNode.insertBefore(div.firstChild, vm.$refs.month7.nextSibling)
                                        break
                                    case 8:
                                        vm.$refs.month8.parentNode.insertBefore(div.firstChild, vm.$refs.month8.nextSibling)
                                        break
                                    case 9:
                                        vm.$refs.month9.parentNode.insertBefore(div.firstChild, vm.$refs.month9.nextSibling)
                                        break
                                    case 10:
                                        vm.$refs.month10.parentNode.insertBefore(div.firstChild, vm.$refs.month10.nextSibling)
                                        break
                                    case 11:
                                        vm.$refs.month11.parentNode.insertBefore(div.firstChild, vm.$refs.month11.nextSibling)
                                        break
                                    case 12:
                                        vm.$refs.month12.parentNode.insertBefore(div.firstChild, vm.$refs.month12.nextSibling)
                                        break
                                }
                                    
                                // if (iterator == lenghts_spec) {
                                //     // console.log(ids)
                                //     ids.forEach(e => {
                                //         document.querySelectorAll('#sch_event_bt_' + time_date.getMonth() + 1 + '_' + e).forEach(d=>{
                                //             d.addEventListener("click", function() {
                                //                 vm.click_ev(e, vm)
                                //             })
                                //         })
                                //     })                                        
                                // }
                                sort_month(time_date.getMonth() + 1, vm)  
                                                                                                        
                                // })
                            } else {
                                // value.forEach(e => {
                                let div = document.querySelector(`#sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}`)
                                if (!ids.includes(value["ID"]) ) ids.push(value['ID'])
                                // iterator += 1
                                let divs  = document.createElement('div')
                                divs.innerHTML = `                                
                                <div class="liste_event_month_item_events">
                                    <div id="sch_event_bt_${month}_${value['ID']}" class="liste_event_month_item_events_item  ${'clolor_' + value['colors']} ">
                                        <p>${value['title']}</p>
                                        <p>${value['Time_start'].split(' ')[1].split(':')[0] + ':' + value['Time_start'].split(' ')[1].split(':')[1]} - ${value['Time_end'].split(' ')[1].split(':')[0] + ':' + value['Time_end'].split(' ')[1].split(':')[1]}</p>
                                    </div>
                                </div> `.trim()
                                div.append(divs.firstChild)
                                    // console.log('dodanieX')
                                // })     
                                // if (iterator == lenghts_spec) {
                                //     console.log(ids)
                                //     ids.forEach(e => {
                                //         document.querySelectorAll('#sch_event_bt_' + month.toString() + '_' + e).forEach(d=>{
                                //             d.addEventListener("click", function() {
                                //                 vm.click_ev(e, vm)
                                //             })
                                //         })
                                //     })
                                //     ids = []                                     
                                // }
                                sort_month(time_date.getMonth() + 1, vm)                                             
                            }                                
                        }


                    })                    
                })
                for(let [key, value] of Object.entries(data)) {
                    vm.$nextTick( () => {
                        let timed = un_parse_time(key)
                        let time_date = new Date(timed[0],timed[1] -1,timed[2])
                        if (!document.body.contains(document.querySelector(`#sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}`))) {
                            let d = `<div id="sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}" class="liste_event_month_item">
                                <div class="liste_event_month_item_time_widget">
                                    <p>${days_names[time_date.getDay()]}<br>${time_date.getDate()}</p> 
                                </div>                                   
                            </div>`
                            let div = document.createElement('div')
                            // let ids = []
                            div.innerHTML = d.trim()
                            value.forEach(e => {
                                if (!ids.includes(e["ID"]) ) ids.push(e['ID'])
                                div.querySelector('.liste_event_month_item').innerHTML += `                                
                                <div class="liste_event_month_item_events">
                                    <div id="sch_event_bt_${month}_${e['ID']}" class="liste_event_month_item_events_item  ${'clolor_' + e['colors']} ">
                                        <p>${e['title']}</p>
                                        <p>${e['Time_start'].split(' ')[1].split(':')[0] + ':' + e['Time_start'].split(' ')[1].split(':')[1]} - ${e['Time_end'].split(' ')[1].split(':')[0] + ':' + e['Time_end'].split(' ')[1].split(':')[1]}</p>
                                    </div>
                                </div> `
                            })
                            vm.$nextTick(() => {
                                // iterator += 1
                                switch(time_date.getMonth() + 1) {
                                    case 1:
                                        vm.$refs.month1.parentNode.insertBefore(div.firstChild, vm.$refs.month1.nextSibling)
                                        break
                                    case 2:
                                        vm.$refs.month2.parentNode.insertBefore(div.firstChild, vm.$refs.month2.nextSibling)
                                        break
                                    case 3:
                                        vm.$refs.month3.parentNode.insertBefore(div.firstChild, vm.$refs.month3.nextSibling)
                                        break
                                    case 4:
                                        vm.$refs.month4.parentNode.insertBefore(div.firstChild, vm.$refs.month4.nextSibling)
                                        break
                                    case 5:
                                        vm.$refs.month5.parentNode.insertBefore(div.firstChild, vm.$refs.month5.nextSibling)
                                        break
                                    case 6:
                                        vm.$refs.month6.parentNode.insertBefore(div.firstChild, vm.$refs.month6.nextSibling)
                                        break
                                    case 7:
                                        vm.$refs.month7.parentNode.insertBefore(div.firstChild, vm.$refs.month7.nextSibling)
                                        break
                                    case 8:
                                        vm.$refs.month8.parentNode.insertBefore(div.firstChild, vm.$refs.month8.nextSibling)
                                        break
                                    case 9:
                                        vm.$refs.month9.parentNode.insertBefore(div.firstChild, vm.$refs.month9.nextSibling)
                                        break
                                    case 10:
                                        vm.$refs.month10.parentNode.insertBefore(div.firstChild, vm.$refs.month10.nextSibling)
                                        break
                                    case 11:
                                        vm.$refs.month11.parentNode.insertBefore(div.firstChild, vm.$refs.month11.nextSibling)
                                        break
                                    case 12:
                                        vm.$refs.month12.parentNode.insertBefore(div.firstChild, vm.$refs.month12.nextSibling)
                                        break
                                }
                                    
                                // if (iterator == lenghts) {
                                //     // console.log(ids)
                                //     ids.forEach(e => {
                                //         document.querySelectorAll('#sch_event_bt_' + month.toString() + '_' + e).forEach(d=>{
                                //             d.addEventListener("click", function() {
                                //                 vm.click_ev(e, vm)
                                //             })
                                //         })
                                //     })                                        
                                // }
                                document.querySelectorAll('[id^="sch_event_bt_"]').forEach(d=>{
                                    $(d).off()
                                    // console.log(d)
                                    $(d).click(function() {
                                        vm.click_ev($(d).attr('id').split("_")[4], vm)
                                    })

                                    // d.addEventListener("click", function() {
                                        
                                    // })
                                })                                
                                sort_month(time_date.getMonth() + 1, vm)  
                                                                                                    
                            })
                        } else {
                            value.forEach(e => {
                                let div = document.querySelector(`#sch_event_${time_date.getMonth() + 1}_${time_date.getDate()}`)
                                if (!ids.includes(e["ID"]) ) ids.push(e['ID'])
                                // iterator += 1
                                let divs  = document.createElement('div')
                                divs.innerHTML = `                                
                                <div class="liste_event_month_item_events">
                                    <div id="sch_event_bt_${month}_${e['ID']}" class="liste_event_month_item_events_item  ${'clolor_' + e['colors']} ">
                                        <p>${e['title']}</p>
                                        <p>${e['Time_start'].split(' ')[1].split(':')[0] + ':' + e['Time_start'].split(' ')[1].split(':')[1]} - ${e['Time_end'].split(' ')[1].split(':')[0] + ':' + e['Time_end'].split(' ')[1].split(':')[1]}</p>
                                    </div>
                                </div> `.trim()
                                div.append(divs.firstChild)
                                // console.log('dodanieX')
                            })     
                            // if (iterator == lenghts) {
                            //     console.log(ids)
                            //     ids.forEach(e => {
                            //         document.querySelectorAll('#sch_event_bt_' + month.toString() + '_' + e).forEach(d=>{
                            //             d.addEventListener("click", function() {
                            //                 vm.click_ev(e, vm)
                            //             })
                            //         })
                            //     })                                        
                            // }
                            
                            sort_month(time_date.getMonth() + 1, vm)  
                            document.querySelectorAll('[id^="sch_event_bt_"]').forEach(d=>{
                                $(d).off()
                                // console.log(d)
                                $(d).click(function() {
                                    vm.click_ev($(d).attr('id').split("_")[4], vm)
                                })

                                // d.addEventListener("click", function() {
                                    
                                // })
                            })                                                                       
                        }                                
                    })

                }
                vm.$nextTick(vm.$nextTick(() => {                               
                    // ids.forEach(e => {
                        // document.querySelectorAll('#sch_event_bt_' + month.toString() + '_' + e).forEach(d=>{
                        //     d.addEventListener("click", function() {
                        //         vm.click_ev(e, vm)
                        //     })
                        // })

                    // })
                    document.querySelectorAll('[id^="sch_event_bt_"]').forEach(d=>{
                        $(d).off()
                        // console.log(d)
                        $(d).click(function() {
                            vm.click_ev($(d).attr('id').split("_")[4], vm)
                        })

                        // d.addEventListener("click", function() {
                            
                        // })
                    })
                })  )
                if (!adde && document.querySelectorAll('[id^="sch_event_' + month +'_"]').length == 0) {
                    let div = document.createElement('div')
                    div.innerHTML = '<a>Brak wydarzeń</a>'
                    vm.$nextTick(() => {
                        switch(month) {
                            case 1:
                                vm.$refs.month1.parentNode.insertBefore(div.firstChild, vm.$refs.month1.nextSibling)
                                break
                            case 2:
                                vm.$refs.month2.parentNode.insertBefore(div.firstChild, vm.$refs.month2.nextSibling)
                                break
                            case 3:
                                vm.$refs.month3.parentNode.insertBefore(div.firstChild, vm.$refs.month3.nextSibling)
                                break
                            case 4:
                                vm.$refs.month4.parentNode.insertBefore(div.firstChild, vm.$refs.month4.nextSibling)
                                break
                            case 5:
                                vm.$refs.month5.parentNode.insertBefore(div.firstChild, vm.$refs.month5.nextSibling)
                                break
                            case 6:
                                vm.$refs.month6.parentNode.insertBefore(div.firstChild, vm.$refs.month6.nextSibling)
                                break
                            case 7:
                                vm.$refs.month7.parentNode.insertBefore(div.firstChild, vm.$refs.month7.nextSibling)
                                break
                            case 8:
                                vm.$refs.month8.parentNode.insertBefore(div.firstChild, vm.$refs.month8.nextSibling)
                                break
                            case 9:
                                vm.$refs.month9.parentNode.insertBefore(div.firstChild, vm.$refs.month9.nextSibling)
                                break
                            case 10:
                                vm.$refs.month10.parentNode.insertBefore(div.firstChild, vm.$refs.month10.nextSibling)
                                break
                            case 11:
                                vm.$refs.month11.parentNode.insertBefore(div.firstChild, vm.$refs.month11.nextSibling)
                                break
                            case 12:
                                vm.$refs.month12.parentNode.insertBefore(div.firstChild, vm.$refs.month12.nextSibling)
                                break
                        }              
                    })

                }
            }

            function get_more(page=2) {
                // console.log(data)
                send.send_get(vm.$root.$refs.app_view.url_path + "api/events/schedule_ev.php?year=" + vm.year_date.toString() + "&month=" + month.toString() + "&page=" + page.toString(),
                function(resp) {
                    
                    // let lenghts = 0
                    if (is_json(resp.responseText)) {
                        JSON.parse(resp.responseText).forEach(e => {
                            if (is_empty(e)) {
                                if (month > 1 && e['Mode'] == 1) {
                                    // console.log(parse_time(e['Time_start']))
                                    if (e['Mode'] == 1) {
                                        if (!(parse_time(e['Time_start']) in data))
                                            data[parse_time(e['Time_start'])] = [{ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']}]
                                        else data[parse_time(e['Time_start'])].push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})                                    
                                    } else {
                                        special_event.push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})
                                    }
                                } else if (month == 1 && e['Mode'] > 1) {
                                    // console.log('doda')
                                    special_event.push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})                     
                                }
                            }
                        })

                        if (Object.entries(data).length > 0) {
                            // month_1
                            // lenghts = Object.entries(data).length 
            
                            page += 1
                            if (Object.entries(JSON.parse(resp.responseText)).length  + special_event.length >= get_lenght) get_more(page)
                            else add_this()
                        } else add_this()
                    } else add_this()
                    // vm.loading_show = false
                }, function() {
                   
                })
            }
            // let data = {}

            // let lenghts = 0
            send.send_get(this.$root.$refs.app_view.url_path  + "api/events/schedule_ev.php?year=" + this.year_date.toString() + "&month=" + month.toString(),
            function(resp) {
                if (is_json(resp.responseText)) {
                    JSON.parse(resp.responseText).forEach(e => {
                        if (is_empty(e)) {
                            if (month > 1 && e['Mode'] == 1) {
                                // console.log(parse_time(e['Time_start']))
                                if (e['Mode'] == 1) {
                                    if (!(parse_time(e['Time_start']) in data))
                                        data[parse_time(e['Time_start'])] = [{ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']}]
                                    else data[parse_time(e['Time_start'])].push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})                                    
                                } else {
                                    // console.log('doda')
                                    special_event.push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})
                                }
                            } else if (month == 1 && e['Mode'] > 1) {
                                console.log('doda')
                                special_event.push({ID: e['ID'] , title: e['Tittle'], Time_start: e['Time_start'], Time_end: e['time_end'], colors: e['Color'], Mode: e['Mode']})                     
                            }
                        }
                    })
                    
                    // console.log(data)
                    // console.log(Object.keys(data)) 
                    if (Object.entries(data).length + special_event.length > 0 ) {
                        // month_1
                        // console.log("jest ", Object.entries(JSON.parse(resp.responseText)).length)
                        adde = true
                        
                        if (Object.entries(JSON.parse(resp.responseText)).length  + special_event.length >= get_lenght) get_more()
                        else add_this()
                        vm.loading_show = false
                    } else vm.loading_show = false
                } else add_this()
                
                vm.loading_show = false
            }, function() {
                vm.loading_show = false
            })

        },
        setup_points() {
            // console.log("zrobiono XX")
            let vm = this
            this.$nextTick(() => {
                // console.log(vm.$refs.scrollElement)
                let options = {
                    root: vm.$refs.scroll_cal.scrollElement,
                    rootMargin: '0px',
                    threshold: [0, 0.25, 0.5, 0.75, 1]
                }

                const callback = (entries) => {
                    // console.log(observer)
                    entries.forEach( entry => {
                        if (entry.intersectionRatio > .20) {
                            if (vm.maked_data[parseInt(entry.target.id.split('_')[2])] == false) {
                                vm.get_date(parseInt(entry.target.id.split('_')[2]))
                                // console.log("pobieranie ", (entry.target.id.split('_')[2]) , vm.maked_data)
                                vm.maked_data[parseInt(entry.target.id.split('_')[2])] = true
                            }
                        }
                        // console.log('Widocznosc', entry.intersectionRatio)
                    })
                }

                vm.Observe = new IntersectionObserver(callback,options)
                vm.Observe.observe(vm.$refs.month2)
                vm.Observe.observe(vm.$refs.month3)
                vm.Observe.observe(vm.$refs.month4)
                vm.Observe.observe(vm.$refs.month5)
                vm.Observe.observe(vm.$refs.month6)
                vm.Observe.observe(vm.$refs.month7)
                vm.Observe.observe(vm.$refs.month8)
                vm.Observe.observe(vm.$refs.month9)
                vm.Observe.observe(vm.$refs.month10)
                vm.Observe.observe(vm.$refs.month11)
                vm.Observe.observe(vm.$refs.month12)
            })
            

        },
        async clear_sch() {
            this.Observe.disconnect()
            this.maked_data = {
                2: false,
                3: false,
                4: false,
                5: false,
                6: false,
                7: false,
                8: false,
                9: false,
                10: false,
                11: false,
                12: false,
            }
            // setTimeout(document.querySelectorAll('.liste_event_month a').forEach(e => {e.remove()}), 2000)
            let tab = document.querySelectorAll('.liste_event_month_item , .liste_event_month a')
            tab.forEach(e => {e.remove()})
            tab = document.querySelectorAll('.liste_event_month_item , .liste_event_month a')
            if (tab.length > 0) this.clear_days()
        },click_ev(id, vm) {
            // console.log(id)
            vm.$root.$refs.show_info_pop.download_data(id)
            vm.$root.$refs.main.show_info_ev_pop()
        }
    },
    mounted: function() {
        this.$root.$refs.sche_pop = this
        // this.get_date()
        this.setup_points()
    },
    created: function() {
        // this.clear_days()
        // this.get_date()
        
        
    }
}
</script>

<style>
    .liste_event_month_item {
        display: block;
        position: relative;
        width: 70%;
    }


    .liste_event_month_item_time_widget {
        display: block;
        position: absolute;
        top: 0px;
        left: 0px;
        width: 50px;        
        height: 50px;
        background-color: rgb(45, 45, 45);
        color: white;
        border-radius: 5px;
    }

    .liste_event_month_item_time_widget p {
        position: relative;
        display: block;
        margin: 0;
        width: 100%;
        text-align: center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .liste_event_month_item_events {
        position: relative;
        display: inline-block;
        width: 80%;
        padding-left: 10px;
        left: 50px;
    }

    .liste_event_month_item_events_item {
        width: 100%;
        height: 50px;
        /* background-color: rgb(45, 45, 45); */
        border-radius: 5px;
        padding-left: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        -webkit-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 10px -2px rgba(66, 68, 90, 1);
    }

    .liste_event_month_item_events_item p {
        position: relative;
        display: block;
        margin: 0;
        width: 100%;
        text-align: left;
        color: white;
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
        background-color: #ebeb1788;
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

    .pop_view_scrol_view {
        display: block;
        position: relative;
        width: 100%;
        height: 85%;
        overflow-y: auto;
    }

    .pop_view_scrol_view_item {
        display: block;
        position: relative;
    }

    .pop_view_scrol_view_item h1 {
        position: relative;
        display: block;
        margin: 0;
        color: rgb(45, 45, 45);
    }

    .liste_event_month {
        display: block;
        position: relative;
        width: 95%;
        float: right;
    }

    .liste_event_month h3 {
        position: relative;
        display: block;
        margin: 0;
        color: rgb(45, 45, 45);
    }
    
    .liste_event_month a {
        display: block;
        position: relative;
        width: 70%;
        /* float: right; */
        text-align: left;
        padding-left: 30px;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .liste_event_month_item {
        display: block;
        position: relative;
        width: 70%;
    }


    .liste_event_month_item_time_widget {
        display: block;
        position: absolute;
        top: 0px;
        left: 0px;
        width: 50px;        
        height: 50px;
        background-color: rgb(45, 45, 45);
        color: white;
        border-radius: 5px;
    }

    .liste_event_month_item_time_widget p {
        position: relative;
        display: block;
        margin: 0;
        width: 100%;
        text-align: center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .liste_event_month_item_events {
        position: relative;
        display: inline-block;
        width: 80%;
        padding-left: 10px;
        left: 50px;
    }

    .liste_event_month_item_events_item {
        width: 100%;
        height: 50px;
        /* background-color: rgb(45, 45, 45); */
        border-radius: 5px;
        padding-left: 5px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .liste_event_month_item_events_item p {
        position: relative;
        display: block;
        margin: 0;
        width: 100%;
        text-align: left;
        color: white;
    }


    .button_header_year {
        position: absolute;
        width: 150px;
        height: 30px;
        right: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .button_header_year button {
        position: relative;
        height: 35px;
        width: 35px;
        top: 50%;
        transform: translate(0, -50%);
        background-color: transparent;
        outline: none;
        border: none;
        cursor: pointer;
        transition: 1s;
        border-radius: 50%;
    }

    .button_header_year svg {
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        /* transition: 1s; */
    }

    .button_header_year button:hover {
        
        background-color: rgb(45, 45, 45);
        color: white;
        fill: #ececec;
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
            .pop_view_haeder {
                font-size: 1.3vh;
            }
            .pop_view {
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
        }
    }
</style>