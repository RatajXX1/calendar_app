<template>
    <div ref="main_background" class="main_view_bar">
        <div class="main_view_bar_item_list">
            <div @click="buttons_click(1)" class="main_view_bar_item">
                <div class="main_view_bar_item_logo">
                    <img class="avata_bar" :src='image_prof_path'/>
                </div>
                <a>{{user_name_login}}</a>
            </div>
            <div class="main_view_bar_line"></div>
            <div @click="buttons_click(4)" class="main_view_bar_item">
                <div class="main_view_bar_item_icon">
                    <svg enable-background="new 0 0 48 48"  id="Layer_1" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path clip-rule="evenodd" d="M43,43H5c-2.209,0-4-1.791-4-4V9c0-2.209,1.791-4,4-4h38c2.209,0,4,1.791,4,4v30  C47,41.209,45.209,43,43,43z M45,9c0-1.104-0.896-2-2-2H5C3.896,7,3,7.896,3,9v6h42V9z M45,17H3v22c0,1.104,0.896,2,2,2h38  c1.104,0,2-0.896,2-2V17z M41,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C42,30.553,41.553,31,41,31z M41,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C42,23.553,41.553,24,41,24z M33,31h-2c-0.552,0-1-0.447-1-1v-2c0-0.552,0.448-1,1-1h2c0.553,0,1,0.448,1,1v2  C34,30.553,33.553,31,33,31z M33,24h-2c-0.552,0-1-0.447-1-1v-2c0-0.553,0.448-1,1-1h2c0.553,0,1,0.447,1,1v2  C34,23.553,33.553,24,33,24z M25,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C26,30.553,25.553,31,25,31z M25,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C26,23.553,25.553,24,25,24z M17,38h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,37.553,17.553,38,17,38z M17,31h-2c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2  C18,30.553,17.553,31,17,31z M17,24h-2c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2  C18,23.553,17.553,24,17,24z M9,38H7c-0.553,0-1-0.447-1-1v-2c0-0.553,0.447-1,1-1h2c0.553,0,1,0.447,1,1v2C10,37.553,9.553,38,9,38  z M9,31H7c-0.553,0-1-0.447-1-1v-2c0-0.552,0.447-1,1-1h2c0.553,0,1,0.448,1,1v2C10,30.553,9.553,31,9,31z M23,34h2  c0.553,0,1,0.447,1,1v2c0,0.553-0.447,1-1,1h-2c-0.553,0-1-0.447-1-1v-2C22,34.447,22.447,34,23,34z" fill-rule="evenodd"/></svg>
                </div>
                <a>Kalendarze</a>
            </div>
            <div @click="buttons_click(3)" class="main_view_bar_item">
                <div class="main_view_bar_item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                </div>
                <a>Harmonogram</a>
            </div>
            <div  @click="buttons_click(5)" v-show="menage" class="main_view_bar_item">
                <div class="main_view_bar_item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-kanban" viewBox="0 0 16 16">
                    <path d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z"/>
                    <path d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z"/>
                    </svg>
                </div>
                <a>Zarządzaj</a>
            </div>
            <div @click="buttons_click(2)" class="main_view_bar_item">
                <div class="main_view_bar_item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                </div>
                <a>Ustawienia</a>
            </div>
        </div>
        <div class="maiv_bar_foot">
            <div class="main_view_bar_line"></div>
            <div @click="log_out_pop" class="main_view_bar_item">
                <div class="main_view_bar_item_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                </div>
                <a>Wyloguj się</a>
            </div>
        </div>
        <are_sure v-if="pop_sure" :text="'Czy na pewno chcesz sie wylogowac?'" @close_pop="log_out_pop" @accept="log_out"/>
    </div>
</template>

<script>

import are_sure from './windows/are_sure.vue'

import send from '../libs/send.js'

