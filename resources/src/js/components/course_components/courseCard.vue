<template>
    <div>
        <div class="panel">
                <div class="grid-item light-grey panel-content">
                    <div>
                        <div class="course_title">
                            <router-link :to="'/class/'+course.id">{{course.title}}</router-link>
                        </div>
                    </div>
                    <div class="time_location course_time">
                        {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                        {{course.meetings[0].start_time}}-{{course.meetings[0].end_time}}
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
    
}
</script>
