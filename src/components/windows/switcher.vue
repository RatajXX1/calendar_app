<template>
    <div @click="change_click" v-bind:class="[!value ? 'main_swit_status_off' : 'main_swit_status_on']" class="main_swit">
        <a v-if="!value" class="state_text_off">OFF</a>
        <a v-else class="state_text_ON">ON</a>
        <div v-bind:class="[value ? 'switch_off_c' : 'switch_on_c']" class="main_swit_switcher"></div>
    </div>
</template>

<script>
export default {
    name: 'switcher',
    data: function() {
        return {
            value: false
        }
    },
    methods: {  
        change_click() {
            if (this.value) this.value = false
            else this.value = true
            this.$emit('change_val', this.value)
        }
    }
}
</script>

<style scoped>
    .main_swit {
        position: relative;
        display: block;
        width: 70px;
        height: 30px;
        background-color: transparent;
        border-radius: 15px;
        cursor: pointer;
        transition: 1s;
        -webkit-box-shadow: 0px 0px 8px -2px rgba(66, 68, 90, 1);
        -moz-box-shadow: 0px 0px 8px -2px rgba(66, 68, 90, 1);
        box-shadow: 0px 0px 8px -2px rgba(66, 68, 90, 1);
        top: 50%;
        transform: translate(0, -50%);
    }

    .main_swit_status_on {
        background-color: #2ab934;
    }

    .main_swit_status_off {
        background-color: #ca2222;
    }

    .main_swit a {
        display: block;
        color: white;
        line-height: 30px;
    }

    .state_text_ON {
        position: absolute;
        right: 10px;
    }

    .state_text_off {
        position: absolute;
        left: 5px;
    }

    .main_swit_switcher {
        position: absolute;
        display: block;
        width: 30px;
        height: 30px;
        background-color: #ececec;
        border-radius: 50%;
        top: 0px;
    }

    .switch_off_c {
        animation-name: switch_off;
        animation-duration: 1s;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }

    @keyframes switch_off {
        from {
            right: -2px
        }

        to {
            right: 42px;
        }
    }
    .switch_on_c {
        animation-name: switch_on;
        animation-duration: 1s;
        animation-iteration-count: 1;
        animation-direction: normal;
        animation-fill-mode: forwards;
    }

    @keyframes switch_on {
        from {
            right: 42px
        }

        to {
            right: -2px;
        }
    }


</style>