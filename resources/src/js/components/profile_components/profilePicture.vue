<template>
    <div>
        <img :src="this.image" class="profile_padding img--circle img--fluid-custom" :class="[ this.type == 'profile' ? 'profile__img' : 'roster__img' ]" name="photo">
        <i v-if="this.editable" class="fas fa-pencil-alt profile-carousel__edit" @click="checkPermission"/>
    </div>
</template>

<script>
export default {
  name: 'profile-picture',
  props: ['image', 'editable', 'type'],
  methods: {
    checkPermission() {
      this.$emit('showModal');
    },
  },
};
</script>