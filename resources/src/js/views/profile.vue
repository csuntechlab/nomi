<template>
    <div>
        <div class="banner__position blue-green">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <router-link style="color:#f4f4f4" :to="'/class/'+this.courseid">
                            <h4>Back to {{this.courseTitle}}</h4>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="section--lg section--md student-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <img :id="this.sp_display_name+'-img'" :src="this.sp_image" class="img--circle grid-image" name="photo">
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
                        <h4 class="type--black type--thin type--marginless">Email: {{this.sp_emailURI}}@my.csun.edu</h4>
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
    export default {
        name: 'profile',

        created () {
            this.$store.dispatch('getStudentProfile', { uri: this.$route.params.emailURI });
        },

        computed: {
            ...mapGetters([
                'courseid',
                'courseTitle',
                'sp_emailURI',
                'sp_display_name',
                'sp_major',
                'sp_bio',
                'sp_image',
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
            }
        }
    }
</script>