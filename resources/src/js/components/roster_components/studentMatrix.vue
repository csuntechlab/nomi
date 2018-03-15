<template>
    <div>
        <shuffle-button :courseid="this.courseid"></shuffle-button>
        <card-toggle-button></card-toggle-button>
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
        markStudentAsRecognized: function(payload) {
            this.flashroster[this.courseid].forEach((student) => {
                if(student.student_id === payload.student_id) {
                    student.recognized = payload.known;
                }
            });
        },

        sortRoster: function () {
            function sortedRoster (self) {
                if (self.lastname === true) {
                    if(self.descending === true) {
                        return self.roster.sort((a, b) => {
                            return a.last_name.localeCompare(b.last_name);
                        });
                    } else {
                        return self.roster.sort((a, b) => {
                            return a.last_name.localeCompare(b.last_name);
                        }).reverse();
                    }
                } else {
                    if(self.descending === true) {
                        return self.roster.sort((a, b) => {
                            return a.first_name.localeCompare(b.first_name);
                        });
                    } else {
                        return self.roster.sort((a, b) => {
                            return a.first_name.localeCompare(b.first_name);
                        }).reverse();
                    }
                }
            }

            this.roster = sortedRoster(this);
        },

        toggleNameHandler: function () {
            this.lastname = !this.lastname;
            this.sortRoster();
        },

        toggleDescHandler: function () {
            this.descending = !this.descending;
            this.sortRoster();
        }
    },
}
</script>
