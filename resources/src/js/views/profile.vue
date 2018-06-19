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
        <div class="container type--center margin_between_containers">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea type="text" id="ex0" name="ex0" :value="sp_notes" @input="updateNotes"></textarea>
                            <div v-if="noteSaved">Notes Saved!</div>
                            <div v-if="unsavedChanges">There are unsaved changes.</div>
                            <div class="clearPadding">
                                <button class="btn btn-default" @click.prevent="commitNotes">Save Notes</button>
                            </div>
                            <br>
                            <div class="type--center btn_padding">
                                <button class="btn btn-default" @click="showEmail = true">Show Email</button>
                                <br>
                            </div>
                            <br>
                            <h4>Bio: {{this.studentProfile.bio}}</h4>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <modal v-if="showModal" @close="setImgUrl">
                <div slot="header"></div>
                <div slot="body">
                    <croppa-profile :studentImage="studentProfile.images['likeness']"></croppa-profile>
                </div>
            </modal>
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
    import ImageHandler from "../components/fixed_components/imageHandler.vue";
    import croppaProfile from "../components/fixed_components/croppaProfile.vue";
    import modal from "../components/fixed_components/modal.vue";
    export default {
        name: 'profile',

        data: function () {
            return {
                unsavedChanges: false,
                noteSaved: false,
                showModal: false,
                imgUrl: null,
                showEmail: false,
            }
        },

        components: {
            ImageHandler,
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
            
            this.$store.dispatch('getData');
        },

        beforeRouteLeave (to, from, next) {
            if(this.unsavedChanges) {
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
            ...mapGetters([
                'studentProfile',
                'facultyMember',
                'studentImages'
            ]),

            ...mapState({
                sp_notes: state => state.profile.studentProfile.notes
            }),

            image: function() {
                let id = this.studentProfile.id.replace("members:","");
                return this.studentImages[id];
            }
        },

        methods: {
            updateNotes (e) {
                this.$store.dispatch('updateNotes', e.target.value)
                    .then(() => {
                        this.noteSaved = false;
                        this.unsavedChanges = true;
                    });
            },

            commitNotes () {
                this.$store.dispatch('commitNotes')
                    .then(() => {
                        this.noteSaved = true;
                        this.unsavedChanges = false;
                    });
            },

            croppaToggle(){
                this.showcroppa = !this.showcroppa;
            },

            setImgUrl (url) {
                this.showModal = false;
                this.imgUrl = url;
            },

            closeEmail(){
                this.showEmail = false;
            }
        }
    }
</script>
