<template>
    <div>
        <div v-if="studentProfile.images == null" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <profile-carousel :student="this.studentProfile"></profile-carousel>
            <profile-info :student="this.studentProfile"></profile-info>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import profileCarousel from "../components/profile_components/profileCarousel.vue";
    import profileInfo from "../components/profile_components/profileInfo.vue";
    export default {
        name: 'profile',

        data: function () {
            return {
                imgUrl: null,
            }
        },

        components: {
            profileCarousel,
            profileInfo
        },

        created () {
            this.$store.dispatch(
                'getStudentProfile',
                {
                    uri: this.$route.params.emailURI,
                    faculty_id: this.facultyMember.id
                }
            );
        },

        computed: {
            ...mapGetters([
                'studentProfile',
                'facultyMember',
                'studentImages',

            ]),
        },
    }
</script>
