<template>
<div class="row fullscreen-width">
    <div v-if="selectedTerm == 'previous'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
                <h5 class="panel__header course__header--empty mb-0">
                    You have not taught any classes this past semester.
                </h5>
        <div class="panel__content course__content--empty">
            <div class="row">Feel free to review your current and next classes by selecting a different term.</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
    <div v-else-if="selectedTerm == 'current'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
            <h5 class="panel__header course__header--empty mb-0">
                You are not teaching any classes this current semester.
            </h5>
        <div class="panel__content course__content--empty">
            <div class="row">Feel free to review your past and next classes by selecting a different term.</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
    <div v-else-if="selectedTerm == 'next'">
        <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
            <h5 class="panel__header course__header--empty mb-0">
                You are not teaching any classes next semester.
            </h5>
        <div class="panel__content course__content--empty">
            <div class="row">Feel free to review your past and current classes by selecting a different term.</div>
            <br>
            <div class="row">Enjoy our App!</div>
        </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'empty-course-item',
  computed: {
        ...mapGetters([
          'selectedTerm',
        ]),
  }
};
</script>
