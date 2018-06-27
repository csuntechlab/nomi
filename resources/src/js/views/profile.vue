<template>
    <div>
        <div v-if="studentProfile.images == null" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="type--center">{{studentProfile.displayName}}</h1>
                    </div>
                    <div class="type--center">
                        <carousel
                                :perPage="1"
                                :paginationActiveColor="'#4F9DA3'"
                        >
                            <slide class="slidewrap">
                                <div class="imagewrap">
                                    <profile-picture :image="image"></profile-picture>

                                    <div class="type--center">
                                        <image-handler image_type="likeness"></image-handler>
                                    </div>
                                    <div class="type--center">
                                        <button class="btn btn-default" @click="showModal = true">Edit Photo</button>
                                        <br>
                                    </div>
                                </div>
                            </slide>
                            <!--
                            <slide class="slidewrap">
                                <div class="imagewrap">
                                    <profile-picture :image="studentProfile.images['avatar']"></profile-picture>
                                    <div class="type--center">
                                        <image-handler image_type="avatar"></image-handler>
                                    </div>
                                </div>
                            </slide>
                            <slide class="slidewrap">
                                <div class="imagewrap">
                                    <profile-picture :image="studentProfile.images['official']"></profile-picture>
                                    <div class="type--center">
                                        <image-handler image_type="official"></image-handler>
                                    </div>
                                </div>
                            </slide>
                            -->
                        </carousel>
                    </div>
                </div>
            </div>
            <!-- <div class="addedUnderline">
                <ul class="underlineContainer">
                    <li class="underline">
                        <div v-if="studentProfile.imagePriority === 'likeness'">
                            <div class="">
                                <i class="fa fa-chevron-up fa-blue fa-2x"></i>
                            </div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                    <li class="underline">
                         <div v-if="studentProfile.imagePriority === 'avatar'">
                            <div class="">
                                <i class="fa fa-chevron-up fa-blue fa-2x"></i>
                            </div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                    <li class="underline">
                         <div v-if="studentProfile.imagePriority === 'official'">
                            <div class="">
                                <i class="fa fa-chevron-up fa-blue fa-2x"></i>
                            </div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div> -->
            <profile-info :studentBio="this.studentProfile.bio" :studentNotes="this.studentProfile.notes"></profile-info>
            <croppa-modal v-on:closeModal="setImgUrl()" :showModal = showCroppaModal :imgUrl = imgUrl></croppa-modal>
            <modal v-if="showEmail" @close="closeEmail">
                <div slot="header"></div>
                <div slot="body">
                    <h5 class="textOverflow email_padding">{{this.studentProfile.emailURI}}@my.csun.edu</h5>
                </div>
            </modal>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapState } from 'vuex'
    import imageHandler from "../components/profile_components/imageHandler.vue";
    import croppaProfile from "../components/profile_components/croppaProfile.vue";
    import croppaModal from "../components/profile_components/croppaModal.vue";
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

            closeEmail(){
                this.showEmail = false;
            },

            setImgUrl (url) {
                this.showModal = false;
                this.imgUrl = url;
            },
        }
    }
</script>
