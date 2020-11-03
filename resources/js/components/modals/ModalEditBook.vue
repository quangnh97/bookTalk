<template>
    <div
        :class="{modal: true,show: isShowingModalEditBook}"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-label w-100 font-weight-bold">Chỉnh sửa sách</h4>
                    <button type="button" class="close" aria-label="Close" @click="hide()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form" style="margin-top: 10px;">
                        <label for="name" class="lb">Tên sách </label>
                        <input v-model="book.name" placeholder="" class="name" id="name" style="width: 100%">
                    </div>
                    <div class="md-form" style="margin-top: 10px;">
                        <label for="description" class="lb">Mô tả </label>
                        <textarea
                            v-model="book.description"
                            cols="40"
                            rows="3"
                            class="description" id="description" style="width: 100%"
                        />
                    </div>
                    <div class="md-form" style="margin-top: 10px;">
                        <label for="pic" class="lb">Ảnh bìa </label>
                        <input type="file" placeholder="" class="description" id="pic" @change="handleUploadImg" >
                        <img v-if="picNew" class="avatar1" :src="picNew" width="100" style="margin: 10px;">

                    </div>
                    <div class="md-form" style="margin-top: 10px;">
                        <label for="author" class="lb">Tác giả </label>
                        <input v-model="book.author" placeholder="" class="author" id="author" style="width: 100%">
                    </div>
                    <div class="md-form" style="margin-top: 10px;">
                        <label for="file" class="lb">File pdf </label>

                        <input type="file" class="file" id="file" @change="handleUploadFile">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" @click="hide()">
                        Hủy
                    </button>
                    <button class="btn btn-primary seeMore" aria-label="Close" aria-hidden="true" @click="editCategory()">Done</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import EventBus from '../../app';
    const EDIT_CATEGORY = 'EDIT_CATEGORY';
    export default {
        EDIT_CATEGORY: EDIT_CATEGORY,
        data() {
            return {
                book:{},
                errors: {
                    name: '',
                },
            };
        },
        computed: {
            ...mapGetters('modals', ['isShowingModalEditBook']),
            ...mapGetters('modals', ['idBookEdit']),
        },
        watch: {
            isShowingModalEditBook: function() {
                this.getBook();
                console.log(this.idBookEdit);
            },
        },
        created() {

        },
        methods: {
            ...mapActions({
                hide: 'modals/hideModalEditBook',
            }),

            getBook(){
                axios.get('/books', {
                    params: {
                        id: this.idBookEdit,
                    },
                })
                    .then(response => {
                        console.log(response.data);
                        this.book = response.data.book[0];
                        // this.categoryName = response.data.category[0].name;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            editCategory() {
                let hasErrors = false;
                axios.put('/categories/' +  this.category.id,{
                        name: this.name,
                })
                    .then(response => {
                        console.log(response.data);
                        if(response.data.success){
                            EventBus.$emit(EDIT_CATEGORY, 'create_category');
                            this.hide();
                            this.name = '';
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
</style>
