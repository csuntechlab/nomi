<template>
    <div class="banner__position blue-green">
        <div class="type--center course_banner">{{this.courseTitle}}</div>
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