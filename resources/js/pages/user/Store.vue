<template>
<div class=" container">
    <div class="row ">
        <div class="col-md-9 ">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    Kho lưu trữ sách
                </div>
                <div class="panel-body category-list table-item">
                    <div class="col-xs-6 col-md-3 col-sm-3 ebook"
                        v-for="(book, index) in books"
                        :key="index"
                    >
                        <router-link :to="{name:'book', params: { id: book.id } }">
                            <img :src="'/images/books/'+ book.pic" :alt="book.name" class="img-book" style="width: 111px;">
                            <p class="book-name">{{book.name}}</p>
                        </router-link>
                    </div>
                </div>
                <div v-if="page < last_page" class="text-center">
                    <button type="button" class="btn seeMore" @click="seeMore()">
                       Xem thêm
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3 sidebar">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Thể Loại Sách
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li v-for="category in categories" :key="category.id">
                        <router-link :to="{name:'category', params: { id: category.id } }">
                            {{category.name}}
                        </router-link>
                    </li>
                </ul>
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
            books:[],
            page: 1,
            last_page: '',
            numberPage: 1, // so trang
            onePage: 4,
            categories:[],
        }
    },
    watch: {
        $route(){
            this.categoryId = this.$route.params.id;
            this.getListBooks();
        },
    },
    created() {
        this.getListBooks();
        console.log('auth' + this.auth);
        this.getListCategories();
    },
    methods: {
        seeMore() {
            this.getListBooks(this.page + 1);
        },

        getListCategories(){
            axios.get('/allCategories')
                .then(response => {
                    console.log(response.data);
                    this.categories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        getListBooks(pageNum){
            axios.get('/booksStore?page=' + pageNum , {
                params: {
                userId: this.auth.id,
                },
            })
            .then(response => {
                console.log(response.data);
                console.log(response.data.books.last_page);
                const notes  = response.data.books.data;
                for (let i = 0; i < notes.length; i++){
                    this.books.push(notes[i]);
                }
                this.last_page = response.data.books.last_page;
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>
<style lang="scss" scoped >
    .table-item {
        height: 400px;
        overflow-y: scroll;
    }
    @media screen and (min-width: 1400px) {
        .table-item {
            height: 700px;
        }
    }
    .ebook {
        position: relative;
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    }
    .cat-item {
        list-style-type: none;
    }
    .img-book {
        height: 180px;
    }
    .book-name {
        text-align: center;
    }
    .content-container {
        margin-top: 20px;
        height: 550px;
        overflow-y: scroll;
    }
    /*.category-list {*/
    /*    overflow-y: scroll;*/
    /*    height: 420px;*/
    /*}*/
    .book-name {
        height: 60px;
    }
    .pagination {
        margin-top: 10px !important;
        margin-bottom: 10px !important;
    }

</style>
