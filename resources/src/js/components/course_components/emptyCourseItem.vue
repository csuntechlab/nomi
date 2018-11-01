<template>
<div v-if="displayCurrentTerm" class="row fullscreen-width">
    <div v-if="selectedTerm == 'previous'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
                <h5  class="panel__header course__header--empty mb-0">
                    You did not teach any classes for {{displayedTerm}}.
                </h5>
        <div class="panel__content course__content--empty">
            <div class="row">If you notice any errors in your class schedule, send <a :href="this.url + '/support'">feedback</a>.</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
    <div v-else-if="selectedTerm == 'current'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
            <h5 class="panel__header course__header--empty mb-0">
                You are not teaching any classes for {{displayedTerm}}.
            </h5>
        <div class="panel__content course__content--empty">
            <div class="row">If you notice any errors in your class schedule, send <a :href="this.url + '/support'">feedback</a>.</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
    <div v-else-if="selectedTerm == 'next'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
            <h5 class="panel__header course__header--empty mb-0">
                You are not scheduled to teach any classes for {{displayedTerm}}.
            </h5>
        <div class="panel__content course__content--empty">
            <div class="row">If you notice any errors in your class schedule, send 
                <a :href="this.url + '/support'">feedback</a> .</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';
import { displayCurrentTerm } from './../../mixins/displayCurrentTerm.js'


export default {
  name: 'empty-course-item',
  mixins: [displayCurrentTerm],
   
  computed: {
        ...mapGetters([
          'selectedTerm',
        ]),
  },
   created() {
    this.url = document.querySelector('meta[name=app-url]').content;
    },
};
</script>
