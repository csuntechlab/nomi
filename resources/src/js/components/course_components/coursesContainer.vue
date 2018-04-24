<template>
    <div>
        <h1>Class Sections</h1>
        <div v-if="courses.length === 0" class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <div v-if="list">
                <course-list></course-list>
            </div>
            <div v-else>
                <course-matrix></course-matrix>
            </div>
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
                'list',
                'courses'
            ])
        }
    }
</script>
