import { defineStore } from 'pinia';

export const useMainStore = defineStore('main', {
  state: () => ({
    isLoading: false,
    locale: 'fr',
  }),
  actions: {
    startLoading() {
      this.isLoading = true;
    },
    stopLoading() {
      this.isLoading = false;
    },
  },
  getters: {
    isLoading: function () {
      return this.isLoading;
    },
    locale: function () {
      return this.locale;
    },
  },
});
