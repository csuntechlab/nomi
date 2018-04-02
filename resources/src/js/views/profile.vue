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
                        <img :id="this.display_name+'-img'" :src="this.image" class="img--circle grid-image" name="photo">
                        <h1 class="type--white type--thin type--marginless type--center">{{this.display_name}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="section type--center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="type--black type--thin type--marginless">Major: {{this.major}}</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Email: {{this.emailURI}}@my.csun.edu</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Bio: {{this.bio}}</h4>
                        <br>
                        <form>
                            <div class="form__group">
                                <h4 class="type--black type--thin type--marginless">
                                    <i class="fa fa-plus-circle fa-blue"></i>
                                    Add a Note:
                                </h4>
                                <textarea id="ex0" name="ex0" placeholder="Comment.."></textarea>
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
    export default {
        name: 'profile',

        created () {
            this.$store.dispatch('sayHi');
        },

        mounted () {
            this.emailURI = this.$route.params.emailURI;
            this.axios.get('student/'+this.emailURI+'@my.csun.edu')
                .then(response => {
                    this.bio = response['data']['people'].biography;

                    if(this.bio === null)
                        this.bio = "None";

                    console.log("hey");
                })
                .catch(e => {
                    this.errors.push(e);
                });

            this.axios.get('student_profile/'+this.emailURI+'@my.csun.edu')
                .then(response => {
                    this.display_name = response['data'].display_name;
                    this.image = response['data'].image;
                    this.notes = response['data'].notes;
                    console.log("yo");
                })
                .catch(e => {
                    this.errors.push(e);
                });
        },

        data: function () {
            return {
                emailURI : 'undefined',
                display_name: 'undefined',
                major: 'None',
                bio: 'undefined',
                image: '',
                notes: ''
            }
        },

        computed : {
            ...mapGetters([
                'courseid',
                'courseTitle'
            ])
        }
    }
</script>