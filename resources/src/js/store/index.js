import base from './modules/base'
import profile from './modules/profile'
import createPersistedState from 'vuex-persistedstate';
import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const store = new Vuex.Store({
    plugins: [createPersistedState({
        key: 'nameface'
    })],

    modules: {
        base,
        game,
        profile
    }
});

export default store;
