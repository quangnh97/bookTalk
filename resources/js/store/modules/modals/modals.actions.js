export const actions = {
  showModalCreateCategory({ commit }) {
    commit('SHOW_MODAL_CREATE_CATEGORY');
  },
  hideModalCreateCategory({ commit }) {
    commit('HIDE_MODAL_CREATE_CATEGORY');
  },
    showModalEditCategory({ commit }) {
        commit('SHOW_MODAL_EDIT_CATEGORY');
    },
    hideModalEditCategory({ commit }) {
        commit('HIDE_MODAL_EDIT_CATEGORY');
    },

    showModalDelete({ commit }) {
        commit('SHOW_MODAL_DELETE');
    },
    hideModalEditDelete({ commit }) {
        commit('HIDE_MODAL_DELETE');
    },
};
