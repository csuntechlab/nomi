<template>
    <div class="panel col-xs-6 col-md-4 col-lg-4">
        <div class="panel__img">
            <profile-picture :name="display_name" :image="image"></profile-picture>
        </div>
        <div class="panel__content type--center">
            <router-link :to="'/profile/'+email_uri">
                {{display_name}}
            </router-link>
        </div>
    </div>
</template>

<script>
    export default{
        name: "student-list-item",

        props:['student'],

        computed: {
            display_name: function() {
                return this.student.first_name + " " + this.student.last_name;
            },

            email_uri : function () {
                return this.student.email.split('@')[0].replace("nr_", "");

            },

            image: function() { return this.student.images[this.student.image_priority]}
        }
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
