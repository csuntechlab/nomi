<template>
    <div>
        <!-- <div v-if="this.loading" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x fa-blue"></i>
            <br>
            <br>
        </div> -->
        <ul class="list">
            <student-list-item
                v-for="student in this.roster[this.courseid]"
                :key="student.display_name"
                :student="student"
            ></student-list-item>
        </ul>
    </div>
</template>

<script>
    import studentListItem from './studentListItem.vue';
    import { mapGetters } from 'vuex';
    export default {
        name: "student-list",

        data: function () {
            return {
                show: false,
                messages: true,
                errors: [],
                lastname: true,
                descending: true,
                //loading: true,
            }
        },

        // created () {
        //     this.$store.subscribe(mutation => {
        //         if (mutation.type === 'GET_COURSE_ID') {
        //             this.$socket.emit('loading', mutation.payload)
        //             this.loading = !this.loading; 
        //         }
        //     })
        // },

        components: {
            studentListItem
        },

        props: ['courseid'],

        computed: {
            ...mapGetters([
                'roster',
                //'courseid',
            ]),
        },
    }
</script>
