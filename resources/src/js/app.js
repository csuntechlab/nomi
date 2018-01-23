
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
import App from './App.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    render: h => h(App),
    // data: {
    // 	farmAnimals:[
    // 		{ animal: 'Pig', image: 'https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwikiLuf5ezYAhUCx2MKHeMUD3kQjRwIBw&url=https%3A%2F%2Fwww.southernliving.com%2Fculture%2Fpets%2Fpig-names&psig=AOvVaw0KsoIn1eSvHMVOJrGs-IKA&ust=1516752426923777'},
    // 		{ animal: 'Chicken', image: 'https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjE4--w5ezYAhUC12MKHdRqDS8QjRwIBw&url=https%3A%2F%2Fwww.zmescience.com%2Fmedicine%2Fgenetic%2Fchicken-dino-legs-53211%2F&psig=AOvVaw11056maurbPvRngZlrOy5A&ust=1516752462737109'},
    // 		{ animal: 'Duck', image: 'https://www.google.com/imgres?imgurl=http%3A%2F%2Fwww.stanford.edu%2Fdept%2FCTL%2Fcgi-bin%2Facademicskillscoaching%2Fwp-content%2Fuploads%2F2012%2F07%2Fbaby-duck.jpg&imgrefurl=http%3A%2F%2Fweb.stanford.edu%2Fdept%2FCTL%2Fcgi-bin%2Facademicskillscoaching%2Fwhy-does-the-duck-stop-here%2F&docid=MianPFmD2ikXsM&tbnid=wAlwhckENgJOiM%3A&vet=10ahUKEwi57f-55ezYAhURz2MKHSg8B-AQMwiFAigHMAc..i&w=1024&h=768&bih=690&biw=891&q=duck&ved=0ahUKEwi57f-55ezYAhURz2MKHSg8B-AQMwiFAigHMAc&iact=mrc&uact=8'},
    // 		{ animal: 'Rooster', image: 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fmedia.gettyimages.com%2Fphotos%2Frooster-in-field-picture-id143415254&imgrefurl=https%3A%2F%2Fwww.gettyimages.com%2Fdetail%2Fphoto%2Frooster-in-field-royalty-free-image%2F143415254&docid=8WpjGiVIwaJ3mM&tbnid=wJbN2DAYtueKsM%3A&vet=10ahUKEwi2jcbD5ezYAhUP2WMKHU2JBzoQMwjEASgCMAI..i&w=1024&h=851&bih=690&biw=891&q=rooster&ved=0ahUKEwi2jcbD5ezYAhUP2WMKHU2JBzoQMwjEASgCMAI&iact=mrc&uact=8'},
    // 		{ animal: 'Cow', image: 'https://www.google.com/imgres?imgurl=https%3A%2F%2Fcdn.modernfarmer.com%2Fwp-content%2Fuploads%2F2014%2F09%2Fcowhero2.jpg&imgrefurl=https%3A%2F%2Fmodernfarmer.com%2F2014%2F09%2Fmeans-cow-cattle-based-idioms%2F&docid=C1pgYjXmoxr8xM&tbnid=sElWS5Dh5tyRPM%3A&vet=10ahUKEwii6uvL5ezYAhWGMGMKHS1yAe4QMwi3ASgGMAY..i&w=1200&h=742&bih=690&biw=891&q=cow&ved=0ahUKEwii6uvL5ezYAhWGMGMKHS1yAe4QMwi3ASgGMAY&iact=mrc&uact=8'},
    // 		{ animal: 'Goat', image: 'https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&ved=0ahUKEwjq2uLX5ezYAhVP3mMKHdvPCsQQjRwIBw&url=https%3A%2F%2Fwww.washingtonian.com%2F2017%2F06%2F30%2Fcongressional-cemetery-goat-yoga-department-of-health%2F&psig=AOvVaw3anYBZ3oaKRx7YTwqwMuHO&ust=1516752543939746'}
    // 		]
    // 	}
    
   
});
