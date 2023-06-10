import Vue from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { useSessionStore } from './store/modules/session';

import Dashboard from './components/dashboard/dashboard';
import Home from './components/home';
import Login from './components/authentication/login';
import Register from './components/authentication/register';
import ForgotPassword from './components/authentication/forgot-password';
import ResetPassword from './components/authentication/reset-password';
import Error404 from './components/error/404';
import ProfileEdit from './components/user/edit';
const UserList = () => import('./components/user/list');

var router = new createRouter({
  history: createWebHistory(),
  routes: [
    // { path: '/', component: Home, name: 'root' },
    { path: '/home', component: Home, name: 'Home', meta: { requiresAuth: true } },
    { path: '/', component: Dashboard, meta: { requiresAuth: true } },
    { path: '/login', component: Login, name: 'Login', meta: { requiresAuth: false } },
    { path: '/register', component: Register, name: 'Register', meta: { requiresAuth: false } },
    { path: '/forgot-password', component: ForgotPassword, name: 'Forgot-password', meta: { requiresAuth: false } },
    { path: '/reset-password', component: ResetPassword, name: 'Reset-password', meta: { requiresAuth: false } },
    { path: '/profile', component: ProfileEdit, meta: { requiresAuth: true } },
    { path: '/users', component: UserList, meta: { requiresAuth: true } },

    { path: '/:pathMatch(.*)*', component: Error404 },
  ],
});

router.beforeEach(async (to, from, next) => {
  const session = useSessionStore();
  if (!to.meta.requiresAuth) {
    next();
  } else {
    if (!session.isAuthenticated) {
      let response = await axios.get('check-auth');

      if (response.status === 200) {
        session.$patch({
          isAuthenticated: true,
          user: response.data,
        });

        if (to.name === 'Login') {
          next({ name: 'Home', replace: true });
        } else {
          next();
        }
      } else {
        next();
      }
    } else {
      next();
    }
  }
});

export default router;
