import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home';
import Class from '../views/class';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/class/:id/:title',
            component: Class
        },
        {
            path: '/something',
            template: "<p>something</p>"
        }
    ]
});

export default router;
