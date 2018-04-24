import base from './modules/base'
import faculty from './modules/faculty'
import game from './modules/game'
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
        faculty,
        game,
        profile
    }
});

export default store;