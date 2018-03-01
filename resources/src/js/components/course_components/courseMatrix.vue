<template>
    <div v-if="show">
        <div class="col-xs-6" v-for="course in this.courses">
            <div class="panel">
                <div class="grid-item panel-content">
                    <div class="card-title">
                        <div class="panel-heading">
                            <strong>
                                <router-link :to="'/class/'+course.id+'/'+course.title">{{course.title}}</router-link>
                            </strong>
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
export default {
    name: "course-matrix",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('toggleView', function () {
            this.toggleViewHandler();
        }.bind(this));

    },

    data: function () {
        return {
            show: false,
            messages: true,
            errors: [],
        }
    },

    props: ['courses'],

    methods: {
        toggleViewHandler: function () {
            this.show = !this.show;
        }
    },

}

</script>
