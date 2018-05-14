<template>
    <div>
        <div v-if="studentProfile.images == null" class="type--center">
            <br>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else class="profileArea">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <back-button destination="/class/0"></back-button>
                        <h1 class="type--center">{{this.studentProfile.displayName}}</h1>
                    </div>
                    <div class="row">
                        <div class="type--center">
                            <carousel 
                            :perPage="1" 
                            :paginationActiveColor="'#4F9DA3'"
                            >
                                <slide>
                                        <div class="imagewrap">
                                            <croppa-profile class=""></croppa-profile>

                                            <div class="col-xs-6 col-md-6 col-lg-6 pull-right">
                                                <image-handler image_type="likeness"></image-handler>
                                            </div>
                                            <div class="col-xs-6 col-md-6 col-lg-6 pull-left">
                                                <button class="btn btn-default"> Croppa Button Future </button>
                                            </div>
                                        </div>
                                </slide>
                                <slide>
                                    <div class="imagewrap">
                                        <profile-picture :image="studentProfile.images['avatar']"></profile-picture>
                                        <div class="col-xs-6 col-md-6 col-lg-6 pull-right">
                                            <image-handler image_type="avatar"></image-handler>
                                        </div>
                                    </div>
                                </slide>
                                <slide>
                                    <div class="imagewrap">
                                        <profile-picture :image="studentProfile.images['official']"></profile-picture>
                                        <div class="col-xs-6 col-md-6 col-lg-6 pull-right">
                                            <image-handler image_type="official"></image-handler>
                                        </div>
                                    </div>
                                </slide>
                            </carousel>
                        </div>
                    </div>
                </div>
            </div>
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
            <div class="container type--center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form>
                                <textarea type="text" id="ex0" name="ex0"  :value="sp_notes" @input="updateNotes"></textarea>
                                <button class="btn btn-default" @click="commitNotes">Add a Note</button>
                            </form>
                            <br>
                            <h4>{{this.studentProfile.emailURI}}@my.csun.edu</h4>
                            <br>
                            <h4>Bio: {{this.studentProfile.bio}}</h4>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import { mapState } from 'vuex'
    import ImageHandler from "../components/fixed_components/imageHandler.vue";
    import croppaProfile from "../components/fixed_components/croppaProfile.vue";
    export default {
        name: 'profile',

        components: {
            ImageHandler,
            croppaProfile
        },

        created () {
            this.$store.dispatch('getStudentProfile', { uri: this.$route.params.emailURI });
        },

        computed: {
            ...mapGetters([
                'studentProfile',
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
