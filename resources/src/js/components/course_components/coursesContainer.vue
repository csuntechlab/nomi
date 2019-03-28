<template>
    <div>
        <div class="row course__banner">
            <div class="col-xs-12 type--center">
                <h1 class="course__descriptor">Selected Term</h1>
            </div>
            <div class="col-xs-4 type--right">
                <button data-interactable @click="setPreviousTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'previous' ? 'course__button--selected' : '', this.shouldLoadClasses ? 'no-click': '']">Previous</button>
            </div>
            <div class="col-xs-4 type--center">
                <button data-interactable @click="setCurrentTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'current' ? 'course__button--selected' : '', this.shouldLoadClasses ? 'no-click': '' ]">Current</button>
            </div>
            <div class="col-xs-4 type--left">
                <button data-interactable @click="setNextTerm" class="btn btn-sm course__button" v-bind:class="[ this.selectedTerm == 'next' ? 'course__button--selected' : '', this.shouldLoadClasses ? 'no-click': '' ]">Next</button>
            </div>
        </div>
        <div v-if="this.shouldLoadClasses" class="type--center">
            <br>
            <i class="fa fa-spinner fa-spin fa-3x icon__theme"></i>
        </div>
        <template v-else>
            <course-list></course-list>
        </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';
import courseList from './courseList';

    export default {
      name: 'courses-container',

      components: {
        courseList,
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
      },

      methods: {
        ...mapActions([
          'setPreviousTerm',
          'setCurrentTerm',
          'setNextTerm',
        ]),

        setPreviousTerm() {
          this.$store.dispatch('nullifyCourse');
          this.$store.dispatch('clearCourses');
          this.$store.dispatch('clearRoster');
          this.$store.dispatch('loadingClassesTrue');
          this.$store.dispatch('setTerm', {term: 'previous'});
          this.$store.dispatch('getOnlyCourses');
          if (this.selectedTerm != 'previous') {
            this.setPreviousTerm();
          }
        },

        setCurrentTerm() {
          this.$store.dispatch('nullifyCourse');
          this.$store.dispatch('clearCourses');
          this.$store.dispatch('clearRoster');
          this.$store.dispatch('loadingClassesTrue');
          this.$store.dispatch('setTerm', {term: 'current'});
          this.$store.dispatch('getOnlyCourses');
          if (this.selectedTerm != 'current') {
            this.setCurrentTerm();
          }
        },

        setNextTerm() {
          this.$store.dispatch('nullifyCourse');
          this.$store.dispatch('clearCourses');
          this.$store.dispatch('clearRoster');
          this.$store.dispatch('loadingClassesTrue');
          this.$store.dispatch('setTerm', {term: 'next'});
          this.$store.dispatch('getOnlyCourses');
          if (this.selectedTerm != 'next') {
            this.setNextTerm();
          }
        },
      },
    };
</script>