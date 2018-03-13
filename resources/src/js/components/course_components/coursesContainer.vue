<template>
    <div>
        <course-list v-if="this.list"></course-list>
        <course-matrix v-else></course-matrix>
    </div>
</template>

<script>
    import courseList from './courseList'
    import courseMatrix from './courseMatrix'
    import { mapGetters } from 'vuex'
    export default {
        name: "courses-container",

        components: {
            courseList,
            courseMatrix
        },

        computed: {
            ...mapGetters([
                'list'
            ])
        }
    }
</script>
