<template>
    <div>
        <div v-if="loading" class="type--center">
                    <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <ul v-else class="list">
            <course-list-item v-for="course in this.courses" :key="course.title" :course="course"></course-list-item>
        </ul>
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
                loading: true,
            }
        },

        created () {
            this.$store.subscribe(mutation => {
                if (mutation.type === 'GET_FACULTY_PROFILE') {
                    this.loading = !this.loading; 
                }
            })
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
