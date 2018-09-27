<template>
    <div>
        <img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">
		<i v-if="this.editable" class="fas fa-pencil-alt panel__edit-button pull-right" @click="showModal()"/>
    </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';

export default {
	name: "profile-picture",
	props: ["image", "student", "type", "editable"],
	computed: {
		...mapGetters(["modalVisible"]),

	},

	methods: {
		...mapActions(['toggleModal', 'dataForModal']),

		showModal() {
			this.dataForModal(this.student);
			this.toggleModal(!this.modalVisible);
		},

		checkPermission() {
			if (this.permission == false){
				this.$store.dispatch("nullifyPermissionResponse");
			}
			
		}
	},
};
</script>
