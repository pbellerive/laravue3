import { defineStore } from 'pinia';
export const useSessionStore = defineStore('session', {
  state: () => ({
    user: undefined,
    token: undefined,
  }),
  actions: {
    logout: function () {
      this.user = undefined;
      this.token = undefined;
    },
    setUser: function (user) {
      this.user = user;
    },
    setToken: function (token) {
      this.token = token;
      localStorage.token = token;
    },
  },
  getters: {
    isAuthenticated: function () {
      return this.user;
    },
    currentUser: function () {
      return this.user;
    },
  },
});
