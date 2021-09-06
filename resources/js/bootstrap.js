const loadDependencies = () => {
  window._ = require('lodash');
  window.$ = window.jQuery = require('jquery');
  window.bootstrap = require('bootstrap');
  window.feather = require('feather-icons');
  window.moment = require('moment');
  window.axios = require('axios');
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
};

const loadIcons = () => {
  feather.replace();
};

const loadTooltips = () => {
  $('[data-bs-toggle="tooltip"]').tooltip();
};

try {
  loadDependencies();

  $(function(){
    loadIcons();
    loadTooltips();

    $(document).on('DOMNodeInserted', function(e) {
      loadIcons();
      loadTooltips();
    });
  });
} catch (e) {
  console.error('Error al cargar las dependencias')
}