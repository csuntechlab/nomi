<template>
    <router-link :to="'/class/' + this.course.id" class="row" @click.native="storeSelectedCourse()">
        <div data-interactable class="panel course_padding fullscreen_width col-xs-12">
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
                    <div v-if="course.meetings.length > 0" class="col-xs-12 col-sm-6">
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
import { convertCourseData } from './../../mixins/convertCourseData.js'
import { mapGetters } from 'vuex'

export default {
name: 'course-list-item',
mixins: [convertCourseData],
props: ['course'],

computed: {
    ...mapGetters([
        'students'
    ]),
    classStartTime() {
        return this.convertTime(this.course.meetings[0].start_time);
    },
    classEndTime() {
        return this.convertTime(this.course.meetings[0].end_time);
    },
},
methods: {
    storeSelectedCourse() {
        if (this.students == null || this.students[this.course.id] == null) {
            this.$store.dispatch('clearRoster');
            this.$store.dispatch('getOnlyRoster', {course: this.course.id});
            this.$store.dispatch('storeLocation', 'class');
            this.$store.dispatch('storeCourse', this.course.id);
        }
    },
},

};
</script>