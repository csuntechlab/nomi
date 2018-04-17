<template>
    <div class="banner__position bg--navy-blue">
        <carousel :perPage="3">
            <slide v-for="course in this.courses" :key="course.title" :course="course">
                <router-link class="light-grey" :to="'/class/'+course.id">{{course.title}}</router-link>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        computed: {
            ...mapGetters([
                'courses'
            ])
        }
    }
</script>