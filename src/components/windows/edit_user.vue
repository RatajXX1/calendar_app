<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Edytuj użytkownika</h1>
                    <!-- <button class="pop_view_buttons_reset_pass" v-on:click="force_pass">Wymuś zmiane hasła</button> -->
                </div>
                <div class="pop_view_line"></div>
                <div class="text_input">
                    <a>Nazwa użytkownika</a>
                    <input ref='user_name' type="text" placeholder="Nazwa użytkownika"/>
                </div>
                <div class="text_input">
                    <a>Adres email użytkownika</a>
                    <input ref='user_mail' type="email" placeholder="Adres email użytkownika"/>
                </div>
                <div style="height: 30px;margin-top: 20px" @click="show_select" class="text_input">
                    <a>Rodzaj konta</a>
                    <div class="select_button">
                        <a>{{user_type_text}}</a>
                        <div :style="{'display': mode_display}" @mouseleave="hide_select" class="calendar_mode_options_back">
                            <div class="calendar_mode_options_back_main">
                                <div @click="select_mode(1)" class="calendar_mode_options_back_main_item">
                                    <a>Użytkownik</a>
                                </div>
                                <div @click="select_mode(2)" class="calendar_mode_options_back_main_item">
                                    <a>Administrator</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Anuluj</button>
                <button class="pop_view_buttons_submit" @click="sumbit" >Zapisz</button>
            </div>
        </div>
    </div>
</template>

<script>

import send from '../../libs/send.js'

export default {
    name: 'edit_user',
    data: function() {
        return {
            user_id: 1,
            mode_display: 'none',
            user_type: 1,
            user_type_text: 'Użytkownik'
        }
    },
    methods: {
        close() {
            this.$refs.user_name.value = ''
            this.$refs.user_mail.value = ''
            this.user_type = 1
            this.$emit('close')
        },
        show_select() {
            if (this.mode_display == 'none') this.mode_display = 'block'
            else this.mode_display = 'none'
        },
        hide_select() {
            if (this.mode_display == 'block') this.mode_display = 'none'
        },
        select_mode(id) {
            if (id == 1) {
                this.user_type_text = 'Użytkownik'
                this.user_type = id
            } else if (id == 2) {
                this.user_type_text = 'Administrator'
                this.user_type = id 
            }
        },
        get_data(id) {
            this.user_id = id
            let vm = this
            function is_json(data) {
                try {
                    JSON.parse(data)
                    return true
                } catch (e) {
                    return false
                }
            }
            send.send_get(this.$root.$refs.app_view.url_path  + 'api/Users/user_info.php?id=' + id.toString(),
            function(resp) {
                if (is_json(resp.responseText)) {
                    let data = JSON.parse(resp.responseText)
                    vm.$refs.user_name.value = data['Name']
                    vm.$refs.user_mail.value = data['Email']
                    vm.select_mode(data['Rank'])
                } else {
                    vm.close()
                }
            }, function() {
                vm.close()
            })
        },      
        sumbit() {
            if (this.$refs.user_name.value.replaceAll(' ', '') != '' &&
            this.$refs.user_mail.value.replaceAll(' ', '') != '') {
                let vm = this
                this.$nextTick(()=> {
                    send.send_post_json(JSON.stringify({
                        'id': vm.user_id,
                        'name': vm.$refs.user_name.value,
                        'email': vm.$refs.user_mail.value,
                        'rank': vm.user_type,
                    }),
                    this.$root.$refs.app_view.url_path + 'api/Users/edit_user.php',
                    function(resp) {
                        if (resp.responseText == 'OK') {
                            vm.$root.$refs.main.alert_pop(4, 'Zapisano!' , 'Pomyślnie zedytowano użytkownika!')
                            vm.$refs.user_name.value = ''
                            vm.$refs.user_mail.value = ''
                            vm.user_type_text = 'Użytkownik'
                            vm.user_type = 1
                            vm.$root.$refs.user_manage.cals = []
                            vm.$root.$refs.user_manage.get_data()
                            vm.$emit('close')
                        } else {
                            vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Użytkownik nie istnieje!')
                        }
                    }, function() {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zedytować użytkownika')
                    })
                }) 

            } else this.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Pole jest puste!')
        },
        force_pass() {
            let vm = this
            send.send_post(this.$root.$refs.app_view.url_path + 'api/Users/force_pass.php?ID=' + this.user_id,
            function(resp) {
                if (resp.responseText == 'OK') {
                    vm.$root.$refs.main.alert_pop(4, 'Zapisano!' , 'Pomyślnie wymuszono zmiane hasła na użytkowniku!')
                } else {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się wymusić zmiany hasła na użytkowniku!')
                }
            }, function() {
                vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się wymusić zmiany hasła na użytkowniku!')
            })
        }
    },
    mounted: function() {
        this.$root.$refs.user_edit = this
    }
}
</script>

<style scoped>
    .main_view_pop {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        top: 0px;
        left: 0px;
        z-index: 7;
    }
    .pop_view {
        position: relative;
        width: 590px;
        height: 435px;
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
        height: 70%;
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
        margin-top: 40px;
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
    .pop_view_text {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        padding-top: 5px;
    }
    .pop_view_text a {
        position: relative;
        display: block;
        margin: 0;
        width: 90%;
        left: 50%;
        transform: translate(-50%, 0);
        font-size: 16px;
    }

    .text_input {
        display: block;
        position: relative;
        width: 100%;
        padding-top: 5px;
    }

    .text_input a {
        display: block;
        position: relative;
        width: 100%;
        padding-left: 5px;
    }

    .text_input input {
        display: block;
        position: relative;
        width: 100%;
        border: 1px solid #d0d0d0; 
        outline: none;
        background-color: transparent;
        height: 30px;
        margin-top: 5px;
    }

    .random_pass {
        position: absolute;
        right: 0px;
        bottom: 0px;
        cursor: pointer;
        background-color: rgb(45, 45, 45);
        height: 34px;
        border: none;
        width: 10%;
        fill: white;
    }

    .select_button {
        position: absolute;
        display: block;
        border: 1px solid #ececec;
        border-radius: 10px;
        cursor: pointer;
        width: 150px;
        height: 30px;
        top: 50%;
        left: 120px;
        transform: translate(0, -50%);
    }

    .select_button a {
        position: relative;
        display: block;
        /* width: 90%; */
        /* height: 100%; */
        text-align: center;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .calendar_mode_options_back {
        display: none;
        position: fixed;
        z-index: 2123;
        top: 0px;
        /* right: 223px; */
        width: 150px;
        /* min-height: 50px; */
        height: 72px;
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
        /* margin-left: 10%; */
        white-space: nowrap;
        padding: unset;
    }

    .pop_view_buttons_reset_pass {
        right: 0px;
        width: 150px;
        height: 30px;
        position: absolute;
        display: block;
        background-color: rgb(45, 45, 45);
        outline: none;
        border: none;
        cursor: pointer;
        border-radius: 10px;
        color: white;
        top: 50%;
        transform: translate(0, -50%);
    }

    @media (max-width: 589px) {
        .pop_view {
            width: 100%;
        }
    }
</style>
