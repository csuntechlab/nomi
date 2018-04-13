<template>
    <div>
        <ul class="list">
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
            }
        },

        computed: {
            ...mapGetters([
                'courses'
            ])
        },

        components: {
            courseListItem
        }
    }
</script>
