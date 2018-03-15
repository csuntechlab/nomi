<template>
    <div v-if="show">
        <shuffle-button></shuffle-button>
        <card-toggle-button></card-toggle-button>

        <div v-if="flash">
            <student-card v-for="student in this.students" :key="student.last_name" :student="student" :flash="flash"></student-card>
        </div>

        <div v-else>
            <student-card v-for="student in this.roster" :key="student.last_name" :student="student" :flash="flash"></student-card>
        </div>
    </div>
</template>

<script>
import studentCard from './studentCard.vue';
import FlashCard from './flashCard';
export default {
    name: "student-matrix",

    created () {
        /** Create event listeners */
        this.$eventBus.$on('shuffleCards', function () {
            if (this.flash)
                this.shuffleCardsHandler();
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

        this.$eventBus.$on('toggleName', function () {
            this.toggleNameHandler();
        }.bind(this));

        this.$eventBus.$on('toggleDesc', function () {
            this.toggleDescHandler();
        }.bind(this));
    },

    props: ['roster', 'students'],

    data: function () {
        return {
            show: false,
            flash: false,
            messages: true,
            errors: [],
            lastname: true,
            descending: true
        }
    },

    components: {
        FlashCard,
        studentCard
    },

    methods: {
        shuffleCardsHandler: function () {
            let unKnownStudents = [];
            let knownStudents = [];

            this.students.forEach((student) => {
                if(student.recognized === true) {
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
                if(student.student_id === id) {
                    student.recognized = known;
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
