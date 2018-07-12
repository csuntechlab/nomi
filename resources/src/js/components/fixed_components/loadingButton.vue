<template>
    <div>
        <button type="submit" @click="ok = true">
            <i class="fa fa-sign-in-alt"></i>
            Log In
        </button>
        <div v-if="ok" class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>
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
