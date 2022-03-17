<template>
    <div class="bar_main">
        <div class="bar_main_time">
            <div class="bar_main_time_date">
                <div v-bind:style="{'display': date_1}" v-on:click="open_cal" class="background_view_click"></div>
                <h1 @click="open_cal">{{text_date}}</h1>
                <pop_calendar ref="calnedar_com_1" @changecal="focused_on(1)" @clickcal="calendar_1" v-bind:style="{'display': date_1}"/>
            </div>
            <div v-show="!mobile_view" class="bar_main_time_change_time">
                <button @click="next_day(2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </button>
                <button @click="today_cal" style="top: 15%; width: 60px"><a>Dzisiaj</a></button>
                <button @click="next_day(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div @click="open_mode"  v-show="!mobile_view" class="calendar_mode">
            <a>{{text_mode_name}}</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg>

        </div>

        <div v-show="!mobile_view" class="bar_main_add_event">
            <button v-on:click="open_bar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <a>Dodaj do kalendarza</a> 
            </button>
        </div>
    </div>
</template>

<script>
// import add_event from './windows/add_event.vue'

import pop_calendar from './windows/pop_calendar.vue'
import utilis from '../libs/utilis.js'

export default {
    name: 'user_bar',
    data: function() {
        return {
            text_date: '17 - 23 Styczeń 2022',
            date_1: 'none',
            selected_date: new Date(),
            text_mode_name: 'tydzień',
            mobile_view: false
        }
    },
    components: {
        pop_calendar
    },
    methods: {
        open_cal() {
            if (this.date_1 == 'none') this.date_1 = 'block'
            else this.date_1 = 'none'
        },
        open_bar: function () {
            
            // console.log("test pop")
            this.$root.$refs.main.show_add()
        },
        focused_on(id) {
            console.log(id)
            // if (id == 1) this.$refs.date_intput_start.focus()
            // else this.$refs.date_intput_end.focus()
        },
        calendar_1(day, month, year) {
            let time = new Date(year, month, day)
            // console.log(time,vm)

            this.set_text_date(time)
            this.selected_date = new Date(year, month, day)
            // this.$root.$refs.calendar.to_week(time)
            this.$root.$refs.main.get_data(
                this.$root.$refs.main.active_cal,
                new Date(year, month, day)
            )
            // this.hide_all()
        },
        set_text_date(time_date) {
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
            try {
                if (this.$root.$refs.main.active_cal == 2) {
                    let week = utilis.get_first_and_last(time_date)
                    if (week[0].getMonth() == week[1].getMonth()) {
                        this.text_date = week[0].getDate().toString() + ' - ' + week[1].getDate().toString() + ' ' + month_name[time_date.getMonth()]
                    } else {
                        this.text_date = month_name[week[0].getMonth()] + ' ' + week[0].getDate().toString() + ' - ' + week[1].getDate().toString() + ' ' + month_name[week[1].getMonth()]
                    }
                } else {
                    this.text_date = time_date.getDate().toString() + ' ' + month_name[time_date.getMonth()] + ' ' + time_date.getFullYear().toString()
                }
            } catch (error) {
                let week = utilis.get_first_and_last(time_date)
                if (week[0].getMonth() == week[1].getMonth()) {
                    this.text_date = week[0].getDate().toString() + ' - ' + week[1].getDate().toString() + ' ' + month_name[time_date.getMonth()]
                } else {
                    this.text_date = month_name[week[0].getMonth()] + ' ' + week[0].getDate().toString() + ' - ' + week[1].getDate().toString() + ' ' + month_name[week[1].getMonth()]
                }
            }
        },
        today_cal() {
            this.selected_date = new Date()
            this.set_text_date(this.selected_date)
            this.$root.$refs.main.get_data(
                this.$root.$refs.main.active_cal,
                new Date(this.selected_date.getFullYear(), this.selected_date.getMonth(), this.selected_date.getDate())
            )
            // this.$root.$refs.calendar.to_week(new Date())
        },
        next_day(direction) {
            try {
                if (this.$root.$refs.main.active_cal == 2) {
                    if (direction == 1) this.selected_date.setDate(this.selected_date.getDate() + 7)
                    else this.selected_date.setDate(this.selected_date.getDate() - 7)
                    this.set_text_date(this.selected_date)
                } else {
                    if (direction == 1) this.selected_date.setDate(this.selected_date.getDate() + 1)
                    else this.selected_date.setDate(this.selected_date.getDate() - 1)
                    this.set_text_date(this.selected_date)
                }
                this.$root.$refs.main.get_data(
                    this.$root.$refs.main.active_cal,
                    new Date(this.selected_date)
                )
            } catch (error) {
                if (direction == 1) this.selected_date.setDate(this.selected_date.getDate() + 7)
                else this.selected_date.setDate(this.selected_date.getDate() - 7)
                this.set_text_date(this.selected_date)
                this.$root.$refs.main.get_data(
                    this.$root.$refs.main.active_cal,
                    new Date(this.selected_date)
                )
            }
        },
        open_mode() {
            if ( this.$root.$refs.cal_mode_sel.mode_display == 'none')  this.$root.$refs.cal_mode_sel.mode_display = 'block'
            else  this.$root.$refs.cal_mode_sel.mode_display = 'none'
        }
    },
    mounted: function() {
        this.set_text_date(this.selected_date)
    },
    created: function() {
        this.$root.$refs.user_bar = this
        this.set_text_date(this.selected_date)
    }
}
</script>

