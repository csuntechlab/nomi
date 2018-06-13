<template>
    <div>
        <div id="courseScroll">
            <course-banner></course-banner>
        </div>
        <settings-banner></settings-banner>
        <div class="container">
            <roster-container :courseid="this.$route.params.id"></roster-container>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
    export default {
        name: "class",
        created () {
            this.$store.dispatch('clearErrors');
        },

        methods: {
            // setScrollBar: function() {
            //     let barSize = document.body.clientWidth;
            //     let itemSize = barSize/this.courses.length;
            //     let url = window.location.hash.split('/');
            //     let xPos = itemSize*url[2];
            //     var container = this.$el.querySelector('#courseScroll');
            //     container.scrollTop = xPos;
            //     console.log('barSize ' + barSize);
            //     console.log('itemSize ' + itemSize);
            //     console.log('xPos ' + xPos);
            // },
            // scrollToEnd: function() {    	
            //     var container = this.$el.querySelector("#courseBanner");
            //     container.scrollTop = container.scrollHeight;
            // },
        },

        computed: {
            ...mapGetters([
                'courses'
            ]),
        }
    }
</script>
