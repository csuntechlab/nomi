<template>
     <div>
        <h2>{{this.getTerm}} Courses</h2>
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

        components: {
            courseList,
        },

        computed: {
            ...mapGetters([
                'list',
                'courses',
                'facultyMember',
                'facultyFullName',

            ]),

            getTerm: function() {
                return this.courses[0]['term'].replace('-',' ')
            }
        }
    }
</script>
