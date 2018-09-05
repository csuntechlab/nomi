<template>
    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
        <div class="roster-list__item">
        <div class="row">
            <div class="col-xs-3 col-md-2">
                <profile-picture class="pull-left" :name="display_name" :image="image" :type="'roster'"></profile-picture>
            </div>
            <div class="col-xs-9 col-md-10">
                <router-link class="type--center student_list_name student_list_name_mobile" :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                    {{display_name}}
                </router-link>
            </div>
        </div>
        </div>
    </router-link>
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import modal from "../fixed_components/modal.vue";
import profilePicture from "../profile_components/profilePicture.vue";

export default {
    name: "student-list-item",

    props:["student"],

    components: {
        modal,
        profilePicture
    },

    computed: {
            
        ...mapGetters([
         ]),

        display_name: function() {
            return this.student.first_name + " " + this.student.last_name;
        },
            
        email_uri : function () {
            return this.student.email.split('@')[0];
        },

        image: function() {
            if (this.student.image_priority === 'likeness') {
                return this.student.images.likeness;
            } else if (this.student.image_priority === 'avatar') {
                return this.student.images.avatar;
            }
        }
    }
}
</script>
