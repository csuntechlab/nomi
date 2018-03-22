<template>
    <div>
        <div class="col-xs-6 col-md-4 col-lg-3" v-for="course in courses">
            <div class="panel">
                <div class="grid-item light-grey panel-content">
                    <div class="card-title">
                        <div class="panel-heading">
                            <router-link :to="'/class/'+course.id+'/'+course.title">{{course.title}}</router-link>
                        </div>
                    </div>

                    <div class="class_info">
                        {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                    </div>
                    <div class="time_location">
                        {{course.meetings[0].location}} {{course.meetings[0].days}}
                        {{course.meetings[0].start_time}}-{{course.meetings[0].end_time}}
                    </div>
                    <div class="num_students">
                        {{course.enrollment_count}} Students
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "course-matrix",

    data: function () {
        return {
            show: true,
            messages: true,
            errors: [],
        }
    },

    computed: {
        ...mapGetters([
            'courses'
        ])
    },
}
</script>
