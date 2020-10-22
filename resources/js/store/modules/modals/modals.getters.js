export const getters = {
  isShowingModalCreateCategory: (state) => {
    return state.show_modal_create_category;
  },
    isShowingModalCreateBook: (state) => {
        return state.show_modal_create_book;
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
    category: (state) => {
        return state.show_modal_edit_category.category;
    },
    isShowingModalEditCategory: (state) => {
        return state.show_modal_edit_category.show;
    },
};
