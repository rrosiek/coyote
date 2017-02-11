/* eslint-disable no-new */

import Vue from 'vue'
import scrollTo from './directives/scrollTo'

// window.axios = require('axios');
// window.axios.defaults.headers.common = {
    // 'X-Requested-With': 'XMLHttpRequest'
// };

Vue.directive('scrollTo', scrollTo)
// Vue.component('example', require('./components/Example.vue'))

new Vue({
    el: '#app'
})
