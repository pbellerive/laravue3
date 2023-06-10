var Vue = require('vue').default;
import router from './router';

import Notification from './components/ui/notification';
import SideMenu from './components/ui/side-menu';
import PageHeader from './components/page-header.vue';

import i18n from './translations/i18n';
import mitt from 'mitt';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import iconLoader from './font-awesome';

iconLoader();

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

import { useSessionStore } from './store/modules/session';

let exceptRoutesName = ['Login', 'Register', 'root', 'Forgot-password'];
axios.interceptors.response.use(
  function (response) {
    return response;
  },
  function (error) {
    let except =
      exceptRoutesName.findIndex((element) => {
        return element == router.currentRoute.value.name;
      }) == -1;

    if (error.response.status === 401 && except) {
      const store = useSessionStore();
      store.logout();
      router.push('/login');
    }
    return Promise.reject(error);
  }
);
//global components

import VueUi from 'laravue-ui-components/src';
import VueUiSettings from './vueTailwindBootStrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

const pinia = createPinia();

const app = createApp({
  el: '#app',
})
  .use(router)
  .use(i18n)
  .use(pinia)
  // .mixin(mixin)
  .use(VueUi, VueUiSettings);

const emitter = mitt();
app.provide('emitter', emitter);

app.component('notification', Notification);
app.component('page-header', PageHeader);
app.component('side-menu', SideMenu);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
  broadcaster: 'pusher',
  wsHost: window.location.hostname,
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  forceTLS: false,
  wsPort: 6001,
  disableStats: true,
});
