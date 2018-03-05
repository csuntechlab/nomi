import VueRouter from 'vue-router';

let routes = [
    {
        path: 'home',
        component: require('./views/home.vue')
    },

    {
        path: 'class/:id/:title',
        component: require('./views/class.vue')
    },
];

export default new VueRouter({
    mode: 'history',
    routes
});
