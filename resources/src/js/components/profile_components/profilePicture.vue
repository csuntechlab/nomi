<template>
    <div>
		<router-link :to="'/profile/'+this.$route.params.id+'/'+email" tag="a"></router-link>
		<div v-if="handler">
			<a><img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo"></a>
		</div>
		<div v-else>
			<img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">

		</div>
        
		<!-- <img :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo"> -->
        
		<i v-if="this.editable" class="fas fa-pencil-alt panel__edit-button pull-right" @click="showModal()"/>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
	name: "profile-picture",
	props: ["image", "student", "type", "editable", "email", "handler"],
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

		check(e) {
			if(this.handler)
			{
				this.$router.push('/profile/'+this.$route.params.id+'/'+this.email);
			} else {
				e.preventDefault();
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
