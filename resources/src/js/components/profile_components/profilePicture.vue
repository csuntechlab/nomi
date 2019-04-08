<template>
    <div>
		<img id="photo-profile" :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img profile__img--border' : 'roster__img' ]" name="photo">
    </div>
</template>

<script>
export default {
	name: "profile-picture",
	props: ["image", "type", "editable"],
};
</script>
