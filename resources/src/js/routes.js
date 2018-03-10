import VueRouter from 'vue-router';
import Home from './views/home.vue';

export const routes = [
    {
        path: '/home',
        component: Home
    },

    {
        path: '/class/:id/:title',
        component: require('./views/class.vue')
    },
];
