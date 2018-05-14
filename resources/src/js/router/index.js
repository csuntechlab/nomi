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
           path: '/class/:id',
           component: Class
       },
       {
           path: '/profile/:courseID/:emailURI',
           component: Profile,
           props: true
       }
   ],
});

export default router;