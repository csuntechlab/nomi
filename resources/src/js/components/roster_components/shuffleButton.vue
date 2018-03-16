<template>
    <div>
        <i v-if="this.flash" class="fa fa-random fa-3x type--white" @click="$store.commit('shuffleFlash', { courseid })"></i>
        <div v-else-if="this.list"></div>
        <i v-else class="fa fa-random fa-3x type--white" disabled></i>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "shuffle-button",

        computed: {
            ...mapGetters([
                'flash',
                'list',
                'courseid',
            ])
        }
    }
</script>
