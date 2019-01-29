<template>
<div>
    <div class="profile profile__color-layer type--center">
            <div class="profile__divider-carousel">
                <carousel v-if="studentProfile.imagePriority === 'likeness'" :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="likenessImage" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="avatarImage" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>

                <carousel v-else :perPage="1" :paginationActiveColor="'#919191'"   :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="avatarImage" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="studentProfile.student" :image="likenessImage" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
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
                    <h1 id="profile__name" class="type--center profile__name"></h1>
                </div>
            </div>
    </div>
</div>
</template>
<script>
import profilePicture from "../profile_components/profilePicture.vue"; 
import { mapGetters, mapActions} from 'vuex';

export default {
    name: "profile-container",
    props: ['student'],
    data: function() {
        return{
            imageUrl: document.querySelector('meta[name=img-url]').content,
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
                return this.imageUrl + `${this.student.email_uri}`+ '/' +`likeness` + `${this.student.timestamp}`;
            }
        },
    
        avatarImage() {
            if(this.studentProfile){
                return this.imageUrl + `${this.student.email_uri}`+ '/' +`avatar` 
            }
        }
    },

    mounted() {
        let name = this.student.first_name + " " + this.student.last_name;
        let nameSplit = name.split(" ");
        let final_name = "";
        if (document.getElementById('profile__name') != null) {
            for (let i= 0; i < nameSplit.length; i++) {
                final_name = final_name + nameSplit[i] + '<br>' ;
            }

            document.getElementById('profile__name').innerHTML = final_name;
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
