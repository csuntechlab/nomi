<template>
    <div>
        <div v-if="this.flash" class="row container panel__listing">
            <flash-card
                v-for="student in this.flashroster[this.courseid]"
                :key="student.student_id"
                :student="student"
                @markRecognized="markStudentAsRecognized"
            ></flash-card>
        </div>
        <div v-else class="row container panel__listing gallery__layout">
            <gallery-card
                v-for="student in this.courses[this.courseid].roster"
                :key="student.student_id"
                :student="student"
            ></gallery-card>
            <modal></modal>
        </div>
    </div>
</template>

<script>
import FlashCard from './flashCard';
import GalleryCard from "./galleryCard";
import modal from "../fixed_components/modal.vue";
import { mapGetters } from 'vuex';
export default {
    name: "student-matrix",

    data: function () {
        return {
            messages: true,
            errors: [],
            sortLastName: true,
            sortDescending: true
        }
    },

    props: ['courseid'],

    components: {
        FlashCard,
        GalleryCard,
        modal
    },

    computed: {
        ...mapGetters([
            'courses',
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
