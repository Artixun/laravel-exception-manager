import Vue from 'vue';
import Base from './base';
import axios from 'axios';
import Routes from './routes';
import VueRouter from 'vue-router';

require('bootstrap');

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

Vue.use(VueRouter);

window.Popper = require('popper.js').default;

const router = new VueRouter({
    routes: Routes,
    mode: 'history',
    base: '/' + window.LaravelExceptionManager.path + '/',
});

Vue.mixin(Base);

new Vue({
    el: '#exception',

    router,

    data(){
        return {
            autoLoadsNewEntries: localStorage.autoLoadsNewEntries === '1'
        }
    },

    methods: {
        autoLoadNewEntries(){
            if (!this.autoLoadsNewEntries) {
                this.autoLoadsNewEntries = true;
                localStorage.autoLoadsNewEntries = 1;
            } else {
                this.autoLoadsNewEntries = false;
                localStorage.autoLoadsNewEntries = 0;
            }
        }
    }
});
