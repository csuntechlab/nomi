<template>
    <li class="list__item">
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <img :id="display_name+'-img'" :src="student.image" class="img--circle" style="width:100%;">
                </div>
                <div class="col-xs-9">
                    {{display_name}}
                    <br />
                    nickname
                </div>
            </div>
        </div>
    </li>
</template>

<script>
    export default{
        name: "student-list-item",

        props:['student'],

        computed: {
            display_name: function() { return this.student.first_name + " " + this.student.last_name; }
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
