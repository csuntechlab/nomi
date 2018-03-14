<template>
    <div>
        <button v-if="this.flash" role="button" class="btn btn-default" @click="$store.commit('shuffle', this.courseid)">Shuffle</button>
        <button v-else role="button" class="btn btn-default">Shuffle</button>
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
