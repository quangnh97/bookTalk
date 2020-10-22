export const actions = {
  showModalCreateCategory({ commit }) {
    commit('SHOW_MODAL_CREATE_CATEGORY');
  },
  hideModalCreateCategory({ commit }) {
    commit('HIDE_MODAL_CREATE_CATEGORY');
  },
    showModalCreateBook({ commit }) {
        commit('SHOW_MODAL_CREATE_BOOK');
    },
    hideModalCreateBook({ commit }) {
        commit('HIDE_MODAL_CREATE_BOOK');
    },
    showModalEditCategory({ commit }, payload) {
        commit('SHOW_MODAL_EDIT_CATEGORY', payload);
    },
    hideModalEditCategory({ commit }) {
        commit('HIDE_MODAL_EDIT_CATEGORY');
    },

    showModalDelete({ commit }, payload) {
        commit('SHOW_MODAL_DELETE', payload);
    },
    hideModalDelete({ commit }) {
        commit('HIDE_MODAL_DELETE');
    },


};
