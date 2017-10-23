import Vue from 'vue'
import VueCookie from 'vue-cookie'

import App from './App.vue'
import router from './router'

Vue.use(VueCookie);

const app = new Vue({
    el: '#root',
    template: `<app></app>`,
    components: { App },
    router
});
