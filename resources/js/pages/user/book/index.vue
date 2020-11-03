<template>
<div class="container content-container">
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
                            <button target="_blank" type="button" class="btn btn-danger" @click="dowloadFile()">
                                Download
<!--                                <a :href="'/api/getDownload?id='+ book.id" class="download" >-->
<!--                                    PDF-->
<!--                                </a>-->
                            </button>
                            <button target="_blank" type="button" class="btn btn-warning btn-md">
                                <router-link :to="{name:'bookOnline', params: { id: book.id } }">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>Đọc Online
                                </router-link>
                            </button>
                        </div>
                    </div>
                    <div class="gioi_thieu_sach text-justify">
                            <div id="commentBox">
                                <div class="commet_form">
                                    <!-- send comment-->
                                    <textarea v-model="comment" class="form-control" ></textarea>
                                    <button class="btn btn-success mt-1" @click="addComment()">Send</button>
                                </div>
                                <ul v-for="comment in comments" :key="comment.id">
                                    <li >
                                        <p v-if="comment.name">
                                            <a>
                                                <img  :src="'../images/' + comment.pic" width="32" style="margin:5px; height:32px;" class="img-circle"/>
                                                {{ comment.name }}
                                            </a>
                                            {{comment.comment}}
                                        </p>
                                    </li>
                                </ul>
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
        console.log('111111');
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
</style>
