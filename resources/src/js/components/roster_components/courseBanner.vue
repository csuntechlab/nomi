<template>
        <div class="tab-container">
            <ul class="tabs cf">
                <li v-for="course in this.courses" :key="course.title" :course="course" class="tab__list">
                    <router-link :class="activeTab(course.id)" :to="'/class/'+course.id">
                        {{course.title}}
                    </router-link>
                </li>
            </ul>
        </div>
</template>
<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        methods: {
            activeTab: function (id) {
                if(id.toString() === this.$route.params.id)
                    return "tab__link--active";
                else
                    return "tab__link";
            },

            setScrollBar(){
                let screenSize = ;
                let xPos = screenSize/this.courses.length;
                window.scrollTo( xPos*courses[selected], 0);
            }
        },

        beforeMount(){
            setScrollBar();
        },

        computed: {
            ...mapGetters([
                'courses'
            ]),


        },


    }
</script>