<template>
    <div>
        <div class="banner__position blue-green">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <router-link style="color:#f4f4f4" :to="'/class/'+this.courseid">Back to {{this.courseTitle}}</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="section--lg section--md student-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <img :id="display_name+'-img'" :src="this.image" class="img--circle grid-image" name="photo">
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
            this.emailURI = this.$route.params.emailURI;
            this.axios.get('the business/'+this.emailURI)
                .then(response => {
                    console.log(response);
                })
                .catch(e => {
                    this.errors.push(e)
                });
        },

        data: function () {
            return {
                emailURI : 'undefined',
                display_name: 'undefined',
                major: 'undefined',
                bio: 'undefined',
                image: 'https://media1.popsugar-assets.com/files/thumbor/KUz8kgLXYu2sy_nD0OMGgrN67ow/fit-in/1024x1024/filters:format_auto-!!-:strip_icc-!!-/2013/07/24/867/n/1922441/b69ef1b430939b50_1/i/College-Student-Discounts.jpg'
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