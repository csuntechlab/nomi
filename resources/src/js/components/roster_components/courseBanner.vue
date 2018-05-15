<template>
    <div class="nav-bars">
        <carousel :perPage="pageSize" :pagination-enabled="false">
            <slide v-for="course in this.courses" :key="course.title" :course="course">
                <div :class="bgcolor(course.id)+' textOverflow courseBannerBorder type--center'">
                    <router-link
                        :to="'/class/'+course.id"
                    >
                        {{course.title}}
                    </router-link>
                </div>
            </slide>
        </carousel>
    </div>
</template>

<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        methods: {
            bgcolor: function (id) {
                if(id.toString() === this.$route.params.id)
                    return "buttonPressBlue";
                else
                    return "makeBlue";
            }
        },

        computed: {
            ...mapGetters([
                'courses'
            ]),

            pageSize: function () {
                if(this.courses.length >= 3)
                    return 3;
                else
                    return this.courses.length;
            }
        },
    }
</script>