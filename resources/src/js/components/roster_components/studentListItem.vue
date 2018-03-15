<template>
    <li class="list__item">
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <img :id="student.display_name+'-img'" :src="student.image" class="img--circle" style="width:100%;">
                </div>
                <div class="col-xs-9 name_formatting">
                    {{student.display_name}}
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

        // computed: {
        //     getEmail: function() {
        //
        //         return this.student.email.replace('nr_', '')
        //     }
        // }
    }
</script>

<style scoped>
    .list__item{
        padding: 20px;
        -webkit-box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
        box-shadow: 0 5px 9px 3px rgba(0,0,0,0.2);
        font-size: 200%;
    }

    .name_formatting{
        padding: 5%;
    }
</style>
