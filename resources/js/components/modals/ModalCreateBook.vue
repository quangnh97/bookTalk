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
                <input type="file" placeholder="" class="description" id="pic" @change="handleUploadFile" >
            </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="author" class="lb">Tác giả </label>
                <input v-model="author" placeholder="" class="author" id="author" style="width: 100%">
            </div>
            <div class="md-form" style="margin-top: 10px;">
                <label for="file" class="lb">File pdf </label>
                <input type="file" class="file" id="file">
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
const CREATE_CATEGORY = 'CREATE_CATEGORY';
export default {
    CREATE_CATEGORY: CREATE_CATEGORY,
  data() {
    return {
        name: '',
        pic: '',
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
      createCategory() {
        let hasErrors = false;
          axios.get('/categories/create',{
              params: {
                  name: this.name,
              },
          })
          .then(response => {
              console.log(response.data);
              if(response.data.success){
                  EventBus.$emit(CREATE_CATEGORY, 'create_category');
                  this.hide();
                  this.name = '';
              }
          })
          .catch(function (error) {
              console.log(error);
          });
    },
      handleUploadFile(e) {
          this.avatar = e.target.files[0];
          const reader = new FileReader();
          reader.readAsDataURL(this.avatar);
          reader.onload = (e) => {
              this.newAvatar = e.target.result;
          };
      },
  },
};
</script>

<style lang="scss" scoped>
    .errors {
        color: red;
    }
</style>
