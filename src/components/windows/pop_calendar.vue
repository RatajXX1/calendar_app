<template>
    <div class="calendar_back">
        <div class="calendar_header">
            <button style="margin-left: 10px" @click="change_month(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
            </button>
            <a ref="calendar_header_widget">Styczeń 2022</a>
            <button style="margin-right: 10px" @click="change_month(2)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
            </button>
            <div class="calendar_line"></div>
        </div>
        <div class="calendar_view">
            <div ref="column_1" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Pn</a>
                </div>
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']"  class="calendar_view_day_column_item" v-for="index in day_1" :key="index.day_1">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_2" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Wt</a>
                </div>
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']" class="calendar_view_day_column_item" v-for="index in day_2" :key="index.day_2">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_3" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Śr</a>
                </div>                
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']" class="calendar_view_day_column_item" v-for="index in day_3" :key="index.day_3">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_4" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Cz</a>
                </div>                
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']" class="calendar_view_day_column_item" v-for="index in day_4" :key="index.day_4">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_5" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Pi</a>
                </div>
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']" class="calendar_view_day_column_item" v-for="index in day_5" :key="index.day_5">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_6" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>So</a>
                </div>
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']"  class="calendar_view_day_column_item" v-for="index in day_6" :key="index.day_6">
                    <a>{{index[0]}}</a>
                </div>
            </div>
            <div ref="column_7" class="calendar_view_day_column">
                <div class="calendar_view_day_column_item without_color">
                    <a>Ni</a>
                </div>
                <div @click="clicked_in_cal(index[0], index[1], index[2])" v-bind:class="[ index[0] == 0 ? 'hide_button' : '', index[0] == selected_day ? 'selected_day' : '']" class="calendar_view_day_column_item" v-for="index in day_7" :key="index.day_7">
                    <a>{{index[0]}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'calendar_pop',
    data: function() {
        return {
            actual_time : null,
            selected_time : new Date(),
            selected_day: 50,
            day_1 : [],
            day_2 : [],
            day_3 : [],
            day_4 : [],
            day_5 : [],
            day_6 : [],
            day_7 : [],
        }
    },
    methods: {
        set_data_widget(month, year) {

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

            this.$refs.calendar_header_widget.innerHTML = month_name[month] + ' ' + year.toString()
        },
        reset_calendar() {
            this.day_1 = []
            this.day_2 = []
            this.day_3 = []
            this.day_4 = []
            this.day_5 = []
            this.day_6 = []
            this.day_7 = []
        },
        show_days(datetime) {
            let vm = this
            function align_start(){
                let time_day = new Date(datetime.getFullYear(), datetime.getMonth(), 1).getDay()
                if (time_day == 0) time_day = 7
                for(let i = 1; i <= (time_day - 1); i++) {
                    switch (i) {
                        case 1:
                            vm.day_1.unshift([0, 0, 0])
                            break
                        case 2: 
                            vm.day_2.unshift([0, 0, 0])
                            break
                        case 3:
                            vm.day_3.unshift([0, 0, 0])
                            break
                        case 4:
                            vm.day_4.unshift([0, 0, 0])
                            break
                        case 5:
                            vm.day_5.unshift([0, 0, 0])
                            break
                        case 6:
                            vm.day_6.unshift([0, 0, 0])
                            break
                        case 7:
                            vm.day_7.unshift([0, 0, 0])
                            break
                    }
                }
            }
            // this.actual_time = datetime
            this.reset_calendar()
            this.set_data_widget(datetime.getMonth(), datetime.getFullYear())
            
            let datetime_1 = new Date(datetime.getFullYear(), datetime.getMonth(), 1)
            // console.log(datetime_1)
            datetime_1.setMonth(datetime.getMonth() + 1)
            datetime_1.setDate(0)
            // console.log(datetime_1.getDate())
            for(let i = 1; i <= datetime_1.getDate(); i++) {
                let time = new Date(datetime.getFullYear(), datetime.getMonth(), i)
                switch (time.getDay()) {
                    case 0:
                        this.day_7.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 1:
                        this.day_1.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 2:
                        this.day_2.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 3:
                        this.day_3.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 4:
                        this.day_4.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 5:
                        this.day_5.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 6:
                        this.day_6.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                    case 7:
                        this.day_7.push([i, datetime.getMonth(), datetime.getFullYear()])
                        break
                }
            }
            align_start()
            datetime_1.setMonth(datetime_1.getMonth() - 1)
        },
        set_selected(datetime) {
            this.selected_time = new Date(datetime)
            this.actual_time = new Date(datetime)
            // console.log(this.actual_time)
            if (this.actual_time.getMonth() == this.selected_time.getMonth() && this.actual_time.getFullYear() == this.selected_time.getFullYear()) this.selected_day = this.selected_time.getDate()
            else this.selected_day = 50
            this.show_days(this.actual_time)
        },
        change_month(direction) {
            if (direction == 1) direction = -1
            else if (direction == 2) direction = 1

            if (this.actual_time != null) {
                this.actual_time = new Date(this.actual_time.getFullYear(), this.actual_time.getMonth() + direction, 1)
                // console.log(this.actual_time)
                if (this.actual_time.getMonth() == this.selected_time.getMonth() && this.actual_time.getFullYear() == this.selected_time.getFullYear()) this.selected_day = this.selected_time.getDate()
                else this.selected_day = 50
                this.show_days(this.actual_time)
            }
            this.$emit('changecal')
        },
        clicked_in_cal(day, month, year) {
            this.$emit('clickcal', day, month, year, this)
        },
        view_to_start() {
            this.actual_time = new Date(this.selected_time)
            if (this.actual_time.getMonth() == this.selected_time.getMonth() && this.actual_time.getFullYear() == this.selected_time.getFullYear()) this.selected_day = this.selected_time.getDate()
            else this.selected_day = 50
            this.show_days(this.actual_time)
        },
        reset_cal(switeg=false) {
            let time = new Date()
            this.actual_time = time
            this.selected_time = new Date(time)
            if (this.actual_time.getMonth() == this.selected_time.getMonth() && this.actual_time.getFullYear() == this.selected_time.getFullYear()) this.selected_day = this.selected_time.getDate()
            else this.selected_day = 50
            this.show_days(time)
            if (switeg) this.$root.$refs.user_bar.set_text_date(time)
        }
    },created: function() {
        // this.$root.$refs.calendar_pop_bar = this
    },
    mounted: function() {
        let time = new Date()
        time.setHours(0,0,0,0)
        this.actual_time = time
        this.selected_time = new Date(time)
        if (this.actual_time.getMonth() == this.selected_time.getMonth() && this.actual_time.getFullYear() == this.selected_time.getFullYear()) this.selected_day = this.selected_time.getDate()
        else this.selected_day = 50
        this.show_days(time)

    }
}
</script>


