<template>
    <div :style="{'display': mode_display}" @mouseleave="leave_mouse" class="calendar_mode_options_back">
        <div class="calendar_mode_options_back_main">
            <div @click="select_mode(1)" class="calendar_mode_options_back_main_item">
                <a>dzień</a>
            </div>
            <div @click="select_mode(2)" class="calendar_mode_options_back_main_item">
                <a>tydzień</a>
            </div>
            <!-- <div @click="select_mode(3)" class="calendar_mode_options_back_main_item">
                <a>miesiac</a>
            </div>
            <div @click="select_mode(4)" class="calendar_mode_options_back_main_item">
                <a>rok</a>
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'cal_mode',
    data: function() {
        return {
            mode_display: 'none'
        }
    },
    methods: {
        leave_mouse() {
            this.mode_display = 'none'
        },
        select_mode(id) {
            // console.log(id)
            this.$root.$refs.main.change_cal_mode(id)
            this.mode_display = 'none'
            if (id == 1)this.$root.$refs.user_bar.text_mode_name = 'dzień'
            else if (id == 2) this.$root.$refs.user_bar.text_mode_name = 'tydzień'
            else if (id == 3) this.$root.$refs.user_bar.text_mode_name = 'miesiąc'
            else if (id == 4) this.$root.$refs.user_bar.text_mode_name = 'rok'
        }
    },
    mounted: function() {
        this.$root.$refs.cal_mode_sel = this
    }
}
</script>


<style scoped>
    .calendar_mode_options_back {
        display: none;
        position: fixed;
        z-index: 2123;
        top: 15px;
        right: 223px;
        width: 150px;
        /* min-height: 50px; */
        height: 80px;
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

    .calendar_mode_options_back_main {
        position: relative;
        width: 85%;
        height: 95%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        overflow: auto; 
    }

    .calendar_mode_options_back_main_item {
        position: relative;
        cursor: pointer;
        height: 31px;
        width: 100%;
    }

    .calendar_mode_options_back_main_item:hover {
        background-color: rgb(45, 45, 45);
        color: white;
    }

    .calendar_mode_options_back_main_item a {
        position: relative;
        display: block;
        line-height: 31px;
        margin-left: 10%;
        white-space: nowrap;
    }
</style>