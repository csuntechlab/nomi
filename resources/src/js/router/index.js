import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home';
import Class from '../views/class';
import Profile from '../views/profile';
import About from '../views/about';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/class/:id',
            component: Class
        },
        {
            path: '/profile/:courseID/:emailURI',
            component: Profile,
            props: true
        },
        {
            path: '/about',
            component: About
        }
    ],

    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
});

export default router;