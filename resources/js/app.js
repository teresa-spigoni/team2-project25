import Vue from 'vue';
window.Vue = Vue;
require('./bootstrap');
import axios from 'axios';
Vue.prototype.$http = axios;


Vue.component('index-component', require('./components/IndexComponent.vue').default);
// Vue.component('index', require('./components/ExampleComponent.vue').default)


const app = new Vue({
    el: '#app',
    methods: {
        historyBack(spec) {
            window.location.href = '/doctors?specialization=' + spec;
        },
    }
});

