<template>
        <div class="tab-container">
            <ul class="tabs cf">
                <li v-for="course in this.courses" :key="course.title" :course="course" class="tab_list">
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
                let barSize = document.body.clientWidth;
                let itemSize = barSize/this.courses.length;
                let url = window.location.hash.split('/');
                let xPos = itemSize*url[2];
                var container = this.$el;
                container.scrollLeft = xPos;
                console.log('barSize ' + barSize);
                console.log('itemSize ' + itemSize);
                console.log('xPos ' + xPos);
            },
        },

        //     setScrollBar: function() {
        //         let barSize = document.body.clientWidth;
        //         let itemSize = barSize/this.courses.length;
        //         let url = window.location.hash.split('/');
        //         let xPos = itemSize*url[2];
        //         console.log('barSize ' + barSize);
        //         console.log('itemSize ' + itemSize);
        //         console.log('xPos ' + xPos);
        //         window.scrollTo( 215*url[2], 0);
        //     },
        // },

        mounted() {
            //this.setScrollBar();
            window.scrollTo(500,0);
        },

        computed: {
            ...mapGetters([
                'courses'
            ]),


        },


    }
</script>