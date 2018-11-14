<template>
    <div v-if="this.$store.state.base.themeName.theme === this.$parent.$el.className">
        <nav-bar></nav-bar>
        <courses-container></courses-container>
        <menu-bar></menu-bar>
    </div>
    <div v-else>
        <div class="post-login type--center">
            <div class="post-login-container">
                <img class="nomi-logo nomi-logo--loading" src="/images/apple-touch-icon.png" alt="NOMI Logo; Names of Matador Individuals">
            </div>
        </div>
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
        this.$store.dispatch('clearFaculty');
        this.$store.dispatch('getOnlyData');
    },
};
</script>
