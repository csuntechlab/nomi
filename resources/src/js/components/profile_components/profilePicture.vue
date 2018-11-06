<template>
    <div>
		<img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img profile__img--border' : 'roster__img' ]" name="photo">
		<i v-if="editable" class="fas fa-pencil-alt panel__edit-button--profile " @click="showModal()"/>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
	name: "profile-picture",
	props: ["image", "student", "type", "editable"],
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
