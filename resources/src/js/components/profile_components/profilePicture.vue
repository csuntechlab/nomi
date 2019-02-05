<template>
    <div>
		<img id="photo-profile" :src="image" class="img--circle" :class="[ this.type == 'profile' ? 'profile__img profile__img--border' : 'roster__img' ]" name="photo">
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import moment from 'moment';

export default {
	name: "profile-picture",
	props: ["image", "student", "type", "editable"],

	mounted() {
		this.$el.childNodes[0].src  = "./images/profile-loading.gif";
		this.$el.childNodes[0].src = this.image + '&timestamp=' + moment().format('DDhmmss');
	},
};
</script>
