<template>
    <div>
        <button type="submit" @click="ok = true">Log In</button>
        <div v-if="ok" class="type--center">
<<<<<<< HEAD
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
=======
            <i class="fa fa-spinner fa-spin fa-4x type--red"></i>
>>>>>>> dev
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