<template>
    <div>
        <card-toggle-button></card-toggle-button>
        <shuffle-button></shuffle-button>
        <div v-if="this.flash">
            <flash-card
                v-for="student in this.flashroster[this.courseid]"
                :key="student.student_id"
                :student="student"
                @markRecognized="markStudentAsRecognized"
            ></flash-card>
        </div>
        <div v-else>
            <gallery-card
                v-for="student in this.roster[this.courseid]"
                :key="student.student_id"
                :student="student"
            ></gallery-card>
        </div>
    </div>
</template>

<script>
import FlashCard from './flashCard';
import GalleryCard from "./galleryCard";
import shuffleButton from './shuffleButton.vue';
import cardToggleButton from './cardToggleButton.vue';
import { mapGetters } from 'vuex';
export default {
    name: "student-matrix",

    data: function () {
        return {
            messages: true,
            errors: [],
            lastname: true,
            descending: true
        }
    },

    props: ['courseid'],

    components: {
        FlashCard,
        GalleryCard,
        shuffleButton,
        cardToggleButton,
    },

    computed: {
        ...mapGetters([
            'roster',
            'flashroster',
            'flash'
        ]),
    },

    methods: {
        markStudentAsRecognized: function(payload) {
            this.flashroster[this.courseid].forEach((student) => {
                if(student.student_id === payload.student_id) {
                    student.recognized = payload.known;
                }
            });
        }
    },
}
</script>
