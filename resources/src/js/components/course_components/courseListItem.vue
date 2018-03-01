<template>
    <li class="list__item">
        <div class="container">
            <div class="row">
                <div class="col-xs-9">
                    <strong>
                        <router-link :to="'/class/'+course.id+'/'+course.title">{{course.title}}</router-link>
                    </strong>
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
    </li>
</template>

<script>
    export default{
        name: "course-list-item",

        props:['course'],
    }
</script>

<style scoped>
    .list__item{
        padding: 20px;
        -webkit-box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
        box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
    }
</style>
