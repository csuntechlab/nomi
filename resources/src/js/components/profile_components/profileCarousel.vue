<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="type--center">{{studentProfile.displayName}}</h1>
                </div>
                <!--profile-carousel-->
                <div class="type--center">
                    <carousel :perPage="1" :paginationActiveColor="'#4F9DA3'">
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
                    <croppa-modal v-on:closeModal="setImgUrl()" :showModal=s howCroppaModal :imgUrl=i mgUrl></croppa-modal>
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
    </div> -->
    </div>
</template>
<script>
import croppaModal from "../components/profile_components/croppaModal.vue";
export default {
        name: "profile-info",

        props: [
            'student'
        ],

        data: function () {
            return {
                unsavedChanges: false,
                noteSaved: false,
                showEmail: false,
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
        computed: {
        },

        methods: {
            updateNotes(e) {
                this.$store.dispatch('updateNotes', e.target.value)
                    .then(() => {
                        this.noteSaved = false;
                        this.unsavedChanges = true;
                    });
            },
            commitNotes() {
                this.$store.dispatch('commitNotes')
                    .then(() => {
                        this.noteSaved = true;
                        this.unsavedChanges = false;
                    });
            },
        }
    }
</script>