<template>
    <ul id="scrollBar" class="tabs cf">
        <li v-for="course in this.courses" :id="course.id" :key="course.title" :course="course" class="tab__list" @click="storeCourse(course.id)">
            <router-link data-interactable class="tab__link-alt" active-class="tab__link--active" :to="'/class/'+course.id">
                <div class="text-bold">
                    {{course.subject}} {{course.catalog_number}}
                </div>
                <div v-if="course.meetings.length > 0" class="text-bold text-size--large">
                    {{ convertDays(course.meetings[0].days) }} {{ classStartTime(course.meetings[0].start_time) }}
                </div>
            </router-link>
        </li>
    </ul>
</template>
<script>
import { mapGetters } from 'vuex';
import { convertCourseData } from './../../mixins/convertCourseData.js'

export default {
name: 'course-banner',
mixins: [convertCourseData],

computed: {
	...mapGetters([
		'courses',
		'currentCourse',
        'students'
	]),
},

methods: {
	classStartTime(time) {
			return this.convertTime(time);
		},

	setScrollBar() {
		const courseTab = document.getElementById(this.currentCourse);
		courseTab.scrollIntoView({
		block: 'end',
		});
	},

	storeCourse(courseId) {
	    if (this.students[courseId] == null) {
            this.$store.dispatch('clearRoster');
            this.$store.dispatch('storeCourse', courseId);
            this.$store.dispatch('getOnlyRoster', {course: courseId});
            this.$store.dispatch('storeCourse', courseId);
        }
	},
},

};
</script>