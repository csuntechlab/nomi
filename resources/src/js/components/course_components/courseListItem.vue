<template>
    <li class="list__item bg--light-grey col-xs-12">
        <div class="container">
            <div class="row">
                <strong>
                    <router-link :to="'/class/'+course.id">{{course.title}}</router-link>
                </strong>
                <div class="col-xs-4">
                    {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                </div>
                <div class="col-xs-5">
                    {{course.meetings[0].location}} {{course.meetings[0].days}}
                    {{classStartTime}} - {{classEndTime}}
                </div>
                <div class="col-xs-2">
                    {{course.enrollment_count}} Students
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default{
        name: "course-list-item",

        props:['course'],

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

<style scoped>
    .list__item{
        padding: 20px;
        -webkit-box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
        box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
    }
</style>
