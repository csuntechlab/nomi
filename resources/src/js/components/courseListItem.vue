<template>
    <li class="list__item">
        <div class="container">
            <div class="row">
                <div class="col-xs-9">
                    {{course.title}}
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
