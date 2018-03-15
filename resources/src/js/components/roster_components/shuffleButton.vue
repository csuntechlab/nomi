<template>
    <div>
        <button v-if="this.flash" role="button" class="btn btn-default" @click="$store.commit('shuffleFlash', { courseid })">Shuffle</button>
        <button v-else role="button" class="btn btn-default" disabled>Shuffle</button>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "shuffle-button",
        props: ['courseid'],
        computed: {
            ...mapGetters([
                'flash'
            ])
        }
    }
</script>
