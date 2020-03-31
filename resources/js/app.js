require('./bootstrap');
window.Vue = require('vue');

Vue.component('data-component', require('./components/DataComponents.vue').default);

const app = new Vue({
    el: '#app',
});
