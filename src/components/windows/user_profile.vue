<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_input_header">
                    <div class="pop_view_input_header_profile">
                        <img :src='user_prof_path'/>
                        <div @click="select_profile" class="pop_view_input_header_profile_change"><a>Zmień</a></div>
                    </div>
                    <div class="pop_view_input_header_profile_info">
                        <a><b>{{user_name_login}}</b><span @click="pop_name">Zmień</span></a>
                        <a>{{user_mail_login}} <span @click="pop_email">Zmień</span></a>
                    </div>
                </div>
                <div class="pop_view_line"></div>
                <span style="display: block" @click="pop_pass">Zmień hasło</span>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" @click="close_pop">Zamknij</button>
            </div>
        </div>
        <select_photo v-if="select_image"/>
        <change_email v-if="change_email_pop" @close_pop="pop_email"/>
        <pass_form v-if="change_pass_pop" @close_pop="pop_pass"/>
        <name_che v-if="change_name_pop" @close_pop="pop_name"/>
    </div>
</template>

<script>
import select_photo from './select_photo.vue'
import change_email from './change_email.vue'
import pass_form from './change_pass.vue'
import name_che from './change_name.vue'

import send from '../../libs/send.js'

export default {
    name: 'user_profile',
    data: function() {
        return {
            select_image: false,
            change_email_pop: false,
            change_pass_pop: false,
            change_name_pop: false,
            user_name_login: 'Unknow',
            user_mail_login: this.$root.$refs.app_view.user_info["U_mail"],
            user_prof_path: 'Unknow'
        }
    },
    components: {
        select_photo,
        change_email,
        pass_form,
        name_che
    },
    methods: {
        close_pop() {
            this.$root.$refs.main.show_pro()
        },
        select_profile() {
            if (this.select_image) this.select_image = false
            else this.select_image = true
        },
        pop_email() {
            if (this.change_email_pop) this.change_email_pop = false
            else this.change_email_pop = true
        },
        pop_pass() {
            if (this.change_pass_pop) this.change_pass_pop = false
            else this.change_pass_pop = true
        },
        pop_name() {
            if (this.change_name_pop) this.change_name_pop = false
            else this.change_name_pop = true
        },
        get_user_data_info() {
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
            let vm = this
            send.send_get(this.$root.$refs.app_view.url_path + 'api/get_user_info.php', function(resp) {
                if (is_json(resp.responseText) && is_empty(JSON.parse(resp.responseText))) {
                    vm.$root.$refs.app_view.user_info = JSON.parse(resp.responseText)
                    vm.$root.$refs.menu_bar.user_name_login = vm.$root.$refs.app_view.user_info["U_name"]
                    vm.$root.$refs.menu_bar.image_prof_path = (vm.$root.$refs.app_view.url_path.slice(-1) == '/' ? vm.$root.$refs.app_view.url_path.slice(0, -1) :  vm.$root.$refs.app_view.url_path ) + vm.$root.$refs.app_view.user_info["U_profile"]
                    vm.$root.$refs.menu_bar.menage = parseInt(vm.$root.$refs.app_view.user_info["U_rank"]) > 1 ? true : false  
                    vm.$root.$refs.user_pop.user_name_login = vm.$root.$refs.app_view.user_info["U_name"]
                    vm.$root.$refs.user_pop.user_mail_login = vm.$root.$refs.app_view.user_info["U_mail"]
                    vm.$root.$refs.user_pop.user_prof_path = (vm.$root.$refs.app_view.url_path.slice(-1) == '/' ? vm.$root.$refs.app_view.url_path.slice(0, -1) :  vm.$root.$refs.app_view.url_path ) + vm.$root.$refs.app_view.user_info["U_profile"]
                    

                }
            }, function() {

            })
        }
    },
    mounted: function() {
        this.$root.$refs.user_pop = this
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

    .pop_view_input_header {
        position: relative;
        display: block;
        width: 100%;
        height: 100px;
    }

    .pop_view_input_header_profile {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        overflow: hidden;
    }

    .pop_view_input_header_profile img {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: #d0d0d0;
        border-radius: 10px;
    }

    .pop_view_input_header_profile_change {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgb(45, 45, 45);
        border-radius: 10px;
        opacity: .5;
        cursor: pointer;
    }

    .pop_view_input_header_profile_change a {
        position: relative;
        display: block;
        color: #d0d0d0;
        text-align: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .pop_view_input_header_profile img:hover ~ .pop_view_input_header_profile_change {
        display: block;
    }

    .pop_view_input_header_profile_change:hover {
        display: block;
    }

    .pop_view_input_header_profile_info {
        display: block;
        position: absolute;
        height: 100%;
        width: 70%;
        /* margin-left: 10px; */
        top: 0px;
        left: 100px;
    }

    .pop_view_input_header_profile_info a {
        position: relative;
        display: block;
        top: 0%;
        margin-bottom: 10px ;
    }
    
    .pop_view_input_header_profile_info span {
        display: inline-block;
        margin-left: 10px;
        font-weight: bold;
        color: rgb(45, 45, 45);
        cursor: pointer;
    }

    .pop_view_input_header_profile_info span:hover {
        text-decoration: underline;
    }

    .pop_view_line {
        display: block;
        position: relative;
        width: 90%;
        height: 1px;
        left: 50%;
        transform: translate(-50%, 0);
        background-color: #ececec;
    }

    .pop_view_inputs span {
        /* display: block; */
        margin-top: 20px;
        font-weight: bold;
        cursor: pointer;
    }

    .pop_view_inputs span:hover {
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
            .pop_view_inputs {
                height: 75%;
            }
            /*.pop_view_haeder h1{
                font-size: 1.2vh;
            } */
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