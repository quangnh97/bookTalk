 
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
export const store =  new Vuex.Store({
    state: {
        countTotalUnreadCommon : 0
    },

    getters: {
      storedNumberMatches: state => matchNumber => state.countTotalUnreadCommon === matchNumber
    },
})
