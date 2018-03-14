<template>
    <div>
        <shuffle-button :courseid="this.courseid"></shuffle-button>
        <card-toggle-button></card-toggle-button>
        <flash-card v-if="this.flash" v-for="student in this.flashroster[this.courseid]" :key="student.student_id" :student="student"></flash-card>
        <gallery-card v-else v-for="student in this.roster[this.courseid]" :key="student.student_id" :student="student"></gallery-card>
    </div>
</template>

<script>
import FlashCard from './flashCard';
import GalleryCard from "./galleryCard";
import { mapGetters } from 'vuex';
export default {
    name: "student-matrix",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('updateRecognized', function(id, known) {
            this.markStudentAsRecognized(id, known);
        }.bind(this));
    },

    data: function () {
        return {
            messages: true,
            errors: [],
        }
    },

    props: ['courseid'],

    components: {
        FlashCard,
        GalleryCard
    },

    computed: {
        ...mapGetters([
            'roster',
            'flashroster',
            'flash'
        ]),
    },

    methods: {
        markStudentAsRecognized: function(id, known) {
            this.flashroster[this.courseid].forEach((student) => {
                if(student.student_id === id) {
                    student.recognized = known;
                }
            });
        }
    },
}
</script>