<style scoped>

    .bar_main {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .bar_main_time {
        position: absolute;
        left: 0px;
        /* float: left; */
        height: 100%;
        width: 600px;
        display: flex;
        flex-direction: row;
        justify-items: left;
    }

    .bar_main_time_change_time {
        margin-left: 30px;
        position: relative;
        height: 100%;
    }

    .bar_main_time_change_time button {
        position: relative;
        background-color: transparent;
        border: none;
        outline: none;
        cursor: pointer;
        height: 90%;
        width: 50px;
        top: 50%;
        transform: translate(0, -50%);
    }

    .bar_main_time_change_time a {
        text-align: center;
        display: block;
        width: 100%;
        /* height: 100%; */
        font-size: 16px;
    }

    .bar_main_time_change_time svg {
        /* display: block; */
        /* position: relative; */
        width: 100%;
        height: 100%;
        /* top: 50%; */
        /* left: 50%; */
        /* float: left; */
        /* transform: translate(-50%, -50%); */
    }

    .bar_main_time_date {
        position: relative;
        height: 100%;
        top: 0px;
        margin-left: 10px;
    }

    .bar_main_time_date h1 {
        position: relative;
        display: block;
        left: 0px;
        top: 15%;
        font-weight: lighter;
        /* top: 50%; */
        transform: translate(0, -50%);
        cursor: pointer;
    }
    
    .bar_main_time_date h1:hover {
        color: #d0d0d0;
    }
    
    .bar_main_add_event {
        position: relative;
        height: 100%;
        width: fit-content;
        float: right;
    }

    .bar_main_add_event button {
        position: relative;
        display: block;
        width: 180px;
        height: 70%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: none;
        outline: none;
        background-color: rgb(45, 45, 45);
        color: white;
        border-radius: 25px;
        cursor: pointer;
    }

    .bar_main_add_event a {
        font-size: 14px;
        text-align: center;
        line-height: 100%;
        float: right;
        padding-right: 5px;
    }

    .bar_main_add_event svg {
        display: block;
        position: absolute;
        width: 50px;
        height: 100%;
        top: 50%;
        left: 0px;
        /* float: left; */
        transform: translate(0, -50%);
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

    .calendar_mode {
        position: absolute;
        width: 95px;
        height: 32px;
        right: 200px;
        top: 50%;
        transform: translate(0, -50%);
        cursor: pointer;
        border: 1px solid rgb(45, 45, 45);
        border-radius: 5px;
    }

    .calendar_mode a {
        position: relative;
        display: block;
        margin-left: 5px;
        font-size: 17px;
        text-align: left;
        line-height: 32px;
        width: 90%;
        height: 100%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .calendar_mode svg {
        top: 6px;
        width: 20px;
        height: 20px;
        position: absolute;
        display: block;
        right: 5px;
    }

</style>
