<template>
    <ul class="list">
        <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
    </ul>
</template>

<script>
    import { mapGetters } from 'vuex'
    import courseListItem from './courseListItem.vue'
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
                'faculty_profile',
            ])
        },

        components: {
            courseListItem
        },

    }
</script>
