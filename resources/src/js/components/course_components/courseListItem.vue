<template>
    <router-link :to="'/class/' + this.course.id" class="row" @click.native="storeSelectedCourse()">
        <div class="panel course_padding fullscreen_width col-xs-12">
            <div class="panel__header type--center">
                <h2 class="course_title pull-left">{{course.title}}</h2>
            </div>
            <div class="panel__content">
                <div class="row">
                    <div class="col-xs-7">
                        {{course.subject}} {{course.catalog_number}}: #{{course.section_number}}
                    </div>
                    <div class="col-xs-5">
                        {{course.meetings[0].location}} {{course.meetings[0].days}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        {{classStartTime}} - {{classEndTime}}
                    </div>
                    <div class="col-xs-5">
                        {{course.enrollment_count}} Students
                    </div>
                </div>
            </div>
        </div>
    </router-link>
</template>

<script>
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

		storeSelectedCourse() {
            document.getElementById('courses').style.color = "rgba(255,255,255,.3)";
            document.getElementById('students').style.color = "rgba(255,255,255,1)";
            this.$store.dispatch("storeLocation", 'class')
            this.$store.dispatch('storeCourse', this.course.id);
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