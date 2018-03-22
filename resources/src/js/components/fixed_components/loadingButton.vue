<template>
    <div>
        <button class="btn btn-default" @click="ok = true">Log In</button>
        <div v-if="ok" class="type--center">
            <i class="fa fa-spinner fa-spin fa-4x type--red"></i>
        </div>
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

</style>