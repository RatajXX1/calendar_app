<template>
    <div class="bar_main_add_event">
        <button v-on:click="open_bar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </button>
    </div>
</template>


<script>
export default {
    name: 'mobile_add_button',
    methods: {
        open_bar() {
            this.$root.$refs.main.show_add()
        }
    }
}
</script>

<style scoped>
    .bar_main_add_event {
        position: fixed;
        right: 24px;
        bottom: 20px;
        width: 50px;
        height: 50px;
        /* float: right; */
    }

    .bar_main_add_event button {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: none;
        outline: none;
        background-color: rgb(45, 45, 45);
        color: white;
        border-radius: 25px;
        cursor: pointer;
    }

    .bar_main_add_event a {
        font-size: 14px;
        text-align: center;
        line-height: 100%;
        float: right;
        padding-right: 5px;
    }

    .bar_main_add_event svg {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 50%;
        left: 50%;
        /* float: left; */
        transform: translate(-50%, -50%);
    }
</style>