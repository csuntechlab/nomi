<template>
    <div class="banner__position blue-green">
        <div class="type--center course_brand">{{this.courseTitle}}</div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-brand",

        computed: {
            ...mapGetters([
                'courseTitle'
            ])
        }
    }
</script>