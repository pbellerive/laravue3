import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/dashboard/dashboard';
import Home from './components/home';
import Login from './components/authentification/login';
import Register from './components/authentification/register';
import ForgotPassword from './components/authentification/forgot-password';
import ResetPassword from './components/authentification/reset-password';
import Error404 from './components/error/404';
import ProfileEdit from './components/user/edit'

Vue.use(VueRouter);

var router  = new VueRouter({
  mode: 'history',
  routes: [
    // { path: '/', component: Home, name: 'root' },
    { path: '/home', component: Home, name: 'home' },
    { path: '/', component: Dashboard },
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/forgot-password', component: ForgotPassword, name: 'forgot-password' },
    { path: '/reset-password', component: ResetPassword, name: 'reset-password' },
    { path: '/profile', component: ProfileEdit },

    { path: '*', component: Error404},
  ]
});

export default router;