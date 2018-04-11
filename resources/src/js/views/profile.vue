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
                        <h1 class="type--white type--thin type--marginless type--center">{{this.sp_display_name}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="section type--center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="type--black type--thin type--marginless">Major: {{this.sp_major}}</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Email: {{this.sp_emailURI}}<br>@my.csun.edu</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Bio: {{this.sp_bio}}</h4>
                        <br>
                        <form>
                            <div class="form__group">
                                <h4 class="type--black type--thin type--marginless">
                                    <i class="fa fa-plus-circle fa-blue"></i>
                                    Add a Note:
                                </h4>
                                <textarea id="ex0" name="ex0" @input="updateNotes">{{this.sp_notes}}</textarea>
                                <button class="button" @click="commitNotes">Commit</button>
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
                'sp_major',
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