<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri" class="clearPadding panel col-xs-12 col-md-12 col-lg-12">
        <div class="panel__content col-xs-12 col-md-12 col-lg-12">
            <div class="pull-left col-xs-5 col-md-3 col-lg-3 clearPadding">
                <profile-picture class="pull-left " :name="display_name" :image="image"></profile-picture>
            </div>
            <div class="col-xs-7 col-md-9 col-lg-9">
                <router-link class="type--center student_list_name student_list_name_mobile" :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                    {{display_name}}
                </router-link>
            </div>
        </div>
    </router-link>
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import croppaProfile from "../../components/profile_components/croppaProfile.vue";
import modal from "../../components/fixed_components/modal.vue";

export default {
    name: "student-list-item",

    props:["student"],

    computed: {
            
        ...mapGetters([
            'studentImages'  
         ]),

        display_name: function() {
            return this.student.first_name + " " + this.student.last_name;
        },
            
        email_uri : function () {
            return this.student.email.split('@')[0].replace("nr_", "");
        },

        image: function() {
            return this.studentImages[this.student.student_id];
        }
    }
}
</script>
