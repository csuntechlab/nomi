<template>
    <div>
        <img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">
		<i v-if="this.editable" class="fas fa-pencil-alt panel__edit-button pull-right" @click="showModal()"/>
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
		...mapActions(['toggleModal', 'dataForModal','nullifyPermissionResponse']),

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
