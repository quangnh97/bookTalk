<template>
<div class="col-md-9 col-sm-12 col-xs-12 center-con">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{categoryName}}
                </div>
                <div class="panel-body">
                    <div class="col-xs-6 col-md-3 col-sm-3 ebook"
                        v-for="(book, index) in books"
                        :key="index"
                    >
                        <router-link :to="{name:'book', params: { id: book.id } }">
                            <img :src="'../images/books/'+ book.pic" :alt="book.name" class="img-book">
                            <p class="book-name">{{book.name}}</p>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 sidebar">

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
            categoryId: '',
            categoryName: '',
            books:[],
        }
    },

    created() {
        this.categoryId = this.$route.params.id;
        this.getListBooks();
        console.log('auth' + this.auth);
    },
    methods: {
        getListBooks(){
            axios.get('/booksInCategory', {
                params: {
                categoryId: this.categoryId,
                },
            })
            .then(response => {
                console.log(response.data);
                this.books = response.data.books.data;
                this.categoryName = response.data.name[0].name;
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>
<style lang="scss" scoped>
    .cat-item {
        list-style-type: none;
    }
    .img-book {
        width: 220px;
    }
    .book-name {
        text-align: center;
    }
</style>
