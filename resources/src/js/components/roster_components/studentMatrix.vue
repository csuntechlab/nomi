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
                v-for="student in this.students[this.courseid]"
                :key="student.student_id"
                :student="student"
            ></gallery-card>
            <modal></modal>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import FlashCard from './flashCard';
import GalleryCard from "./galleryCard";
import modal from "../fixed_components/modal.vue";


export default {
  name: 'student-matrix',

  data() {
    return {
      messages: true,
      errors: [],
      sortLastName: true,
      sortDescending: true,
    };
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
      'students',
      'flashroster',
      'flash',
      'modalVisible'
    ]),
  },
  methods: {
    markStudentAsRecognized(payload) {
      this.flashroster[this.courseid].forEach((student) => {
        if (student.student_id === payload.student_id) {
          student.recognized = payload.known;
        }
      });
    },
  },
};
</script>
