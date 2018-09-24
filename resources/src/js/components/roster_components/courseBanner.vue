<template>
    <ul id="scrollBar" class="tabs cf">
        <li v-for="course in this.courses" :id="course.id" :key="course.title" :course="course" class="tab__list" @click="storeCourse(course.id)">
            <router-link class="tab__link" active-class="tab__link--active" :to="'/class/'+course.id">
                <div class="text-bold">
                    {{course.subject}} {{course.catalog_number}} ({{course.class_number}})
                </div>
            </router-link>
        </li>
    </ul>
</template>
<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        methods: {
            setScrollBar(){
                let courseTab = document.getElementById(this.currentCourse);
                courseTab.scrollIntoView({
                    block:"end",
                });
            },
            storeCourse(courseId){
                this.$store.dispatch('storeCourse', courseId);
            }
        },

        mounted() {
            this.setScrollBar();
        },

        computed: {
            ...mapGetters([
                'courses',
                'currentCourse'
            ]),


        },


    }
</script>