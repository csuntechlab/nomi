<template>
    <div class="banner__position bg--off-white">
        <carousel :perPage="pageSize" :pagination-enabled="false">
            <slide v-for="course in this.courses" :key="course.title" :course="course">
                <div :class="bgcolor(course.id)+' type--center'">
                    <router-link
                        class="light-grey"
                        style="font-size: 1.2rem"
                        :to="'/class/'+course.id"
                        @click.native="$store.dispatch('setCourse', {id: course.id, title: course.title})"
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
                    return "bg--blue-green";
                else
                    return "bg--navy-blue";
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