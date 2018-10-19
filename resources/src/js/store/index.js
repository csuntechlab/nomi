import createPersistedState from 'vuex-persistedstate';
import Vue from 'vue';
import Vuex from 'vuex';
import profile from './modules/profile';
import base from './modules/base';

Vue.use(Vuex);

const store = new Vuex.Store({
  plugins: [createPersistedState({
    key: 'nameface',
  })],

  modules: {
    base,
    profile,
  },
});

export default store;
