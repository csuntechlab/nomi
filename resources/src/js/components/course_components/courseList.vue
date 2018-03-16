<template>
    <div v-if="show">
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
                show: false,
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
