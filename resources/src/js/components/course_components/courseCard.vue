<template>
    <div>
        <div class="panel">
                <div class="grid-item bg--light-grey panel-content">
                    <div>
                        <div class="course_title">
                            <router-link :to="'/class/'+course.id">{{course.title}}</router-link>
                        </div>
                    </div>
                    <div class="time_location course_time">
                        {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                        {{classStartTime}} - {{classEndTime}}
                    </div>
                    <div class="time_location course_specifications">
                        {{course.meetings[0].location}} {{course.meetings[0].days}}
                    </div>
                    <div class="num_students course_specifications">
                        {{course.enrollment_count}} Students
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: "course-card",
    
    data: function () {
        return {
            show: true,
            messages: true,
            errors: [],
        }
    },

    props: ['course'],

    computed: {
        classStartTime: function () {
            return this.convertTime(this.course.meetings[0].start_time)
        },

        classEndTime: function() {
            return this.convertTime(this.course.meetings[0].end_time)
        }
    },

    methods: {
        convertTime: function (OriginalTime) {
            let time = OriginalTime;
            let hour = parseInt(time.substring(0, 2));
            let min = time.substring(2, 4) + "am";
            if(hour > 12) {
                hour = hour - 12;
                min = min.substring(0, 2) + "pm"
            }
            time = hour + ":" + min;
            return time
        }
    }
    
}
</script>
