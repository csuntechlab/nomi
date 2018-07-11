<template>
    <div>
        <button class="loginButton btn btn-primary" type="submit" @click="ok = true">
            Submit
        </button>
        <div v-if="ok" class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
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
