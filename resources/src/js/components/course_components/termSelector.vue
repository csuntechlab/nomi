<template>
    <div class="row">
        <label for="semester-select"></label>
        <div v-if="!formValidated" id="error_year_bar" class="alert alert--warning">
            <strong>Oops!</strong> Please enter a valid year
        </div>
            <div class="col-xs-5">
                <select class="course__field" name="semester-select" id="sem-select" @input="handleSelect">
                    <option value="0" selected>Spring</option>
                    <option value="1">Summer</option>
                    <option value="2">Fall</option>
                    <option value="3">Winter</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input class="course__field" id="inputYear" type="text" v-model.lazy="year" placeholder="Year" @keyup.enter="validateYear">
            </div>
            <button id="submitTerm" class="btn btn-sm btn-default col-xs-3" @click="validateYear">Submit</button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'term-selector',

  data() {
    return {
      season: 3,
      year: null,
      formValidated: true,
    };
  },

  computed: {
    ...mapGetters([
      'semester',
    ]),
  },

  created() {
    this.$store.dispatch('doneLoadingClasses');
  },

  methods: {
    handleSubmit() {
      if (this.formValidated) {
        this.$store.dispatch('loadingClassesTrue');

        switch (this.season) {
          case '0':
            this.$store.dispatch('setSpring');
            break;
          case '1':
            this.$store.dispatch('setSummer');
            break;
          case '2':
            this.$store.dispatch('setFall');
            break;
          case '3':
            this.$store.dispatch('setWinter');
            break;
        }
        this.$store.dispatch('setTermYear', this.year);
        this.$store.dispatch('getOnlyData');
      }
    },

    handleSelect(input) {
      this.season = input.target.value;
    },

    validateYear() {
      const inputYear = document.getElementById('inputYear').value;
      const yearRegex = /^(20|19)\d\d/;
      this.formValidated = yearRegex.test(inputYear);
      this.handleSubmit();
    },
  },
};
</script>
