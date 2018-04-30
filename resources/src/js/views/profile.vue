<template>
    <div>
        <div class="section--lg section--md student-banner" style="padding:1rem 0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="javascript:history.go(-1)" @click="$store.dispatch('resetFetched')"><i class="fa fa-arrow-left fa-3x"></i></a>
                    </div>
                </div>
                <h1 class="type--thin type--marginless type--center">{{this.studentProfile.displayName}}</h1>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 default_padding">
                        <carousel :perPage="1">
                            <slide>
                                <croppa-profile class="grid-image img--circle"></croppa-profile>
                                <image-handler image_type="likeness"></image-handler>
                            </slide>
                            <slide>
                                <profile-picture :image="studentProfile.images['avatar']"></profile-picture>
                                <image-handler image_type="avatar"></image-handler>
                            </slide>
                            <slide>
                                <profile-picture :image="studentProfile.images['official']"></profile-picture>
                                <image-handler image_type="official"></image-handler>
                            </slide>
                        </carousel>
                    </div>
                </div>
            </div>
        </div>
        <div class="section type--center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="type--black type--thin type--marginless">Email: {{this.studentProfile.emailURI}}<br>@my.csun.edu</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Bio: {{this.studentProfile.bio}}</h4>
                        <br>
                        <form>
                            <label>Add a Note: <i class="fa fa-plus-circle fa-blue"></i>
                                <textarea id="ex0" name="ex0" :value="this.sp_notes" @input="updateNotes"></textarea>
                            </label>
                            <button class="btn-default btn" @click="commitNotes">Commit</button>
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