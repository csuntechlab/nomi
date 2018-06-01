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
            name: 'home',
            path: '/',
            component: Home
        },
        {
            path: '/class/:id',
            component: Class
        },
        {
            name: 'profile',
            path: '/profile/:courseID/:emailURI',
            component: Profile,
            props: true,
        },
        {
            name: 'about',
            path: '/about',
            component: About
        }
    ],

    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
});

export default router;