<template>
  <div
    :class="{modal: true,show: isShowingModalDelete}"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-label w-100 font-weight-bold">{{ $t('report.report.delete') }}</h4>
          <button type="button" class="close" aria-label="Close" @click="hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <p>{{ $t('setting.status.modalDelete.content') }}</p>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="deleteModel(id)"
          >
            {{ $t('setting.status.modalDelete.delete') }}
          </button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="hide()">
            {{ $t('setting.status.modalDelete.cancel') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
const DELETE_REPORT = 'DELETE_REPORT';
const DELETE_NOTE = 'DELETE_NOTE';
const DELETE_LABEL = 'DELETE_LABEL';
const DELETE_STATUS = 'DELETE_STATUS';
export default {
  DELETE_REPORT: DELETE_REPORT,
  DELETE_NOTE: DELETE_NOTE,
  DELETE_LABEL: DELETE_LABEL,
  DELETE_STATUS: DELETE_STATUS,
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
      if (this.model === 'report'){
        // const res = await this.deleteReportAPI(id);
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
