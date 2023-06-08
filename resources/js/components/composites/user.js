import router from '../../router';

const fetchCurrentUser = function () {
  if (router.currentRoute.name != 'register' && router.currentRoute.name != 'login') {
    return axios.get('user').then((response) => {
      // this.$store.commit('session/setUser', response.data);
      return response;
    });
  }
};

export { fetchCurrentUser };
