<template>
    <div>
        <i v-if="this.flash" class="fa fa-random fa-3x type--white" @click="$store.dispatch('shuffleFlash', { courseid })"></i>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "shuffle-button",

        computed: {
            ...mapGetters([
                'flash',
                'courseid'
            ])
        }
    }
</script>
