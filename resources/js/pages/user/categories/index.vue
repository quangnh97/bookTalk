<template>
<div class="container content-container">
    <ul class="center-block row table-item">
        <li class="cat-item col-xs-12 col-md-4 col-sm-6"
            v-for="(category, index) in categories"
            :key="index"
        >
            <router-link :to="{name:'category', params: { id: category.id } }">
                <a-button>
                    <span class="glyphicon glyphicon-folder-open"></span>
                    {{category.name}}
                </a-button>
            </router-link>

        </li>
    </ul>

    <div style="max-width: 900px;
            margin: 0 auto; margin-top: 30px;">
        <h2>Sách được đọc nhiều nhất</h2>
        <carousel 					:perPage="4"
                                     :autoplay="true"
                                     :loop="true"
                                     :autoplayTimeout="5000"
                                     :navigationEnabled="false"
                                     :paginationEnabled="true">
            <slide v-for="book in books" :key="book.id">
                <router-link :to="{name:'book', params: { id: book.id } }">
                    <img :src="'/images/books/'+ book.pic" :alt="book.name" class="img-book" style="    max-width: 200px;
    height: 300px;">
                </router-link>
            </slide>
        </carousel>
    </div>

    <h2>Sách đề xuất cho bạn</h2>
    <div style="max-width: 900px;
            margin: 0 auto; margin-top: 30px;"
        v-for="(like,index) in likes" :key="index"
    >
        <h3>{{like.name[0].name}}</h3>
        <carousel 					:perPage="4"
                                     :autoplay="true"
                                     :loop="true"
                                     :autoplayTimeout="5000"
                                     :navigationEnabled="false"
                                     :paginationEnabled="true">
            <slide v-for="book in like.books.data"  :key="book.id">
                <router-link :to="{name:'book', params: { id: book.id } }">
                    <img :src="'/images/books/'+ book.pic" :alt="book.name" class="img-book" style="    max-width: 200px;
    height: 300px;">
                </router-link>
            </slide>
        </carousel>
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
            categories:[],
            books:[],
            likes: [],
        }
    },

    created() {
        this.getListCategories();
        this.getLikeCategory();
        this.getListBooks();
        console.log('auth' + this.auth);
    },
    methods: {
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
            axios.get('/booksHot')
                .then(response => {
                    console.log(response.data);
                    this.books = response.data.books.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        getLikeCategory(){
            axios.get('/getLikeCategory?userId=' + this.auth.id)
                .then(response => {
                    console.log('getLikeCategory');
                    console.log(response.data);
                    let arr = response.data.data;
                    for(let i = 0; i < arr.length; i++){
                        console.log(arr[i]);
                        axios.get('/booksInCategory?categoryId=' + arr[i].id)
                            .then(res => {
                                console.log('booksInCategory');
                                console.log(res.data);
                                this.likes.push(res.data);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });


                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    }
}
</script>
<style lang="scss" scoped>
    /*.table-item {*/
    /*    height: 400px;*/
    /*    overflow-y: scroll;*/
    /*}*/
    /*@media screen and (min-width: 1400px) {*/
    /*    .table-item {*/
    /*        height: 700px;*/
    /*    }*/
    /*}*/
    .cat-item {
        list-style-type: none;
    }
    .cat-item {
        padding: 10px 10px;
    }
    .glyphicon {
        padding-right: 10px;
    }
</style>
