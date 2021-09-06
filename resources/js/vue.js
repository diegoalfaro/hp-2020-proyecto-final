import Vue from "vue";
import VueTabulator from "vue-tabulator";
import { Lang } from 'laravel-vue-lang';

Vue.use(Lang, {
	locale: 'es',
	fallback: 'es'
});

Vue.use(VueTabulator);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.app = new Vue({
    el: '#app',
});
