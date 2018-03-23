<template>
    <div>
        <div class="banner__position blue-green">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="type--white type--thin type--marginless">Back</h4>
                    </div>
                </div>

            </div>

        </div>

        <div class="section--lg section--md student-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="type--white type--thin type--marginless type--center">Insert Photo</h1>
                        <h1 class="type--white type--thin type--marginless type--center">Student Name</h1>
                    </div>
                </div>

            </div>

        </div>

        <div class="section type--center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="type--black type--thin type--marginless">Nick Name</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Major: Computer Science</h4>
                        <br>
                        <h4 class="type--black type--thin type--marginless">Email: student@my.csun.edu</h4>
                        <br>

                        <h4 class="type--black type--thin type--marginless">
                            Bio:
                        </h4>
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

        <menu-bar></menu-bar>
        <div class="menu__compensation">

        </div>
    </div>
</template>
<script>
    export default {
        name: 'profile',

        data: function () {
            return {

            }
        },




    }
</script>