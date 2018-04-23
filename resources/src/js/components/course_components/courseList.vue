<template>
    <div>
        <div v-if="faculty_profile == null" class="type--center">
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
        </div>
    </div>
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
