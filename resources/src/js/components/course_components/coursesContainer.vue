<template>
    <div>
        <div v-if="this.shouldLoadClasses" class="type--center">
            <div class="row course__banner">
                <div class="col-xs-12 type--center">
                    <h1 class="course__descriptor">Selected Term</h1>
                </div>
                <div class="col-xs-4 type--right">
                    <button data-interactable @click="setPrevTerm" class="btn btn-sm course__button no-click" v-bind:class="[ this.selectedTerm == 'previous' ? 'course__button--selected' : '' ]">Previous</button>
                </div>
                <div class="col-xs-4 type--center">
                    <button data-interactable @click="setCurrTerm" class="btn btn-sm course__button no-click" v-bind:class="[ this.selectedTerm == 'current' ? 'course__button--selected' : '' ]">Current</button>
                </div>
                <div class="col-xs-4 type--left">
                    <button data-interactable @click="setNeTerm" class="btn btn-sm course__button no-click" v-bind:class="[ this.selectedTerm == 'next' ? 'course__button--selected' : '' ]">Next</button>
                </div>
            </div>
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
        <div v-else>
            <div class="row course__banner">
                <div class="col-xs-12 type--center">
                    <h1 class="course__descriptor">Selected Term</h1>
                </div>
                <div class="col-xs-4 type--right">
                    <button data-interactable @click="setPrevTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'previous' ? 'course__button--selected' : '' ]">Previous</button>
                </div>
                <div class="col-xs-4 type--center">
                    <button data-interactable @click="setCurrTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'current' ? 'course__button--selected' : '' ]">Current</button>
                </div>
                <div class="col-xs-4 type--left">
                    <button data-interactable @click="setNeTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'next' ? 'course__button--selected' : '' ]">Next</button>
                </div>
            </div>
            <course-list></course-list>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';
import courseList from './courseList';

    export default {
      name: 'courses-container',

      data() {
        return {
            displayedTerm: '',
        };
      },

      components: {
        courseList,
      },

      // On page load, sets 'Spring' as default season option
      created() {
        this.$store.dispatch('setSpring');
      },

      computed: {
        ...mapGetters([
          'list',
          'courses',
          'facultyMember',
          'facultyFullName',
          'term',
          'selectedTerm',
          'loadingClasses',
        ]),

        shouldLoadClasses() {
          if (this.loadingClasses) return true;
          return false;
        },

        displayCurrentTerm() {
          if (this.term != null) {
            const termCode = this.term;
            switch (termCode.charAt(3)) {
              case '3':
                this.displayedTerm = 'Spring';
                break;
              case '5':
                this.displayedTerm = 'Summer';
                break;
              case '7':
                this.displayedTerm = 'Fall';
                break;
              case '9':
                this.displayedTerm = 'Winter';
            }
            if (termCode.charAt(0) == '2') {
              this.displayedTerm
                        += ` ${termCode.charAt(0)}0${termCode.substring(1, 3)}`;
            } else {
              this.displayedTerm
                        += ` ${termCode.charAt(0)}9${termCode.substring(1, 3)}`;
            }
            return this.displayedTerm;
          }
        },
      },

      methods: {
        ...mapActions([
          'setPreviousTerm',
          'setCurrentTerm',
          'setNextTerm',
        ]),

        setPrevTerm() {
          this.$store.dispatch('nullifyCourse');
          if (this.selectedTerm != 'previous') {
            this.setPreviousTerm();
          }
        },

        setCurrTerm() {
          this.$store.dispatch('nullifyCourse');
          if (this.selectedTerm != 'current') {
            this.setCurrentTerm();
          }
        },

        setNeTerm() {
          this.$store.dispatch('nullifyCourse');
          if (this.selectedTerm != 'next') {
            this.setNextTerm();
          }
        },
      },
    };
</script>