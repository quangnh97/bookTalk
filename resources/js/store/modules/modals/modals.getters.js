export const getters = {
  isShowingModalCreateCategory: (state) => {
    return state.show_modal_create_category;
  },
    isShowingModalDelete: (state) => {
        return state.show_modal_delete;
    },
    id: (state) => {
        return state.id;
    },
    model: (state) => {
        return state.model;
    },
};
