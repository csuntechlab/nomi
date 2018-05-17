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
                        <a href="javascript:history.go(-1)"><i class="fa fa-arrow-left fa-3x"></i></a>
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
                            <button class="btn btn-default" @click.prevent="commitNotes">Add a Note</button>
                            <br>
                            <h4 class="textOverflow">{{this.studentProfile.emailURI}}@my.csun.edu</h4>
                            <br>
                            <h4>Bio: {{this.studentProfile.bio}}</h4>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <modal v-if="showModal" @close="showModal = false">
                    <div slot="header">

                    </div>

                    <div slot="body">
                        <croppa-profile :studentImage="studentProfile.images['likeness']"></croppa-profile>
                    </div>

                </modal>
            </div>
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

        components: {
            ImageHandler,
            croppaProfile,
            modal
        },

        data() {
            return {
                showModal: false
            }
        },

        created () {
            this.$store.dispatch('getStudentProfile', { uri: this.$route.params.emailURI, faculty_id: this.facultyMember.id });
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
                this.$store.dispatch('updateNotes', e.target.value);
            },

            commitNotes () {
                this.$store.dispatch('commitNotes');
            },

            croppaToggle(){
                this.showcroppa = !this.showcroppa;
            },
        }
    }
</script>
