/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import pagination from 'laravel-vue-pagination';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// globales
Vue.component('v-pagination', pagination);
Vue.component('v-modal', require('./components/Modal.vue').default);
// home filtros
Vue.component('v-home-filters', require('./components/home/HomeFilters').default);
// ventas
Vue.component('v-products-list-in-new-sale', require('./components/products/ListInNewSale.vue').default);
Vue.component('v-products--sales-carshop', require('./components/sales/CarShop.vue').default);
// compras
Vue.component('v-products-purchases-carshop', require('./components/purchases/CarShop.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
