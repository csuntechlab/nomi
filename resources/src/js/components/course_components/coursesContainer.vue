<template>
    <div>
        <h1>Class Sections</h1>
        <div v-if="this.list">
            <course-list></course-list>
        </div>
        <div v-else>
            <course-matrix></course-matrix>
        </div>
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
