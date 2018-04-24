<template>
    <div>
         <div v-if="sp_images == null" class="type--center">
             <br>
             <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
        </div>
        <div v-else>
            <div class="banner__position bg--blue-green">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <router-link class="light-grey" :to="'/class/'+this.courseid" @click.native="$store.dispatch('getData')">
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
                        <carousel :perPage="1">
                            <slide>
                                <croppa-profile class="grid-image img--circle"></croppa-profile>
                                <image-handler image_type="likeness"></image-handler>
                            </slide>
                            <slide>
                                <profile-picture :image="sp_images['avatar']"></profile-picture>
                                <image-handler image_type="avatar"></image-handler>
                            </slide>
                            <slide>
                                <profile-picture :image="sp_images['official']"></profile-picture>
                                <image-handler image_type="official"></image-handler>
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
                        <h4 class="type--black type--thin type--marginless">Email: {{this.sp_emailURI}}<br>@my.csun.edu</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Bio: {{this.sp_bio}}</h4>
                        <br>
                        <form>
                            <label>Add a Note: <i class="fa fa-plus-circle fa-blue"></i></label>
                            <textarea type="text" id="ex0" name="ex0"  :value="sp_notes" @input="updateNotes"></textarea>
                            <button class="btn-default btn" @click="commitNotes">Commit</button>
                        </form>
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

        components: {
            ImageHandler,
            croppaProfile
        },

        name: 'profile',

        created () {
            this.$store.dispatch('getStudentProfile', { uri: this.$route.params.emailURI });
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

            commitNotes () {
                this.$store.dispatch('commitNotes');
            },

            croppaToggle(){
                this.showcroppa = !this.showcroppa;
            },
        }
    }
</script>