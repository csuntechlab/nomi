<template>
    <div v-if="show">
        <h1>Course List</h1>
        <ul class="list">
            <li class="list__item" v-for="course in courses">
                <router-link :to="'/class/'+course.id+'/'+course.title">{{ course.title }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        name: "course-list",
        data: function () {
            return {
                show: true,
                messages: true,
                errors: [],
            }
        },

        computed: {
            ...mapGetters([
                'courses'
            ])
        },
    }
</script>
