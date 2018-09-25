<template>
    <ul id="scrollBar" class="tabs cf">
        <li v-for="course in this.courses" :id="course.id" :key="course.title" :course="course" class="tab__list" @click="storeCourse(course.id)">
            <router-link class="tab__link-alt" active-class="tab__link--active" :to="'/class/'+course.id">
                <div class="text-bold">
                    {{course.subject}} {{course.catalog_number}}
                </div>
                <div class="text-bold">
                    {{course.meetings[0].days}} {{ classStartTime(course.meetings[0].start_time) }}
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
            convertTime(originalTime) {
                console.log(originalTime);
                let time = originalTime;
                let hour = parseInt(time.substring(0, 2));
                let min = time.substring(2, 4) + " a.m.";

                if (hour > 12) {
                    hour = hour - 12;
                    min = min.substring(0, 2) + " p.m.";
                }
                
                time = hour + ":" + min;
                return time;
            },

            classStartTime(time) {
			    return this.convertTime(time);
		    },

		    classEndTime(time) {
			    return this.convertTime(time);
		    },
            
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