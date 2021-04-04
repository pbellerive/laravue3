const state = {
  user: undefined,
  token: undefined
};

const  mutations = {
  logout: function(state) {
    state.user = undefined;
    state.token = undefined;
  },
  setUser: function(state, user) {
    state.user = user;
  },
  setToken: function(state, token) {
    state.token = token;
    localStorage.token = token;
  }
};


const getters = {
  isAuthenticated: function (state) {
    return state.user && state.token;
  },
  currentUser: function(state) {
    return state.user;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations
}