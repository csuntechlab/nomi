<template>
    <div>
        <i v-if="this.list" class="fa fa-th-large fa-3x type--white" title="Grid" @click="$store.dispatch('toggleList')"></i>
        <i v-else class="fa fa-list-ul fa-3x type--white" title="List" @click="$store.dispatch('toggleList')"></i>
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
