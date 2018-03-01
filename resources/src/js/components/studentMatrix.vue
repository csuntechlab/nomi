<template>
    <div v-if="show">
        <shuffle-button></shuffle-button>
        <card-toggle-button></card-toggle-button>
        <student-card v-for="student in students" :key="student.student_id" :student="student" :flash="flash"></student-card>
    </div>
</template>

<script>
import studentCard from './studentCard.vue';
import FlashCard from "./flashCard";
export default {
    name: "student-matrix",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('shuffleCards', function () {
            if (this.flash) {
                this.shuffleCardsHandler();
            }
        }.bind(this));

        this.$eventBus.$on('toggleCards', function () {
            this.toggleCardsHandler();
        }.bind(this));

        this.$eventBus.$on('toggleView', function () {
            this.toggleViewHandler();
        }.bind(this));

        this.$eventBus.$on('updateRecognized', function(id, known) {
            this.markStudentAsRecognized(id, known);
        }.bind(this));

    },

    mounted () {
        /** Transform prop into attribute */
        this.students = JSON.parse(this.studentsjson);
    },

    data: function () {
        return {
            students: [],
            show: true,
            flash: false,
            messages: true,
            errors: [],
        }
    },

    components: {
        FlashCard,
        studentCard
    },

    props: ['studentsjson'],

    methods: {
        shuffleCardsHandler: function () {
            let unKnownStudents = [];
            let knownStudents = [];

            this.students.forEach((student) => {
                if(student.recognized == true) {
                    knownStudents.push(student)
                } else {
                    unKnownStudents.push(student)
                }
            });

            let currentIndex = unKnownStudents.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = unKnownStudents[currentIndex];
                unKnownStudents[currentIndex] = unKnownStudents[randomIndex];
                unKnownStudents[randomIndex] = temporaryValue;
            }

            let currentIndexTwo = knownStudents.length, temporaryValueTwo, randomIndexTwo;

            // While there remain elements to shuffle...
            while (0 !== currentIndexTwo) {

                // Pick a remaining element...
                randomIndexTwo = Math.floor(Math.random() * currentIndexTwo);
                currentIndexTwo -= 1;

                // And swap it with the current element.
                temporaryValueTwo = knownStudents[currentIndexTwo];
                knownStudents[currentIndexTwo] = knownStudents[randomIndexTwo];
                knownStudents[randomIndexTwo] = temporaryValueTwo;
            }

            this.students = unKnownStudents.concat(knownStudents);

            //hack, solve later
            this.show = !this.show;
            this.show = !this.show;
		},

        toggleViewHandler: function () {
            this.show = !this.show;
        },

        toggleCardsHandler: function () {
            this.flash = !this.flash;
        },

        markStudentAsRecognized: function(id, known) {
            this.students.forEach((student) => {
                if(student.student_id == id) {
                    student.recognized = known;
                }
            });
        }
    },

}

</script>
