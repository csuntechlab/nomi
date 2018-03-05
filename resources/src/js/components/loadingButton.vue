<template>
    <div style="width:120px">
        <button type="submit" @click="ok = true">Log In</button>
        <circle2 v-show="ok" style="float:right"></circle2>
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
