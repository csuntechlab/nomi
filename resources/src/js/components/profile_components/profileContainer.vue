<template>
<div>
    <div class="profile profile__color-layer type--center">
            <div class="profile__divider-carousel">
                <carousel v-if="studentProfile.imagePriority === 'likeness'" :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="likenessImage" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="avatarImage" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>

                <carousel v-else :perPage="1" :paginationActiveColor="'#919191'"   :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="avatarImage" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="likenessImage" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>

                <div class="panel__edit-button-sim">
                    <div class="panel__edit-button-wrapper">
                        <div class="panel__edit-button-container">
                            <i v-if="emailExists" class="fas fa-camera panel__edit-button--profile" @click="showModal()"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile__divider">
                <div class="profile__name-container">
                    <h5 class="type--center profile__name">{{student.first_name+ " " +student.last_name}}</h5>
                </div>
            </div>
    </div>
</div>
</template>
<script>
import profilePicture from "../profile_components/profilePicture.vue"; 
import { mapGetters, mapActions} from 'vuex';
import moment from 'moment';
export default {
    name: "profile-container",
    props: ['student'],

     data: function() {
      return{
        imageUrl:'https://api.sandbox.csun.edu/metalab/test/media/1.1/student/media/',
        secret: '?secret=IUEdtASs7sdiCZBe7Phb/26ilx8PyWr6N4vk8r59KSE019TgsFiBb19wKAxLnwGlbOENrRikSSi5NgqDOTsftw==', 
        timeStamp:  '&?version=' + moment().format()
      }
  },
    components:{
        profilePicture
    },
     
    computed: {
        ...mapGetters(["studentProfile", "permission"]),
        emailExists() {
            return this.student.email.split('@')[1] != 'NOTREALEMAIL.net';
            return this.goToPage(0)
        },
        likenessImage() {
            if(this.studentProfile){
                console.log(this.imageUrl + `${this.student.email_uri}`+ '/' +`likeness` + this.secret + this.timeStamp)
                return this.imageUrl + `${this.student.email_uri}`+ '/' +`likeness` + this.secret + this.timeStamp
            }
    },
    
        avatarImage() {
            if(this.studentProfile){
                return this.imageUrl + `${this.student.email_uri}`+ '/' +`avatar` + this.secret;
            }
        }
    },

	methods: {
		...mapActions(['toggleModal', 'dataForModal','nullifyPermissionResponse','toggleCropping']),

		showModal() {
			if(this.permission === true)
			{
				this.toggleModal(true);
				this.dataForModal(this.student);
			} else {
				this.nullifyPermissionResponse();
			}
			
			
		},

		checkPermission() {
			if (this.permission == false){
				this.$store.dispatch("nullifyPermissionResponse");
			}
			
		}
	},
}
</script>