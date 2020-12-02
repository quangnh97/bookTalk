<template>
<div class="container content-container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row thong_tin_ebook">
                        <div class="col-md-4 cover">
                            <img :src="'../images/books/'+ book.pic" :alt="book.name" class="img-book" style="width: 214px;">
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
                                <i class="fas fa-shopping-cart" style="    padding-right: 5px;"></i>
                                Mua sách tại những trang thương mại điện tử uy tín ( Tiki, Shopee, Fahasa, Vinabook,...)
                            </div>
                            <a-button>
                                <i class="far fa-thumbs-up" @click="likeBook()"></i>
                                <span> Thích </span>
                                <b>({{likes}})</b>
                            </a-button>

                            <a-button type="primary" shape="round" icon="download" :size="size" @click="dowloadFile()" >
                            Download
                            </a-button>
                            <a-button type="danger">
                                <router-link :to="{name:'bookOnline', params: { id: book.id } }">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true" style="    padding-right: 5px;"></span>Đọc Online
                                </router-link>
                            </a-button>
                        </div>
                    </div>
                    <div class="gioi_thieu_sach text-justify">
                            <div id="commentBox">
                                <div class="commet_form">
                                    <!-- send comment-->
                                    <textarea v-model="comment" class="form-control" ></textarea>
                                    <button class="btn btn-success mt-1" style="    margin-top: 5px;" @click="addComment()">Send</button>
                                </div>
                                <div style="    margin-top: 10px;">
                                    <ul v-for="comment in comments" :key="comment.id" class="comment-ul">
                                        <li >
                                            <div v-if="comment.name" style="    background-color: #F0F2F5; border-radius: 15px;">
                                                <a style="color: black;font-weight: bold;">
                                                    <img  :src="'../images/' + comment.pic" width="32" style="margin:5px; height:32px;" class="img-circle"/>
                                                    {{ comment.name }}
                                                </a>
                                                <p style="margin-left: 50px; padding: 0px 10px 10px 0px;">
                                                    {{comment.comment}}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                    </div>
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
            categoryName:'',
            comment: '',
            comments: [],
            likes: '',
        }
    },

    watch: {
        $route() {
            this.bookId = this.$route.params.id;
            this.getBook();
            this.getComments();
        }
    },

    created() {
        this.bookId = this.$route.params.id;
        this.getBook();
        this.getComments();
    },

    methods: {
        getBook(){
            axios.get('/books', {
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

        likeBook() {

        },

        getLikes() {
            axios.get('/likes', {
                params: {
                    id: this.bookId,
                },
            })
                .then(response => {
                    console.log('comments');
                    if(response.status===200){
                        console.log(response);
                        this.likes = response.data.likes;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        getComments() {
            axios.get('/comments', {
                params: {
                    id: this.bookId,
                },
            })
                .then(response => {
                    console.log('comments');
                    if(response.status===200){
                        console.log(response);
                        this.comments = response.data.comments;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        addComment(){
            axios.post('/addComment', {
                comment: this.comment,
                id: this.bookId
            })
                .then(response => {
                    console.log('saved successfully');
                    if(response.status===200){
                        // console.log(response.data[key]);
                        console.log(response.data);
                        this.getComments();
                        this.comment = "";
                        // app.comments = response.data;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        dowloadFile() {
            axios({
                url: '/getDownload?id=' + this.book.id,
                method: 'GET',
                responseType: 'blob',
            }).then((response) => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                console.log(response.data);
                var fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', this.book.fileName);
                document.body.appendChild(fileLink);
                fileLink.click();
            });
        }
    }
}
</script>
<style lang="scss" scoped >
    .img-book {
        height: 350px !important;
    }

    #commentBox {
        margin-top: 20px;
    }
    .comment-ul {
        li {
            list-style-type: none;
        }
    }

    .info {
        h5 {
            color: black !important;
        }
    }

</style>
