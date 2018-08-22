<template>
    <div class="row">
            <div class="roster-list__item">
                <div class="row">
                    <router-link :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                    <div class="col-xs-3 col-md-2">
                        <profile-picture class="pull-left " :name="display_name" :image="image"></profile-picture>
                    </div>
                    <div class="col-xs-7 col-md-8">
                        <router-link class="type--center student_list_name student_list_name_mobile" :to="'/profile/'+this.$route.params.id+'/'+email_uri">
                            {{display_name}}
                        </router-link>
                    </div> 
                    </router-link>  
                    <div class="col-xs-2 col-md-2">
                        <audio id="audio_name">
                            <source :src="this.student.name_recording"  type="audio/mpeg">
                        </audio>
                        <i class="fas fa-2x fa-volume-up student-list__audio-button" @click="listenAudio()"></i>
                    </div>
                </div>
            </div>
    </div>
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
            return this.student.email.split('@')[0].replace("nr_", "");
        },

        image: function() {
            if (this.student.image_priority === 'likeness') {
                return this.student.images.likeness;
            } else if (this.student.image_priority === 'avatar') {
                return this.student.images.avatar;
            }
        }
    }, 
    methods: {
        listenAudio() {
                    axios.get(this.student.name_recording)
                    .then(response => {
                        if (response.status) {
                            document.getElementById('audio_name').play();
                            console.log(this.student.name_recording);
                            }
                        else {
                            alert("Sorry, this student has not submitted a recording of their name.");
                        }
                    }).catch(e => {
                        console.log(e);
                    });
            }
    }
}
</script>
