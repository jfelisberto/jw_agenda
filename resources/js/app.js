require('./bootstrap');
//require('./bootstrap-vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import './axios';

Vue.component('schedule-component', require('./components/ScheduleComponent.vue').default);

Vue.use(VueRouter);
const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    router
});
