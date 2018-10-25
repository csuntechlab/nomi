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
import { mapGetters } from 'vuex';
import { convertCourseData } from './../../mixins/convertCourseData.js'

export default {
name: 'course-list-item',
mixins: [convertCourseData],
props: ['course'],

computed: {
    classStartTime() {
        return this.convertTime(this.course.meetings[0].start_time);
    },

    classEndTime() {
        return this.convertTime(this.course.meetings[0].end_time);
    },
},

methods: {
    ...mapGetters(['currentStudent']),

    storeSelectedCourse() {
        this.$store.dispatch('storeLocation', 'class');
        this.$store.dispatch('storeCourse', this.course.id);
    },

    clearStudent() {
        if (this.currentStudent) {
            this.$store.dispatch('clearStudent');
        }
    },
},

};
</script>