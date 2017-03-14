/* eslint-disable no-new */

import Vue from 'vue'
import axios from 'axios'
// import filters from './filters'
import isLoading from './directives/isLoading'
import notifyClose from './directives/notifyClose'
import scrollTo from './directives/scrollTo'
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

Vue.directive('isLoading', isLoading)
Vue.directive('notifyClose', notifyClose)
Vue.directive('scrollTo', scrollTo)
Vue.component('datepicker', datepicker)
Vue.component('confirm', confirm)

new Vue({
    el: '#app'
})
