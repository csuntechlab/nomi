<template>
    <router-link :to="'/class/' + this.course.id" class="row" @click.native="storeSelectedCourse(), clearStudent()">
        <div class="panel course_padding fullscreen_width col-xs-12">
            <div class="panel__header type--center">
                <h2 class="course__title pull-left">{{course.title}}</h2>
            </div>
            <div class="panel__content">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <b>{{course.subject}} {{course.catalog_number}}</b> ({{course.class_number}})
                        </div>
                        <div>
                            {{course.enrollment_count}} Students
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <b>Days</b>: {{ convertDays(course.meetings[0].days) }}
                        </div>
                        <div>
                            <b>Time</b>: {{classStartTime}} - {{classEndTime}}
                        </div>
                        <div>
                            <b>Location</b>: {{course.meetings[0].location}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </router-link>
</template>

<script>
import { mapGetters } from "vuex";
export default {
	name: "course-list-item",

	props: ["course"],

	computed: {
		classStartTime() {
			return this.convertTime(this.course.meetings[0].start_time);
		},

		classEndTime() {
			return this.convertTime(this.course.meetings[0].end_time);
		}
	},

	methods: {
		...mapGetters(["currentStudent"]),
		
		convertTime(OriginalTime) {
			let time = OriginalTime;
			let hour = parseInt(time.substring(0, 2));
			let min = time.substring(2, 4) + " a.m.";
			if (hour > 12) {
				hour = hour - 12;
				min = min.substring(0, 2) + " p.m.";
			}
			time = hour + ":" + min;
			return time;
		},

		convertDays(originalDays) {
			let days = originalDays;
			let split = days.split("");

			// M T W R F S
			// Mo Tu We Th Fr Sa
			let result =  split.map(day => {
				if ( day === 'M' ) day = 'Mo';
				if ( day === 'T' ) day = 'Tu';
				if ( day === 'W' ) day = 'We';
				if ( day === 'R' ) day = 'Th';
				if ( day === 'F' ) day = 'Fr';
				if ( day === 'S' ) day = 'Sa';
				return day
			});

			return result.join("");
		},

		storeSelectedCourse() {
			this.$store.dispatch("storeLocation", "class");
			this.$store.dispatch("storeCourse", this.course.id);
		},

		clearStudent() {
			if (this.currentStudent) this.$store.dispatch("clearStudent");
		}
	}
};
</script>

<style scoped>
.list__item {
	padding: 20px;
	-webkit-box-shadow: 0 5px 9px 3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 5px 9px 3px rgba(0, 0, 0, 0.2);
}
</style>