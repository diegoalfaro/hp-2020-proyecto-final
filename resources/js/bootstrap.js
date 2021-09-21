const loadDependencies = () => {
  window._ = require('lodash');
  window.$ = window.jQuery = require('jquery');
  window.bootstrap = require('bootstrap');
  window.moment = require('moment');
  window.axios = require('axios');
  window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  window.download = require('downloadjs');
};

const loadTooltips = () => {
  $('[data-bs-toggle="tooltip"]').tooltip();
};

try {
  loadDependencies();

  $(function(){
    loadTooltips();

    $(document).on('DOMNodeInserted', function(e) {
      loadTooltips();
    });
  });
} catch (e) {
  console.error('Error al cargar las dependencias')
}