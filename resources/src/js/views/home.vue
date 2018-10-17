<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <courses-container></courses-container>
        <menu-bar></menu-bar>
    </div>
    <div v-else>
        <h1>Not Loaded Yet</h1>
    </div>
</template>

<script>
import navBar from '../components/fixed_components/navBar.vue';
import menuBar from '../components/fixed_components/menuBar.vue';
import termSelector from '../components/course_components/termSelector.vue';
import coursesContainer from '../components/course_components/coursesContainer.vue';

export default {
    name: 'home',

    components: {
        termSelector,
        coursesContainer,
        menuBar,
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
