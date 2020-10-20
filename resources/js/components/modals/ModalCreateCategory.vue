<template>
  <div
    :class="{modal: true,show: isShowingModalCreateCategory}"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-label w-100 font-weight-bold">Tạo thể loại mới</h4>
          <button type="button" class="close" aria-label="Close" @click="hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form" style="margin-top: 10px;">
            <input v-model="title" placeholder="Ten the loai" class="name" style="width: 100%">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary seeMore" aria-label="Close" aria-hidden="true" @click="createCategory()">Done</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import EventBus from '../../app';
const CREATE_NOTE = 'CREATE_NOTE';
export default {
  CREATE_NOTE: CREATE_NOTE,
  data() {
    return {
      title: '',
      content: '',
      errors: {
        title: '',
        content: '',
      },
    };
  },
  computed: {
    ...mapGetters('modals', ['isShowingModalCreateCategory']),
  },
  watch: {
    isShowingModalCreateNote: function(newVal, oldVal) {
      if (!oldVal && newVal) {
        this.errors = {
          title: '',
          content: '',
        };
      }
    },
  },
  methods: {
    ...mapActions({
      hide: 'modals/hideModalCreateCategory',
    }),
      createCategory() {
      let hasErrors = false;

      // if (!hasErrors) {
      //   const res =  this.createNoteAPI(this.userId, this.title, this.content);
      //   if (res.success) {
      //     EventBus.$emit(CREATE_NOTE, 'create_note');
      //     this.hide();
      //     this.title = '';
      //     this.content = '';
      //   }
      // }
    },
  },
};
</script>

<style lang="scss" scoped>
    .errors {
        color: red;
    }
</style>
