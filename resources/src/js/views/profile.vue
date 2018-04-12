<template>
    <div>
        <div class="banner__position bg--blue-green">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <router-link style="color:#f4f4f4" :to="'/class/'+this.courseid" @click="this.$store.dispatch('getData')">
                            <h4>Back to {{this.courseTitle}}</h4>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="section--lg section--md student-banner default_padding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 default_padding">
                        <carousel v-if="this.show" :perPage="1">
                            <slide>

                                <croppa-profile class="grid-image img--circle" :stdImg="sp_images['likeness']" :stdEmail="sp_emailURI" ></croppa-profile>
                                <div v-if="sp_image_priority[0] == 'likeness'">
                                    <h2>This is the Active one</h2>
                                </div>
                                <div v-else>
                                    <image-handler :image_type="'likeness'"></image-handler>
                                </div>
                            </slide>
                            <slide>
                                <profile-picture :image="sp_images['avatar']"></profile-picture>
                                <div v-if="sp_image_priority[0] == 'avatar'">
                                    <h2>This is the Active one</h2>
                                </div>
                                <div v-else>
                                    <image-handler :image_type="'avatar'"></image-handler>
                                </div>
                            </slide>
                            <slide>
                                <profile-picture :image="sp_images['official']"></profile-picture>
                                <div v-if="sp_image_priority[0] == 'official'">
                                    <h2>This is the Active one</h2>
                                </div>
                                <div v-else>
                                    <image-handler :image_type="'official'"></image-handler>
                                </div>
                            </slide>
                        </carousel>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sx-12">
                            <h1 class="type--black type--marginless type--center">{{this.sp_display_name}}</h1>
                        </div>
                        <div class="col-xs-12">
                            <br>
                            <h2 class="profile_info type--black type--marginless pull-left space_btwn_components">Email: {{this.sp_emailURI}}</h2>
                            <br>
                        </div>
                        <div class="col-xs-12">
                            <h2 class="profile_info type--black type--marginless pull-left space_btwn_components">Bio: {{this.sp_bio}}</h2>
                            <br>
                            <br>
                        </div>
                        <form>
                            <div class="form__group">
                                <textarea id="ex0" name="ex0" @input="updateNotes">{{this.sp_notes}}</textarea>
                                <div class="col-sx-12 space_btwn_components">
                                    <div class="pull-right">
                                        <button class="save_button btn" @click.prevent="commitNotes">Save</button>
                                    </div>
                                </div>  
                            </div>
                        </form>
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
        components: {ImageHandler, croppaProfile},
        name: 'profile',

        created () {
            this.$store.dispatch('getStudentProfile', { uri: this.$route.params.emailURI });
        },

        data: function () {
            return {
                show: true,
                image_type: null,
                showBTN: false
            }
        },

        props: ['student'],

        computed: {
            ...mapGetters([
                'courseid',
                'courseTitle',
                'sp_emailURI',
                'sp_display_name',
                'sp_bio',
                'sp_images',
                'sp_image_priority',
            ]),

            ...mapState({
                sp_notes: state => state.sp_notes
            })
        },

        methods: {
            updateNotes (e) {
                this.$store.dispatch('updateNotes', e.target.value);
            },

            croppaToggle(){
                this.showcroppa = !this.showcroppa;
            },


            commitNotes () {
                this.$store.dispatch('commitNotes');
            },

        }
    }
</script>
