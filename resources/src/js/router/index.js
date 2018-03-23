import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../views/home';
import Class from '../views/class';
import Profile from '../views/profile';

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
           path: '/profile/',
           component: Profile
       }
   ],
});

export default router;