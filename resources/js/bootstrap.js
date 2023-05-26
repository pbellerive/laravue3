var Vue = require('vue').default;
import router from './router';

import Notification from './components/ui/notification';
import i18n from './translations/i18n';
import mitt from 'mitt';

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = '/api';
axios.defaults.withCredentials = true;

// axios.interceptors.request.use(function (config) {
//   let token = '';
//   if (localStorage.token) {
//     // let tokenObject = JSON.parse();
//     token = localStorage.token ? localStorage.token : undefined;
//   }
//   config.headers.Authorization = 'Bearer ' + token;

//   //set xsrf token a revoir avec laravel pour ne pas avoir de session.
//   // config.headers['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content')
//   return config;
// }, function (error) {
//   // Do something with request error
//   return Promise.reject(error);
// });

import { useSessionStore } from './store/modules/session';

let exceptRoutesName = ['login', 'register', 'home', 'root'];
axios.interceptors.response.use(
  function (response) {
    return response;
  },
  function (error) {
    let except =
      exceptRoutesName.findIndex((element) => {
        return element == router.currentRoute.name;
      }) == -1;

    if (error.response.status === 401 && except) {
      const store = useSessionStore();
      store.logout();
      router.push('/');
    }
    return Promise.reject(error);
  }
);
//global components

import PageHeader from './components/page-header.vue';
import VueUi from 'laravue-ui-components/src';
import VueUiSettings from './vueTailwindBootStrap';

// Vue.mixin({
//   computed: {
//     ...mapGetters('session', [
//       'currentUser', // -> this['some/nested/module/someGetter']
//     ])
//   },
//   data() {
//     return {
//       showAlert : false
//     }
//   },
//   methods: {
//     $notification() {
//       return this.$root.$refs.$notification;
//     },
//     setLocale(locale) {
//       this.$i18n.locale = locale;
//     },
//     toggleAlert() {
//         this.showAlert = true;
//     },
//     fetchCurrentUser() {
//       if ((this.$router.currentRoute.name != 'register' && this.$router.currentRoute.name != 'login') && localStorage.token) {
//         return axios.get('user')
//           .then(response => {
//             this.$store.commit('session/setUser', response.data);
//             return response;
//           })
//       }
//     }

//   },
// });

import { createApp } from 'vue';
import { createPinia } from 'pinia';

const pinia = createPinia();

const app = createApp({
  el: '#app',
  components: {
    'page-header': PageHeader,
    notification: Notification,
    // loading: Loading,
  },
})
  .use(router)
  .use(i18n)
  .use(pinia)
  // .mixin(mixin)
  .use(VueUi, VueUiSettings);

const emitter = mitt();
app.provide('emitter', emitter);

app.mount('#app');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
