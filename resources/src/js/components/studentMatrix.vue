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
            this.shuffleCardsHandler();
        }.bind(this));

        this.$eventBus.$on('toggleCards', function () {
            this.toggleCardsHandler();
        }.bind(this));

        this.$eventBus.$on('toggleView', function () {
            this.toggleViewHandler();
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
            let currentIndex = this.students.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = this.students[currentIndex];
                this.students[currentIndex] = this.students[randomIndex];
                this.students[randomIndex] = temporaryValue;
            }

            //hack, solve later
            this.show = !this.show;
            this.show = !this.show;
		},

        toggleViewHandler: function () {
            this.show = !this.show;
        },

        toggleCardsHandler: function () {
            this.flash = !this.flash;
        }
    },

}

</script>
