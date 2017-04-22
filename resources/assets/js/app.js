/* eslint-disable no-new */

import Vue from 'vue'
import axios from 'axios'
import isLoading from './directives/isLoading'
import scrollTo from './directives/scrollTo'
import datepicker from './components/datepicker'
import payment from './components/payment'

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
    $http: {
        get () {
            return axios
        }
    }
})

Vue.directive('isLoading', isLoading)
Vue.directive('scrollTo', scrollTo)
Vue.component('datepicker', datepicker)
Vue.component('payment', payment)

new Vue({
    el: '#app',
    methods: {
        slugify (text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '')
        },
        titleToSlug (e, id) {
            let el = document.getElementById(id)

            el.value = this.slugify(e.target.value)
        }
    }
})
