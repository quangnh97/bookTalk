<template>
  <div
    :class="{modal: true,show: isShowingModalDelete}"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-label w-100 font-weight-bold" v-if="model === 'category'">Xóa thể loại</h4>
          <button type="button" class="close" aria-label="Close" @click="hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <p v-if="model === 'category'">Bạn có chắc chắn muốn xóa thể loại này không?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="hide()">
                Hủy
            </button>
          <button
            type="button"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="deleteModel(id)"
          >
            Xóa
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import EventBus from "../../app";
const DELETE_CATEGORY = 'DELETE_CATEGORY';
export default {
    DELETE_CATEGORY: DELETE_CATEGORY,
  computed: {
    ...mapGetters('modals', ['isShowingModalDelete']),
    ...mapGetters('modals', ['id']),
    ...mapGetters('modals', ['model']),
  },
  methods: {
    ...mapActions({
      hide: 'modals/hideModalDelete',
    }),

     deleteModel(id) {
      if (this.model === 'category'){
          axios.delete('/categories/' + id)
              .then(response => {
                  if(response.data.success){
                      console.log(response.data.success);
                      EventBus.$emit(DELETE_CATEGORY, 'delete_category');
                      this.hide();
                  }
              })
              .catch(function (error) {
                  console.log(error);
              });
        // if (res.success) {
        //   EventBus.$emit(DELETE_REPORT, 'delete_report');
        //   this.hide();
        // }
      }

      // if (this.model === 'note'){
      //   const res = await this.deleteNoteAPI(id);
      //   if (res.success) {
      //     EventBus.$emit(DELETE_NOTE, 'delete_note');
      //     this.hide();
      //   }
      // }
    },
  },
};
</script>

<style lang="scss" scoped>
    .label {
        font-size: inherit;
        line-height: inherit;
        border: 1px solid black;
        padding: 0px 5px;
    }

    .modal-body {
        margin-bottom: 30px;
    }

</style>
