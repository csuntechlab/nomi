<template>
    <div class="btnwrapper">
        <button type="submit" @click="ok = true">Log In</button>
        <circle2 class="spinner" v-show="ok"></circle2>
    </div>
</template>

<script>
    export default {
        name: "loading-button",

        data: () => {
            return {
                ok: false
            }
        }
    }
</script>

<style>
    .btnwrapper {
        width: 120px
    }

    .spinner {
        float: right
    }
</style>
