<template>
<div class="row fullscreen-width panel__empty-course">
    <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
        <h5  class="panel__header course__header--empty mb-0">
            You are not currently teaching any classes for {{term[selectedTerm].display_term}}.
        </h5>
        <div class="panel__content course__content--empty">
            Enjoy our App!
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
            'term'
        ]),
    },

    created() {
        this.url = document.querySelector('meta[name=app-url]').content;
    },
};
</script>
