<template>
     <div>
         <div v-if="this.shouldLoadClasses" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon_theme"></i>      
         </div>
         <div v-else>
            <h2>{{this.displayCurrentTerm}} Courses</h2>     
            <course-list></course-list>
        </div>
    </div>
</template>

<script>
    import courseList from './courseList'
    import { mapGetters } from 'vuex'
    export default {
        name: "courses-container",

        data: function() {
            return {
                displayedTerm: '',
            }
        },

        components: {
            courseList,
        },

        //On page load, sets 'Spring' as default season option
        created() {
            this.$store.dispatch('setSpring');
        },

        computed: {
            ...mapGetters([
                'list',
                'courses',
                'facultyMember',
                'facultyFullName',
                'term',
                'loadingClasses'

            ]),

            shouldLoadClasses() {
                if(this.facultyMember.image === null || this.loadingClasses)
                    return true;
                else
                    return false;
            },

            displayCurrentTerm () {
            if(this.term != null) {
            let termCode = this.term;
            switch(termCode.charAt(3)) {
                case "3":
                    this.displayedTerm = "Spring";
                    break;
                case "5":
                    this.displayedTerm = "Summer";
                    break;
                case "7":
                    this.displayedTerm = "Fall";
                    break;
                case "9":
                    this.displayedTerm = "Winter";
            }
            if(termCode.charAt(0)=='2'){
                this.displayedTerm += ' ' + termCode.charAt(0) + '0' + termCode.substring(1,3)
            }
            else
            {
                this.displayedTerm += ' ' + termCode.charAt(0) + '9' + termCode.substring(1,3)
            }
            return this.displayedTerm;
            }
        },
        },
    }
</script>
