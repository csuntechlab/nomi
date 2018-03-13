<template>
    <div>
        <input v-if="this.list" @click="$store.commit('toggleList')" type="image" src="/images/list.png">
        <input v-else @click="$store.commit('toggleList')" type="image" src="/images/2x2grid.png">
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "toggle-view-button",
        computed: {
            ...mapGetters([
                'list'
            ])
        }
    }
</script>
