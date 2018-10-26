<template>
<div>
    <div class="profile__color-layer profile-pic-container type--center">
            <div class="profile__divider">
                <carousel :perPage="1" :paginationActiveColor="'#919191'" :paginationColor="'rgba(145,145,145,.3)'">
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.likeness" :editable="true" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Faculty Uploaded</i>
                        </div>
                    </div>
                    </slide>
                    <slide class="slide-wrap">
                    <div>
                        <profile-picture :student="student" :image="student.images.avatar" :editable="true" :type="'profile'"></profile-picture>
                        <div class="type--center">
                            <i>Student Uploaded</i>
                        </div>
                    </div>
                    </slide>
                </carousel>
            </div>
            <div class="profile__divide">
                <div class="profile__name-container">
                    <h5 class="type--center profile__name">{{student.first_name+ " " +student.last_name}}</h5>
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
}
</script>