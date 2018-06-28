<template>
    <div>
        <div v-if="studentProfile.images == null" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <profile-carousel></profile-carousel>
        </div>
        <div>
            <profile-info :student="this.studentProfile"></profile-info>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapState } from 'vuex'
    import imageHandler from "../components/profile_components/imageHandler.vue";
    import croppaProfile from "../components/profile_components/croppaProfile.vue";
    import profileInfo from "../components/profile_components/profileInfo.vue";
    import modal from "../components/fixed_components/modal.vue";
    export default {
        name: 'profile',

        data: function () {
            return {
                showCroppaModal: false,
                imgUrl: null,
                showEmail: false,
            }
        },

        components: {
            imageHandler,
            croppaProfile,
            modal
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

            image: function() {
                let id = this.studentProfile.id.replace("members:","");
                return this.studentImages[id];
            }
        },

        methods: {
            croppaToggle(){
                this.showcroppa = !this.showcroppa;
            },

            setImgUrl (url) {
                this.showModal = false;
                this.imgUrl = url;
            },
        }
    }
</script>
