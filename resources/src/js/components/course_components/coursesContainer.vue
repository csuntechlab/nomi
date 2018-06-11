<template>
     <div>
        <h2>{{this.term}} Courses</h2>
         <div v-if="facultyMember.image === null" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>      
         </div>
         <div v-else-if="courses === null">
             {{console.log("haha yes")}};
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
                term: ''
            }
        },

        created: function () {
            var curTerm = document.querySelector('meta[name=current-term]').content;
            if(curTerm.length == 4){
                switch(curTerm.charAt(3)) {
                    case "3":
                        this.term = "Spring";
                        break;
                    case "5":
                        this.term = "Summer";
                        break;
                    case "7":
                        this.term = "Fall";
                        break;
                }
                this.term += ' ' + curTerm.charAt(0) + '0' + curTerm.substring(1,3)
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

            ])
        },
    }
</script>
