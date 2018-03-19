<template>
    <button v-if="this.list || !this.flash" class="btn btn-default" @click="$store.dispatch('nameSort')">1st/Last</button>
</template>
<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "name-toggle-button",
        computed: {
            ...mapGetters([
                'flash',
                'list'
            ])
        }
    }
</script>
