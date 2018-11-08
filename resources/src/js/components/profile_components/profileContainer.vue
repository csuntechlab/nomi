<template>
<div>
    <div class="profile profile__color-layer type--center">
            <div class="profile__divider">
                <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.likeness" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.avatar" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>
                <i v-if="emailExists" class="fas fa-pencil-alt panel__edit-button--profile" @click="showModal()"/>
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
import { mapGetters, mapActions } from 'vuex';
export default {
  name: "profile-container",
  props: ['student'],
  components:{
      profilePicture
  },
  computed: {
      ...mapGetters(["permission"]),
      emailExists() {
      return this.student.email.split('@')[1] != 'NOTREALEMAIL.net';
    },
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