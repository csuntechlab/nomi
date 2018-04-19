import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

import base from './modules/base'
import game from './modules/game'

const store = new Vuex.Store({
    modules: {
        base,
        game
    }
});

export default store;