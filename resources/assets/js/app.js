/* eslint-disable no-new */

import Vue from 'vue'
import axios from 'axios'
// import filters from './filters'
import scrollTo from './directives/scrollTo'
import isLoading from './directives/isLoading'
import datepicker from './components/datepicker'
import confirm from './components/confirm'

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}

Object.defineProperties(Vue.prototype, {
    $bus: {
        get () {
            return new Vue()
        }
    },
    // $filters: {
        // get () {
            // return filters
        // }
    // },
    $http: {
        get () {
            return axios
        }
    }
})

Vue.directive('scrollTo', scrollTo)
Vue.directive('isLoading', isLoading)
Vue.component('datepicker', datepicker)
Vue.component('confirm', confirm)

new Vue({
    el: '#app'
})