<style scoped>

    .calendar_back {
        position: absolute;
        width: 250px;
        height: 270px;
        background-color: white ;
        z-index: 5;
        border-radius: 5px;
        -webkit-box-shadow: 0px 0px 18px -4px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 18px -4px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 18px -4px rgba(66, 68, 90, 1);
    }

    .calendar_header {
        position: relative;
        top: 10px;
        width: 100%;
        height: 25px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .calendar_header a {
        position: relative;
        display: block;
        text-align: center;
        width: 50%;
        line-height: 29px;
    }

    .calendar_header button {
        position: relative;
        width: 30px;
        height: 30px;
        background-color: transparent;
        outline: none;
        border: none;
        cursor: pointer;
        border-radius: 50%;
    }

    .calendar_header svg {
        position: relative;
        display: block;
        width: 35px;
        height: 35px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .calendar_header button:hover {
        background-color: rgb(45, 45, 45);
        color: white;
        fill: white;
    }

    .calendar_line {
        position: absolute;
        width: 90%;
        height: 1px;
        background-color: #ececec;
        bottom: -10px;
        left: 50%;
        transform: translate(-50%, 0);
    }

    .calendar_view {
        position: relative;
        width: 100%;
        margin-top: 25px;
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .calendar_view_day_column {
        position: relative;
        display: flex;
        height: 100%;
        width: 15%;
        flex-direction: column;
        justify-content: flex-start;
    }

    .calendar_view_day_column_item {
        position: relative;
        width: 100%;
        height: 30px;
        /* background-color: #ececec; */
        cursor: pointer;
        border-radius: 5px;
    }

    .calendar_view_day_column_item:hover {
        color: white;
        background-color: rgb(45, 45, 45);
    }

    .calendar_view_day_column_item a {
        position: relative;
        display: block;
        text-align: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .hide_button {
        color: transparent;
        background-color: transparent;
        cursor: unset;
        pointer-events: none;
    }

    .without_color {
        pointer-events: none;
        background-color: transparent;
    }

    .selected_day {
        background-color: #ececec;
    }


</style>