<template>
    <li class="list__item light-grey col-xs-12">
        <div class="container">
            <div class="row">
                    <strong>
                        <router-link :to="'/class/'+course.id+'/'+course.title">{{course.title}}</router-link>
                    </strong>
                    <div class="col-xs-4">
                        {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                    </div>
                    <div class="col-xs-5">
                        {{course.meetings[0].location}} {{course.meetings[0].days}}
                        {{course.meetings[0].start_time}}-{{course.meetings[0].end_time}}
                    </div>
                    <div class="col-xs-2">
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
