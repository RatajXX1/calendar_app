<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Zmiana adresu e-mail</h1>
                </div>
                <div class="pop_view_line"></div>
                <div class="text_input">
                    <a>Podaj nowy adres e-mail</a>
                    <input ref='email_input' type="text" placeholder="Adres e-mail"/>
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
    name: 'are_sure',
    methods: {
        close() {
            this.$emit('close_pop')
        },
        sumbit() {
            if (this.$refs.email_input.value.replaceAll(' ', '') != '') {
                let vm = this
                this.$nextTick(()=> {
                    send.send_post_json(JSON.stringify({
                        'email': vm.$refs.email_input.value
                    }),
                    this.$root.$refs.app_view.url_path  + 'api/update_user.php',
                    function(resp) {
                        if (resp.responseText == 'OK') {
                            vm.$root.$refs.main.alert_pop(4, 'Zmieniono e-mail!' , 'Pomyślnie zmieniono adres e-mail!')
                            vm.$refs.email_input.value = ''
                            vm.$root.$refs.user_pop.get_user_data_info()
                            vm.$emit('close_pop')
                        } else {
                            vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zmięnić adresu e-mail!')
                        }
                    }, function() {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zmięnić adresu e-mail!')
                    })
                }) 
            } else this.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Pole jest puste!')
        }
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
        width: 700px;
        height: 250px;
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

    @media (max-width: 699px) {
        .pop_view {
            width: 100%;
        }
        @media (max-height: 2000px) {
            /* .pop_view_inputs {
                height: 76%;
            } */
            .pop_view_haeder h1{
                font-size: 3vh;
            }
            /* .pop_view {
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            } */
        }
    }


</style>