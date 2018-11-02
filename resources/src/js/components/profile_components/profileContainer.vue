<template>
<div>
    <div class="container">
        <div>
            <div>
                <h1 class="type--center">{{student.first_name + " " + student.last_name}}</h1>
            </div>
            <div>
                
                <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.likeness" :editable="this.emailExists" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.avatar" :editable="false" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>
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
  },
  computed: {
      emailExists() {
      return this.student.email.split('@')[1] != 'NOTREALEMAIL.net';
    },
  }
}
</script>