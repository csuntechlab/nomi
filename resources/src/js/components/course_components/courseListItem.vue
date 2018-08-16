<template>
    <router-link :to="'/class/' + this.course.id" class="row" @click.native="storeSelectedCourse()">
        <div class="panel course_padding fullscreen_width col-xs-12">
            <div class="panel__header type--center">
                <h2 class="course_title pull-left">{{course.title}}</h2>
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
                            <b>Days</b>: {{course.meetings[0].days}}
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