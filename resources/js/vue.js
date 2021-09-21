import Vue from "vue";
import VueTabulator from "vue-tabulator";
import VueRouter from "vue-router";
import { Lang } from 'laravel-vue-lang';
import vSelect from "vue-select";
import routes from './routes'

Vue.use(Lang, {
	locale: 'es',
	fallback: 'es'
});
Vue.use(VueTabulator);
Vue.use(VueRouter);
Vue.component("v-select", vSelect);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const router = new VueRouter({ routes })
window.router = router

window.app = new Vue({
    el: '#app',
	router
});
