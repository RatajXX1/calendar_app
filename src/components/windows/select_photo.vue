<template>
    <div class="main_view_pop">
        <div class="pop_view">
            <div class="pop_view_inputs">
                <div class="pop_view_haeder">
                    <h1>Wybierz lub dodaj zdjecie</h1>
                </div>
                <div class="pop_view_line"></div>
                <div class="pop_view_images">
                    <div @click="selec_prof_set(index)" class="pop_view_images_item" v-for="index in images" :key="index">
                        <img :src="index" v-bind:alt="index">
                    </div>  
                    <!-- <div class="pop_view_images_item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </div> -->
                </div>
            </div>
            <div class="pop_view_buttons">
                <button class="pop_view_buttons_close" @click="close_pop">Zamknij</button>
            </div>
        </div>
    </div>    
</template>


<script>

import send from '../../libs/send.js'

export default {
    name: 'select_photo',
    data: function() {
        return {
            selected_prof: 'logo.png',
            images: []
        }
    },
    methods: {
        close_pop() {
            this.$root.$refs.user_pop.select_profile()
        },
        selec_prof_set(path) {
            let vm = this
            send.send_post_json(
                JSON.stringify({
                    'prof': path.replace((vm.$root.$refs.app_view.url_path.slice(-1) == '/' ? vm.$root.$refs.app_view.url_path.slice(0, -1) :  vm.$root.$refs.app_view.url_path ), '')
                }), 
                this.$root.$refs.app_view.url_path + 'api/update_user.php',
                function (resp) {
                    if (resp.responseText == 'OK') {
                        vm.$root.$refs.main.alert_pop(4, 'Zmieniono nazwe!' , 'Pomyślnie zmieniono zdjęcie!')
                        vm.$root.$refs.user_pop.get_user_data_info()
                        vm.close_pop()
                    } else {
                        vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zmięnić zdjęcia!')
                    }
                }, 
                function() {
                    vm.$root.$refs.main.alert_pop(6, 'Błąd!' , 'Nie udało się zmięnić zdjęcia!')
                }
            )
        }
    },
        mounted: function() {
            let vm = this
            function is_json(date) {
                try {
                    JSON.parse(date)
                    return true
                } catch (e) {
                    return false
                }
            }
            send.send_get(this.$root.$refs.app_view.url_path + 'api/images_list.php',
            function (resp) {
                if (is_json(resp.responseText)) {
                    let itme = JSON.parse(resp.responseText)
                    // console.log(itme)
                    for (let i = 0; i < itme.length; i++) {
                        vm.images.push((vm.$root.$refs.app_view.url_path.slice(-1) == '/' ? vm.$root.$refs.app_view.url_path.slice(0, -1) :  vm.$root.$refs.app_view.url_path ) + itme[i]['Path'])
                        console.log(itme[i]['Path'])
                    }
                    // itme.foreach( e => {
                    //     console.log(e)
                    //     vm.images.push(e['Path'])
                    //     console.log(e['Path'])
                    // })
                }
            }, function() {

            })
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
    }

    .pop_view {
        position: relative;
        width: 500px;
        height: 500px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 5px;
    }

    .pop_view_inputs {
        position: relative;
        width: 90%;
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


    .pop_view_images {
        position: relative;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        /* align-items: center; */
        gap: 10px;
        width: 100%;
        height: 80%;
        margin-top: 10px;
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 5px;
        overflow-y: auto;
    }

    .pop_view_images_item {
        position: relative;
        display: block  ;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        overflow: hidden;
    }

    .pop_view_images_item img{
        position: relative;
        direction: block;
        width: 100%;
        height: 100%;
        background-color: #d0d0d0;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    .pop_view_images_item svg{
        position: relative;
        direction: block;
        width: 100%;
        height: 100%;
        /* background-color: #d0d0d0; */
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    .selected_photo {
        outline: 2px solid rgb(45, 45, 45);
        outline-offset: 2px;
    }

    @media (max-width: 499px) {
        .pop_view {
            width: 100%;
        }
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
                font-size: 1.3vh;
            }

        }
    }

</style>