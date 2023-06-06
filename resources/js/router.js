import Vue from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useSessionStore } from './store/modules/session';

import Dashboard from './components/dashboard/dashboard';
import Home from './components/home';
import Login from './components/authentification/login';
import Register from './components/authentification/register';
import ForgotPassword from './components/authentification/forgot-password';
import ResetPassword from './components/authentification/reset-password';
import Error404 from './components/error/404';
import ProfileEdit from './components/user/edit';
const UserList = () => import('./components/user/list');

var router = new createRouter({
  history: createWebHistory(),
  routes: [
    // { path: '/', component: Home, name: 'root' },
    { path: '/home', component: Home, name: 'Home' },
    { path: '/', component: Dashboard },
    { path: '/login', component: Login, name: 'Login' },
    { path: '/register', component: Register, name: 'Register' },
    { path: '/forgot-password', component: ForgotPassword, name: 'Forgot-password' },
    { path: '/reset-password', component: ResetPassword, name: 'Reset-password' },
    { path: '/profile', component: ProfileEdit },
    { path: '/users', component: UserList },

    { path: '/:pathMatch(.*)*', component: Error404 },
  ],
});

router.beforeEach(async (to, from, next) => {
  const session = useSessionStore();

  if (!session.isAuthenticated) {
    if (to.name === 'Login') {
      next();
    }
    let response;
    //BAD pas censé d'avoir le try
    response = await axios.get('check-auth');
    session.$patch({
      isAuthenticated: true,
      user: response.data,
    });

    if (response.status === 200) {
      if (to.name === 'Login') {
        next({ name: 'Home', replace: true });
      } else {
        next();
      }
    } else {
      console.log(response.status);
      next({ name: 'Login' });
    }
  } else {
    next();
  }
});

export default router;
