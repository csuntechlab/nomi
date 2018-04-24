<template>
    <div>
        <ul class="list">
            <student-list-item
                v-for="student in this.courses[this.courseid].roster"
                :key="student.display_name"
                :student="student"
            ></student-list-item>
        </ul>
    </div>
</template>

<script>
    import studentListItem from './studentListItem.vue';
    import { mapGetters } from 'vuex';
    export default {
        name: "student-list",

        data: function () {
            return {
                show: false,
                messages: true,
                errors: [],
                lastname: true,
                descending: true,
            }
        },

        components: {
            studentListItem
        },

        props: ['courseid'],

        computed: {
            ...mapGetters([
                'courses',
            ]),
        },
    }
</script>
