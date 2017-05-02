/* eslint-disable no-new */

import Vue from 'vue'
import axios from 'axios'
import clipboard from './directives/clipboard'
import isLoading from './directives/isLoading'
import notifyClose from './directives/notifyClose'
import scrollTo from './directives/scrollTo'
import datepicker from './components/datepicker'
import memberMap from './components/memberMap'
import payment from './components/payment'
import profileDetails from './components/profileDetails'

const eventBus = new Vue()

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}

Object.defineProperties(Vue.prototype, {
    $bus: {
        get () {
            return eventBus
        }
    },
    $http: {
        get () {
            return axios
        }
    }
})

Vue.directive('clipboard', clipboard)
Vue.directive('isLoading', isLoading)
Vue.directive('notifyClose', notifyClose)
Vue.directive('scrollTo', scrollTo)
Vue.component('datepicker', datepicker)
Vue.component('memberMap', memberMap)
Vue.component('payment', payment)
Vue.component('profileDetails', profileDetails)

new Vue({
    data: {
        mobileNav: false,
        showModal: false
    },
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
