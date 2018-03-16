<template>
<!-- <<<<<<< HEAD
    <div> 
        <i class="fa fa-random fa-3x type--white" @click="emitShuffleCards()"></i>
======= -->
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
        props: ['courseid'],
        computed: {
            ...mapGetters([
                'flash',
                'list'
            ])
        }
    }
</script>
