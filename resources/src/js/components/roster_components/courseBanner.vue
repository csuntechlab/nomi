<template>
    <div class="banner__position bg--navy-blue">
        <div class="type--center course_banner">{{this.courseTitle}}</div>
        <router-link class="type--left light-grey" to="/">Back</router-link>
    </div>
</template>

<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        computed: {
            ...mapGetters([
                'courseTitle'
            ])
        }
    }
</script>