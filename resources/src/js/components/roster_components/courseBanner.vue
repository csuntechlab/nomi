<template>
    <ul id="scrollBar" class="tabs cf">
        <li v-for="course in this.courses" :key="course.title" :course="course" class="tab__list">
            <router-link :class="activeTab(course.id)" :to="'/class/'+course.id">
                <div class="text_bold">
                    {{course.subject}} {{course.catalog_number}}: #{{course.section_number}}
                </div>
            </router-link>
        </li>
    </ul>
</template>
<script>
    import { mapGetters } from "vuex"
    export default {
        name: "course-banner",

        methods: {
            activeTab: function (id) {
                if (id.toString() === this.$route.params.id)
                    return "tab__link--active";
                else
                    return "tab__link";
            },
            setScrollBar() {
                let scrollBar = document.getElementById('scrollBar');
                let url = window.location.hash.split('/')[2];
                let itemSize = document.getElementsByTagName('li')[url].offsetWidth;
                let xPos = itemSize * url;
                scrollBar.scrollLeft = xPos - itemSize / 2;
            },
        },

        mounted() {
            this.setScrollBar();
        },

        computed: {
            ...mapGetters([
                'courses'
            ]),


        },


    }
</script>