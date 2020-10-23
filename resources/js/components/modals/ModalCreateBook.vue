<template>
  <div
    :class="{modal: true,show: isShowingModalCreateBook}"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-label w-100 font-weight-bold">Tạo sách mới</h4>
          <button type="button" class="close" aria-label="Close" @click="hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <div class="md-form" style="margin-top: 10px;">
            <label for="name" class="lb">Tên sách </label>
            <input v-model="name" placeholder="" class="name" id="name" style="width: 100%">
          </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="description" class="lb">Mô tả </label>
                <input v-model="description" placeholder="" class="description" id="description" style="width: 100%">
            </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="pic" class="lb">Ảnh bìa </label>
                <input type="file" placeholder="" class="description" id="pic" @change="handleUploadImg" >
                <img v-if="picNew" class="avatar1" :src="picNew" width="100" style="margin: 10px;">

            </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="author" class="lb">Tác giả </label>
                <input v-model="author" placeholder="" class="author" id="author" style="width: 100%">
            </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="file" class="lb">File pdf </label>

                <input type="file" class="file" id="file" @change="handleUploadFile">
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button class="btn btn-primary seeMore" aria-label="Close" aria-hidden="true" @click="createBook()">Done</button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import EventBus from '../../app';
const CREATE_BOOK = 'CREATE_BOOK';
export default {
    CREATE_BOOK: CREATE_BOOK,
  data() {
    return {
        name: '',
        pic: '',
        picNew: '',
        description: '',
        author: '',
        file: '',
      errors: {
          name: '',
      },
    };
  },
  computed: {
    ...mapGetters('modals', ['isShowingModalCreateBook']),
    ...mapGetters('modals', ['categoryId']),
  },
  watch: {
    isShowingModalCreateNote: function(newVal, oldVal) {
      if (!oldVal && newVal) {
        this.errors = {
            name: '',
        };
      }
    },
  },
  methods: {
    ...mapActions({
      hide: 'modals/hideModalCreateBook',
    }),
      createBook() {
        let hasErrors = false;

          const formData = new FormData();
          formData.append('name', this.name);
          formData.append('pic', this.pic);
          formData.append('description', this.description);
          formData.append('author', this.author);
          formData.append('file', this.file);
          formData.append('category_id', this.categoryId);

          this.$http.post('/book', formData, {
                  headers: {
                      'Content-Type': 'multipart/form-data',
                  },
              }
          ).then(response => {
              if(response.data.success){
                  EventBus.$emit(CREATE_BOOK, 'create_category');
                  this.name =  '',
                  this.pic =  '',
                  this.picNew =  '',
                  this.description =  '',
                  this.author =  '',
                  this.file = '',
                  this.hide();
              }
          })
          .catch(function (error) {
              console.log(error);
          });
    },
      handleUploadImg(e) {
          this.pic = e.target.files[0];
          const reader = new FileReader();
          reader.readAsDataURL(this.pic);
          reader.onload = (e) => {
              this.picNew = e.target.result;
          };
      },

      handleUploadFile(e) {
          this.file = e.target.files[0];
          const reader = new FileReader();
          reader.readAsDataURL(this.file);
      }

  },
};
</script>

<style lang="scss" scoped>
    .errors {
        color: red;
    }
    .modal-body {
        overflow-y: scroll;
        height: 400px;
    }
</style>
