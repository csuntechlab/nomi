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
                                    <profile-picture :image="studentProfile.images['likeness']"></profile-picture>

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
            <!--
            <div class="addedUnderline">
                <ul class="underlineContainer">
                    <li class="underline">
                        <div v-if="studentProfile.imagePriority === 'likeness'">
                            <div class="underlineStyling--red"></div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                    <li class="underline">
                        <div v-if="studentProfile.imagePriority === 'avatar'">
                            <div class="underlineStyling--red"></div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                    <li class="underline">
                        <div v-if="studentProfile.imagePriority === 'official'">
                            <div class="underlineStyling--red"></div>
                        </div>
                        <div v-else>
                            <div class="underlineStyling"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        -->
            <div class="container type--center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea type="text" id="ex0" name="ex0" :value="sp_notes" @input="updateNotes"></textarea>
                            <div v-if="noteSaved">Notes Saved!</div>
                            <div v-if="unsavedChanges">There are unsaved changes.</div>
                            <button class="btn btn-default" @click.prevent="commitNotes">Save Notes</button>
                            <br>
                            <h4 class="textOverflow">{{this.studentProfile.emailURI}}@my.csun.edu</h4>
                            <br>
                            <h4>Bio: {{this.studentProfile.bio}}</h4>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <modal v-if="showModal" @close="showModal = false">
                <div slot="header"></div>
                <div slot="body">
                    <croppa-profile :studentImage="studentProfile.images['likeness']"></croppa-profile>
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
                showModal: false
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
                'facultyMember'
            ]),

            ...mapState({
                sp_notes: state => state.profile.studentProfile.notes
            })
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
        }
    }
</script>
