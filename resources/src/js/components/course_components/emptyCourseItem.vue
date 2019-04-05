<template>
<div class="row fullscreen-width panel__empty-course">
    <div class="panel col-lg-12 col-md-12 col-xs-12 type--center">
        <h5  class="panel__header course__header--empty mb-0">
            You do not teach any classes for {{term[selectedTerm].display_term}}.
        </h5>
        <div class="panel__content course__content--empty">
            <div class="row">If you notice any errors in your class schedule, please <a :href="this.url + '/support'">let us know</a>.</div>
                <br>
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
