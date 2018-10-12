<template>
    <div>
        <nav-bar></nav-bar>
        <courses-container></courses-container>
    </div>
</template>

<script>
import navBar from '../components/fixed_components/navBar.vue';
import termSelector from '../components/course_components/termSelector.vue';
import coursesContainer from '../components/course_components/coursesContainer.vue';

export default {
    name: 'home',

    components: {
        termSelector,
        coursesContainer,
        navBar,
    },

    created() {
        this.$store.dispatch('clearErrors');
    },
    beforeCreate() {
        this.$store.dispatch('getOnlyData');
    },
};
</script>
