<template>
    <button v-if="this.list || !this.flash" class="btn btn-default" @click="$store.dispatch('descSort')">A-Z/Z-A</button>
</template>
<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "descending-toggle-button",
        computed: {
            ...mapGetters([
                'flash',
                'list'
            ]),
        }
    }
</script>
