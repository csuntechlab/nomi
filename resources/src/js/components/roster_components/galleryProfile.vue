<template>
    <div>
		<router-link :to="'/profile/'+this.$route.params.id+'/'+email" @click.native="getStudent()" tag="a">
        <img :id="'photo-gallery--'+email" :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">
        </router-link>          
		<i v-if="this.editable" data-interactable class="fas fa-pencil-alt panel__edit-button pull-right" @click="showModal()"/>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import { getStudent } from './../../mixins/getStudent.js';
import { refetchImage } from './../../mixins/refetchImage.js';

export default {
	name: "gallery-profile",
	props: ["image", "student", "type", "editable", "email"],
	mixins: [getStudent, refetchImage],
	computed: {
	...mapGetters(["permission"])
	
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
};
</script>
