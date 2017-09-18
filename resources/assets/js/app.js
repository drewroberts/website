
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router';
 Vue.use(VueRouter);
 import { routes } from './routes.js';
 const router = new VueRouter({ routes,
	mode: 'history' });

import Vuetify from 'vuetify';
 Vue.use(Vuetify);

import drewroberts from './components/DrewRoberts.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router,
    components: { drewroberts }
});
