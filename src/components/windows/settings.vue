<template>
    <div class="main_view_pop">
        <div class="pop_view">           
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Ustawienia</h1>
                </div>
                <div class="pop_view_line"></div>
                <div class="scroll_view_input">
                    <!-- <div class="set_item">
                        <a>Lite Bar</a>
                        <switcher @change_val="turn_lite_bar"/>
                    </div> -->
                    <div class="set_item">
                        <a>Dark Mode</a>
                        <switcher ref="switcher_dark" @change_val="turn_on_dark"/>
                    </div>
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" @click="close_pop">Zamknij</button>
            </div>
        </div>
    </div>
</template>

<script>
import switcher from '../windows/switcher.vue'

import Darkmode from 'darkmode-js';

export default {
    name: 'settings',
    data: function() {
        return {
            dark_mods: null
        }
    },
    components: {
        switcher,
    },
    methods: {
        close_pop() {
            this.$root.$refs.main.show_set()
        },
        turn_lite_bar() {
            this.$root.$refs.menu_bar.lite_version()
        },
        turn_on_dark() {
            if (this.dark_mods == null) {
                const options = {
                    bottom: 'unset', // default: '32px'
                    right: 'unset', // default: '32px'
                    left: 'unset', // default: 'unset'
                    time: '0.5s', // default: '0.3s'
                    mixColor: '', // default: '#fff'
                    backgroundColor: '#18191A',  // default: '#fff'
                    buttonColorDark: '#18191A',  // default: '#100f2c'
                    buttonColorLight: '#fff', // default: '#fff'
                    saveInCookies: false, // default: true,
                    label: '', // default: ''
                    autoMatchOsTheme: true // default: true
                }
                this.dark_mods =  new Darkmode(options);
                this.dark_mods.toggle();
                window.localStorage.setItem("DarkMode", true)
            } else {
                if (this.dark_mods.isActivated()) {
                    this.dark_mods.toggle()
                    try {
                        document.querySelector('.darkmode-background').remove()
                        document.querySelector('.darkmode-layer').remove()
                        document.querySelector('.darkmode-toggle--inactive').remove()
                        this.dark_mods = null
                    } catch (e) {return}
                    window.localStorage.setItem("DarkMode", false)
                } else {
                    this.dark_mods.toggle()
                    window.localStorage.setItem("DarkMode", true)
                }
            }

        },foce_turn_off() {
            if (this.dark_mods == null) return
            if (this.dark_mods.isActivated()) {
                this.dark_mods.toggle()
                try {
                    document.querySelector('.darkmode-background').remove()
                    document.querySelector('.darkmode-layer').remove()
                    document.querySelector('.darkmode-toggle--inactive').remove()
                    this.dark_mods = null
                } catch (e) {return}
                window.localStorage.setItem("DarkMode", false)
            }
        }
    },mounted: function() {
        this.$root.$refs.settings = this
        if (window.localStorage.getItem("darkmode") === null) {
            window.localStorage.setItem("darkmode", false) 
        }
        if (window.localStorage.getItem("DarkMode") !== null) {
            if (window.localStorage.getItem('DarkMode') == 'true' && this.dark_mods == null) {
                this.turn_on_dark()
                let vm = this
                this.$nextTick(() => {
                    vm.$refs.switcher_dark.value = true
                })
            }
        }
        // const options = {
        //     bottom: 'unset', // default: '32px'
        //     right: 'unset', // default: '32px'
        //     left: 'unset', // default: 'unset'
        //     time: '0.5s', // default: '0.3s'
        //     mixColor: '', // default: '#fff'
        //     backgroundColor: '#18191A',  // default: '#fff'
        //     buttonColorDark: '#18191A',  // default: '#100f2c'
        //     buttonColorLight: '#fff', // default: '#fff'
        //     saveInCookies: false, // default: true,
        //     label: '', // default: ''
        //     autoMatchOsTheme: false // default: true
        // }
        // this.dark_mods = new Darkmode(options);
        // this.dark_mods.toggle();
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

    .scroll_view_input {
        position: relative;
        display: block;
        width: 100%;
        margin-top: 15px;
    }

    .set_item {
        position: relative;
        width: 70%;
        height: 45px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
    }

    .set_item a {
        position: relative;
        display: block;
        width: 200px;
        font-weight: normal;
        font-size: 17px;
        line-height: 45px;
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
            .pop_view {
                font-size: 1.3vh;
                height: 100vh;
                top: -30px;
                left: 0px;
                transform: unset;
            }
        }
    }
</style>