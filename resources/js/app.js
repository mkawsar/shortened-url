import Vue from 'vue';
import App from './App.vue';

import router from './router';

// require('./bootstrap');

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
window.app = app;
