import VueRouter from 'vue-router';

export const routes = [
    {
        path: '/home',
        component: require('./views/home.vue')
    },

    {
        path: '/class/:id/:title',
        component: require('./views/class.vue')
    },
];
