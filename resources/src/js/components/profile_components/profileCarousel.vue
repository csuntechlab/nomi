<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="type--center">{{this.student.displayName}}</h1>
                </div>
                <div class="type--center">
                    <carousel :perPage="1" :paginationActiveColor="'#4F9DA3'">
                        <slide class="slidewrap">
                            <div class="imagewrap">
                                <profile-picture :image="image"></profile-picture>
                                <div class="type--center">
                                    <image-handler image_type="likeness"></image-handler>
                                </div>
                                <div class="type--center">
                                    <button class="btn btn-default btn-sm" @click="checkPermission">Edit Photo</button>
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
                    <croppa-modal :showModal="showCroppaModal" :student="student" @close="setImgUrl()"></croppa-modal>
                </div>
            </div>
        </div>
        <!-- <div class="addedUnderline">
        <ul class="underlineContainer">
            <li class="underline">
                <div v-if="studentProfile.imagePriority === 'likeness'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li>
            <li class="underline">
                <div v-if="studentProfile.imagePriority === 'avatar'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li>
            <li class="underline">
                <div v-if="studentProfile.imagePriority === 'official'">
                    <div class="">
                        <i class="fa fa-chevron-up icon_theme fa-2x"></i>
                    </div>
                </div>
                <div v-else>
                    <div class="underlineStyling"></div>
                </div>
            </li>
        </ul>
    </div> -->
    </div>
</template>
<script>
import croppaModal from "../profile_components/croppaModal.vue";
import imageHandler from "../profile_components/imageHandler.vue";
import profilePicture from "../profile_components/profilePicture.vue";
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
        },
        computed: {
            ...mapGetters([
                'studentImages',
                'permission',
            ]),
            image: function() {
                let id = this.student.id.replace("members:","");
                return this.studentImages[id];
            }
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
            }
        }
    }
</script>