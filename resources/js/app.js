

import Vue from 'vue';
window.Vue = Vue;
require('./bootstrap');
import axios from 'axios';
Vue.prototype.$http = axios;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
});
