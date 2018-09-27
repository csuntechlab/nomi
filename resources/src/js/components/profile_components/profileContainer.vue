<template>
<div>
    <div class="container">
        <div>
            <div>
                <h1 class="type--center">{{student.displayName}}</h1>
            </div>
            <div>
                <profile-picture :student="student" :image="student.images[student.imagePriority]" :editable="true" :type="'profile'"></profile-picture>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import profilePicture from "../profile_components/profilePicture.vue"; 
export default {
  name: "profile-container",
  props: ['student'],
  components:{
      profilePicture
  }
}
</script>