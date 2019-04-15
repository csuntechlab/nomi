<template>
<div>
    <div class="profile profile__color-layer type--center">
            <div class="profile__divider-carousel">
                <carousel v-if="studentProfile.imagePriority === 'likeness'" :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :image="this.studentProfile.images['likeness']" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :image="this.studentProfile.images['avatar']" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>

                <carousel v-else :perPage="1" :paginationActiveColor="'#919191'"   :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :image="this.studentProfile.images['avatar']" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :image="this.studentProfile.images['likeness']" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center profile__uploaded-text">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>

                <div class="panel__edit-button-sim">
                    <div class="panel__edit-button-wrapper">
                        <div class="panel__edit-button-container">
                            <i v-if="emailExists" data-interactable class="fas fa-cog panel__edit-button--profile" @click="showModal()"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile__divider">
                <div class="profile__name-container">
                    <h1 id="profile__name" class="type--center profile__name">{{ this.studentProfile.displayName }}</h1>
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
    data: function() {
        return{
            imageUrl: document.querySelector('meta[name=img-url]').content,
            secret: document.querySelector('meta[name=secret]').content + '&source=true',
        }
    },
    components:{
        profilePicture
    },
    
    computed: {
        ...mapGetters(["studentProfile", "permission"]),
        emailExists() {
            return this.studentProfile.email.split('@')[1] != 'NOTREALEMAIL.net';
            return this.goToPage(0)
        }
    },

	methods: {
		...mapActions(['toggleModal', 'nullifyPermissionResponse','toggleCropping']),

		showModal() {
			if(this.permission === true)
			{
				this.toggleModal(true);
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
