<template>
    <div>
		<img v-bind:id="[editable ? 'photo-gallery--' + this.student.email_uri : null]" :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img profile__img--border' : 'roster__img' ]" name="photo">
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
	name: "profile-picture",
	props: ["image", "student", "type", "editable"],
};
</script>
