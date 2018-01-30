
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require(axios);

window.Vue = require('vue');
import VueRouter from 'vue-router'
// import App from './App.vue';
import Splash from './views/Splash.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes : [
        {
            path: '/splash',
            name: 'splash',
            component: Splash

        }
    ]
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));


var app = new Vue({
    el: '#app',
    components: {Splash},
    router,
  
   
});
 