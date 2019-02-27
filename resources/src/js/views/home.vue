<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <courses-container></courses-container>
    </div>
    <div v-else>
        <loading-screen></loading-screen>
    </div>
</template>

<script>
import navBar from '../components/fixed_components/navBar.vue';
import menuBar from '../components/fixed_components/menuBar.vue';
import loadingScreen from '../components/fixed_components/loadingScreen.vue';
import termSelector from '../components/course_components/termSelector.vue';
import coursesContainer from '../components/course_components/coursesContainer.vue';

export default {
    name: 'home',

    components: {
        termSelector,
        coursesContainer,
        loadingScreen,
        menuBar,
        navBar,
    },

    created() {
        this.$store.dispatch('clearErrors');
    },

    beforeCreate() {
        this.$store.dispatch('getOnlyData');
    },

    updated() {
        Array.from(document.querySelectorAll("[data-interactable]")).map((x, index) => x.tabIndex = index + 1);
    },
};
</script>