export default {
    name: 'menu_bar',
    data: function() {
        return {
            hide_lite: false,
            pop_sure: false,
            user_name_login: 'Unknow',
            image_prof_path: '',
            menage: true
        }
    },
    components: {
        are_sure
    },
    methods: {
        buttons_click(id) {
            if (id == 1) this.$root.$refs.main.show_pro()
            else if (id == 2) this.$root.$refs.main.show_set()
            else if (id == 3) {
                this.$root.$refs.sche_pop.clear_sch()
                this.$root.$refs.sche_pop.get_date()
                setTimeout(this.$root.$refs.sche_pop.setup_points(), 5000)
                this.$root.$refs.main.show_sch()
            }
            else if (id == 4) {
                this.$root.$refs.cal_set_view.user_id = this.$root.$refs.app_view.user_info['U_ID']
                this.$root.$refs.cal_set_view.cals = []
                this.$root.$refs.cal_set_view.get_data()
                this.$root.$refs.main.show_cal_pop()
            } else if (id == 5) {
                // this.$root.$refs.cal_set_view.user_id = this.$root.$refs.app_view.user_info['U_ID']
                // this.$root.$refs.cal_set_view.cals = []
                this.$root.$refs.user_manage.get_data()
                this.$root.$refs.main.show_user_cal_pop ()
            }
        },
        log_out_pop() {
            if (!this.pop_sure) this.pop_sure = true
            else this.pop_sure = false
        },
        log_out() {
            let vm = this
            send.send_get(this.$root.$refs.app_view.url_path + 'api/Users/log_out.php', function(resp) {
                console.log(resp.responseText)
                vm.$root.$refs.settings.foce_turn_off()
                vm.$root.$refs.login_page_view.login_loading = false
                vm.$root.$refs.app_view.login_page = true
                window.localStorage.removeItem("SID")
            }, function() {})
        },
        lite_version() {
            if (!this.hide_lite)
            {
                this.$refs.main_background.querySelectorAll(".main_view_bar_item a").forEach(element => {
                    element.style.display='none'
                });
                this.hide_lite = true
            } else {
                setTimeout( () => {this.$refs.main_background.querySelectorAll(".main_view_bar_item a").forEach(element => {
                    element.style.display=''
                })}, 700)
                this.hide_lite = false
            }
            this.$emit('lite')
        }
    },  
    created() {
        this.$root.$refs.menu_bar = this
        
    }
}
</script>

<style scoped>

    .main_view_bar {
        position: relative;
        width: 100%;
        height: 100%;
        /* background-color: #ececec; */
        border-right: 1px solid #ececec;
    }
    

    .main_view_bar_item_list {
        position: relative;
        width: 100%;
        top: 50px;
    }

    .main_view_bar_item {
        position: relative;
        width: 90%;
        height: 50px;
        display: flex;
        flex-direction: row;
        left: 50%;
        transform: translate(-50%, 0);
        /* background-color: #d0d0d0; */
        border-radius: 25px;
        cursor: pointer;
        margin-bottom: 5px;
        transition: .5s;

        /* border: 1px solid gray; */
    }

    .main_view_bar_item:hover {
        background-color: #ececec;
    }

    .main_view_bar_item a {
        position: relative;
        display: block;
        line-height: 50px;
        margin-left: 10px;
    }

    .main_view_bar_line {
        position: relative;
        width: 70%;
        height: 1px;
        background-color: #ececec;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 10px;
        margin-top: 10px;
    }

    .main_view_bar_item_logo {
        position: relative;
        width: 40px;
        height: 40px;
        border: 1px solid rgb(45, 45, 45);
        border-radius: 25px;
        margin-left: 10px;
        overflow: hidden;
        top: 50%;
        transform: translate(0 ,-50%);
    }

    .main_view_bar_item_icon {
        position: relative;
        width: 40px;
        height: 40px;
        /* border: 1px solid rgb(45, 45, 45); */
        /* border-radius: 25px; */
        margin-left: 10px;
        overflow: hidden;
        top: 50%;
        transform: translate(0 ,-50%);
    }

    .main_view_bar_item_icon svg {
        position: absolute;
        display: block;
        width: 60%;
        height: 60%;
        /* height: auto; */
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .main_view_bar_item_logo img {
        background-color: #d0d0d0;
        position: absolute;
        display: block;
        width: 100%;
        height: auto;

    }

    .maiv_bar_foot {
        position: absolute;
        width: 100%;
        bottom: 30px;
    }


  .hide_text_anim {
    animation-name: hide_text;
    animation-duration: 1s;
    animation-iteration-count: 1;
    animation-direction: normal;
    animation-fill-mode: forwards;
  }

  @keyframes hide_text {
    0% {
        display: block;
        opacity: 1;
    }

    100% {
        opacity: 0;
        display: none;
    }
  }

</style>