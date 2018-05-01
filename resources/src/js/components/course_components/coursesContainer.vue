<template>
    <div>
        <h1>Class Sections</h1>
        <course-list></course-list>
    </div>
</template>

<script>
    import courseList from './courseList'
    import { mapGetters } from 'vuex'
    export default {
        name: "courses-container",

        components: {
            courseList,
        },

        computed: {
            ...mapGetters([
                'list'
            ])
        }
    }
</script>
