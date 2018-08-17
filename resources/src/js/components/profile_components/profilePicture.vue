<template>
    <div>
        <img :src="this.image" class="profile_padding profile_image img--circle img--fluid" name="photo">
        <i v-if="this.editable" class="fas fa-2x fa-pencil-alt profile-carousel__edit" @click="checkPermission"/>
    </div>
</template>

<script>
export default {
	name: "profile-picture",
	props: ["image", "editable"],
	methods: {
		checkPermission() {
			this.$emit('showModal');
		}
	},
};
</script>