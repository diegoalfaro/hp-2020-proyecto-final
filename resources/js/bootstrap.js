try {
  window._ = require('lodash');
  window.$ = window.jQuery = require('jquery');
  window.bootstrap = require('bootstrap');
  window.feather = require('feather-icons');
  window.axios = require('axios');
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

  $(function(){
    feather.replace();
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
} catch (e) {
  console.error('Error al cargar las dependencias')
}