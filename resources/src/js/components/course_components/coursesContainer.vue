<template>
     <div>
        <h2>{{this.displayCurrentTerm}} Courses</h2>
         <div v-if="facultyMember.image === null" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>      
         </div>
         <div v-else>        
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
                displayedTerm: ''
            }
        },

        components: {
            courseList,
        },

        computed: {
            ...mapGetters([
                'list',
                'courses',
                'facultyMember',
                'facultyFullName',
                'term'

            ]),

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
                    break;
            }
            this.displayedTerm += ' ' + termCode.charAt(0) + '0' + termCode.substring(1,3)
            return this.displayedTerm;
            }
        },
        },
    }
</script>
