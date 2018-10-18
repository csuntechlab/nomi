<template>
    <div>
		<router-link :to="'/profile/'+this.$route.params.id+'/'+email" tag="a">
        <img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">
        </router-link>          
		<i v-if="this.editable" class="fas fa-pencil-alt panel__edit-button pull-right" @click="showModal()"/>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
	name: "gallery-profile",
	props: ["image", "student", "type", "editable", "email"],
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
