<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_input">
                    <input style="font-size: 23px" type="text" placeholder="Nazwa Kalendarza" ref="title"/>
                </div>
                <div class="pop_view_input">
                    <svg class="icon_inputs_view" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    <a>Opis</a>
                    <div class="pop_view_editor_in"> 
                        <div ref="editor_pop_cal" id="main_editor_cal" class="pop_view_editor" ></div>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" v-on:click="close">Anuluj</button>
                <button class="pop_view_buttons_submit" v-on:click="create_event">Dodaj kalendarz</button>
            </div>
        </div>
    </div>
</template>

<script>
import send from '../../libs/send.js'
import Quill from 'quill';

export default {
    name: 'add_cal',
    data: function() {
        return {
            editror_rich: null,
        }
    },
    methods: {
        reset_pop_up() {
            this.editror_rich.root.innerHTML = ""
            this.$refs.title.value = ''

        }, 
        close() {
            this.reset_pop_up()
            this.$emit('close')
        },
        create_event() {
            let vm = this

            if (this.$refs.title.value != "" && this.editror_rich.root.innerHTML.replaceAll(' ', "") != '') {                
                send.send_post_json(
                    JSON.stringify({
                        "Desc": this.editror_rich.root.innerHTML,
                        "title": this.$refs.title.value
                        
                    }),
                    this.$root.$refs.app_view.url_path + 'api/calendars/add_cal.php',
                    function(e) {
                        if (e.responseText == "OK") {
                            vm.$root.$refs.main.alert_pop(4, 'Zapisano!' , 'Pomyślnie utworzono nowy kalendarz!')
                            // vm.$root.$refs.main.add_event_to_cal()
                            vm.close()
                        } else {
                            vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się utworzyć nowy kalendarz!')
                        }
                    }, function() {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się  utworzyć nowy kalendarz!')

                    }
                )
            } else this.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Wypełniej każde wymagane pole!')
        },

    },
    mounted: function() {
        this.editror_rich = new Quill('#main_editor_cal',
            {
                modules: {
                    toolbar: true
                },
                theme: 'snow'
            }
        )


    }
}
</script>

<style scoped>

    .main_view_pop {
        position: fixed;
        top: 0px;
        left: 0px;
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
        height: 530px;
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
        display: flex;
        flex-direction: row;
        justify-items: center;
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
        
        /* min-height: 25px;
        max-height: 250px; */
        height: 320px;
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
        height: 230px;
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
                font-size: 1.2vh;
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
        }
    }

</style>