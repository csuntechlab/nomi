import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import base from './modules/base'
import faculty from './modules/faculty'
import game from './modules/game'
import profile from './modules/profile'

const store = new Vuex.Store({
    modules: {
        base,
        faculty,
        game,
        profile
    }
});

export default store;