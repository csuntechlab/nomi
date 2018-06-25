<template>
<div>
    <div v-if="this.courses != null">
        <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
    </div>
    <div v-else>
        <empty-course-item></empty-course-item>
    </div>
</div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import courseListItem from './courseListItem.vue'
    import emptyCourseItem from './emptyCourseItem.vue'
    export default {
        name: "course-list",
        data: function () {
            return {
                messages: true,
                errors: [],
            }
        },

        computed: {
            ...mapGetters([
                'courses',
            ])
        },

        components: {
            courseListItem,
            emptyCourseItem
        },

    }
</script>
