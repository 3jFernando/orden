require('./bootstrap');

import pagination from 'laravel-vue-pagination';

window.Vue = require('vue');

// globales
Vue.component('v-pagination', pagination);
Vue.component('v-modal', require('./components/Modal.vue').default);
Vue.component('v-loading', require('./components/Loading.vue').default);
// home filtros
Vue.component('v-home-filters', require('./components/home/HomeFilters').default);
// productos
Vue.component('v-products-list-in-new-sale', require('./components/products/ListInNewSale.vue').default);
Vue.component('v-products-edit-menu', require('./components/products/EditMenu.vue').default);
// ventas
Vue.component('v-products--sales-carshop', require('./components/sales/CarShop.vue').default);
Vue.component('v-sales-list', require('./components/sales/List.vue').default);
// compras
Vue.component('v-products-purchases-carshop', require('./components/purchases/CarShop.vue').default);
Vue.component('v-purchases-list', require('./components/purchases/List.vue').default);

const app = new Vue({
    el: '#app',
});
