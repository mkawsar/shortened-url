import Vue from 'vue';
import App from './App.vue';

import router from './router';

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast, {
    position: 'top-right'
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});
window.app = app;
