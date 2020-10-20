<template>
<div class="col-md-9 col-sm-12 col-xs-12 center-con">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row thong_tin_ebook">
                        <div class="col-md-4 cover">
                            <img :src="'../images/books/'+ book.pic" :alt="book.name" class="img-book">
                        </div>
                        <div class="col-md-8 info">
                            <h1 class="ebook_title text-primary">
                                {{ book.name }}
                            </h1>
                            <h5>Tác giả : {{ book.author }}</h5>
                            <h5>Thể Loại : {{ categoryName }}</h5>
                            <h5>Lượt xem : {{ book.totalView }}</h5>
                            <p>{{book.description}}</p>
                            <div class="alert alert-info">
                                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                                Vui lòng chọn định dạng file để tải hoặc đọc online.
                            </div>
                            <button target="_blank" type="button" class="btn btn-danger">
                                <a :href="'/getDownload?id='+ book.id" class="download">
                                    PDF
                                </a>
                            </button>
                            <button target="_blank" type="button" class="btn btn-warning btn-md">
                                <router-link :to="{name:'bookOnline', params: { id: book.id } }">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>Đọc Online
                                </router-link>
                            </button>
                        </div>
                    </div>
                    <div class="gioi_thieu_sach text-justify"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
      auth: {
        type: Object
      }
    },

    data() {
        return {
            bookId: '',
            book:{},
            categoryName:''
        }
    },

    created() {
        this.bookId = this.$route.params.id;
        this.getBook();
    },

    methods: {
        getBook(){
            axios.get('/book', {
                params: {
                    id: this.bookId,
                },
            })
            .then(response => {
                console.log(response.data);
                this.book = response.data.book[0];
                this.categoryName = response.data.category[0].name;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        dowloadFile() {
            axios.get('/getDownload', {
                params: {
                    id: this.bookId,
                },
            })
                .then(response => {
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>
<style lang="scss" scoped >

</style>
