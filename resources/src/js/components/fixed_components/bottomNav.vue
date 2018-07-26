<template>
    <div class="row bottom-nav">
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/">
            <i class="fas fa-2x fa-chalkboard-teacher"></i>
            <div class="bottom-nav__text">Courses</div>
        </router-link>
        <div v-if="this.currentCourse == null" class="col-xs-3 type--center bottom-nav__button" @click="this.console.log(this.currentCourse)">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </div>
        <router-link v-else class="col-xs-3 type--center bottom-nav__button" :to="{path:'/class/' + currentCourse}">
            <i class="fas fa-2x fa-user-graduate"></i>
            <div class="bottom-nav__text">Students</div>
        </router-link>
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/settings">
            <i class="fas fa-2x fa-cog"></i>
            <div class="bottom-nav__text">Settings</div>
        </router-link>
        <router-link class="col-xs-3 type--center bottom-nav__button" to="/">
            <i v-if="facultyMember.image == null" class="fas fa-2x fa-user-circle"></i>
            <div v-else>
                <div class="height_fix">
                    <img :src="facultyMember.image" class="bottom-nav__profile-pic img--circle faculty_image" name="photo">
                </div>
            </div>
            <div class="bottom-nav__text">Profile</div>
        </router-link>
    </div>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        name: "bottom-nav",

        data: function () {
            return {
                url: "",
                show: false
            };
        },

        computed: {
            ...mapGetters([
                "courses",
                "facultyMember",
                "currentCourse",
            ]),
        },
        created: function () {
            this.url = document.querySelector("meta[name=app-url]").content;
        },
        methods: {
            printCourse(){
                console.log(currentCourse);
            }
        }
    };
</script>