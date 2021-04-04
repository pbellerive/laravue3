import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/dashboard/dashboard';
import Home from './components/home';
import Login from './components/authentification/login';
import Register from './components/authentification/register';
import Error404 from './components/error/404';
import Vimeo from './components/vimeo/test'
import ProfileEdit from './components/user/edit'

Vue.use(VueRouter);

var router  = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/vimeo', component: Vimeo },
    { path: '/', component: Home, name: 'root' },
    { path: '/home', component: Home, name: 'home' },
    { path: '/dashboard', component: Dashboard },
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/profile', component: ProfileEdit },

    { path: '*', component: Error404},
  ]
});

export default router;