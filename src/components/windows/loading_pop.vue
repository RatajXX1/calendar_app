<template>
    <div :class="[t_dark ? 'color' : 'dark']" class="load_back"> 
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" r="34" stroke-width="4" stroke-dasharray="53.40707511102649 53.40707511102649" fill="none" stroke-linecap="round">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
            </circle>
        </svg>
        <a >Ładowanie</a>
    </div>
</template>


<script>
export default {
    name: 'loading_pop',
    data: function() {
        return {
            t_dark: this.theme_dark
        }
    },
    props: {
        theme_dark: {
            type: Boolean,
            default: false,
            required: false
        }
    }
}
</script>


<style scoped>

    .load_back {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .25);
        left: 0px;
        top: 0px;
    }

    .load_back svg {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        /* stroke: ; */
    }

    .load_back a {
        position: absolute;
        display: block;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        /* color: rgb(45, 45, 45); */
        font-size: 19px;
    }
    
    .dark svg {
        stroke: #2d2d2d;
    }

    .dark a {
        color: rgb(45, 45, 45);
    }

    .color a {
        color: white;
    }

    .color svg {
        stroke: white;
    }

</style>