<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="type--center">{{this.student.displayName}}</h2>
                    <i class="fas fa-2x fa-volume-up profile-header__audio-button" @click="listenAudio()"></i>
                </div>
                <div class="type--center">
                    <carousel :perPage="1" :paginationActiveColor="'#4F9DA3'">
                        <slide class="slidewrap">
                            <div class="imagewrap">
                                <profile-picture :image="image"></profile-picture>
                                <div class="type--center">
                                    <i class="fas fa-2x fa-pencil-alt profile-edit-button" @click="checkPermission"></i>
                                    <image-handler image_type="likeness"></image-handler>
                                </div>
                            </div>
                        </slide>
                        
                        <slide class="slidewrap">
                            <div class="imagewrap">
                                <profile-picture :image="avatar"></profile-picture>
                                <div class="type--center">
                                    <image-handler image_type="avatar"></image-handler>
                                </div>
                            </div>
                        </slide>
                            <!-- <slide class="slidewrap">
                                <div class="imagewrap">
                                    <profile-picture :image="studentProfile.images['official']"></profile-picture>
                                    <div class="type--center">
                                        <image-handler image_type="official"></image-handler>
                                    </div>
                                </div>
                            </slide>
                            -->
                    </carousel>
                    <croppa-modal :showModal="showCroppaModal" :student="student" @close="setImgUrl()"></croppa-modal>
                </div>
            </div>
        </div>
        <div class="addedUnderline">
        <ul class="underlineContainer">
            <li class="underline">
                <div v-if="student.imagePriority === 'likeness'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li>
            <li class="underline">
                <div v-if="student.imagePriority === 'avatar'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li>
            <!-- <li class="underline">
                <div v-if="studentProfile.imagePriority === 'official'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li> -->
        </ul>
    </div>
    </div>
</template>
<script>
import croppaModal from "../profile_components/croppaModal.vue";
import profilePicture from "../profile_components/profilePicture.vue";
import imageHandler from "../profile_components/imageHandler.vue";
import { mapGetters } from 'vuex';
export default {
        name: "profile-carousel",

        props: ['student'],

        data: function () {
            return {
                showCroppaModal: false,
            }
        },
        beforeRouteLeave(to, from, next) {
            if (this.unsavedChanges) {
                const answer = window.confirm('Do you really want to leave? You have unsaved changes.');

                if (answer) {
                    next();
                } else {
                    next(false);
                }
            } else {
                next();
            }
        },
        components: {
            croppaModal,
            imageHandler,
            profilePicture
        },
        computed: {
            ...mapGetters([
                'permission',
            ]),
            image: function() {
                return this.student.images.likeness;
            },

            avatar: function() {
                return this.student.images.avatar;
            },
        },

        methods: {
            setImgUrl (url) {
                this.showCroppaModal = false;
                this.imgUrl = url;
            },
            checkPermission() {
            this.showCroppaModal = true;
            if (this.permission == false)
                this.$store.dispatch('nullifyPermissionResponse');
            },
            // listenAudio() {
            //         window.axios.get(this.student.name_recording, {
            //         }).then(response => {
            //             if (response.status) {
            //                 console.log(this.student.name_recording);
            //             }
            //         }).catch(e => {
            //             alert("Sorry, this student has not submitted a recording of their name.");
            //         });
            //     }
            // },
        }
            
        }
</script>