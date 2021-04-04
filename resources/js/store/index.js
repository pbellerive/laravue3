import Vue from 'vue'
import Vuex from 'vuex'
import session from './modules/session'

Vue.use(Vuex)


export default new Vuex.Store({
  actions: {
  },
  getters: {
    isLoading: function (state) {
      return state.isLoading;
    },
    locale: function (state) {
      return state.locale
    }
  },
  state: {
    isLoading: false,
    locale: 'fr',
  },
  mutations: {
    startLoading(state) {
      state.isLoading = true;
    },
    stopLoading(state) {
      state.isLoading = false;
    }
  },
  modules: {
    session: session,
  }
})
