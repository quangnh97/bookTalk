<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">
          <h1>ĐỌC SÁCH, TRUYỆN HAY ONLINE VÀ TÀI LIỆU THAM KHẢO MIỄN PHÍ</h1>
      </div>
        <div>
            <ul class="center-block">
                <li class="cat-item"
                    v-for="(category, index) in categories"
                    :key="index"
                >
                    <router-link :to="{name:'category', params: { id: category.id } }">
                        <span class="glyphicon glyphicon-folder-open" style="padding-right: 10px;"></span>
                        {{  category.name}}
                    </router-link>

                </li>
            </ul>
        </div>

      <div class="card-body">

      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      user: {},
        categories:[],
    }
  },

  ready: function(){
    this.created();
  },

  created() {
    // posts
    axios.get('/posts')
    .then(response => {
      console.log(response);
      this.posts = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });

        // the loai
      this.getListCategories();

    // show info user
    axios.get('/user')
    .then(response => {
      this.user = response.data;
      // console.log(this.user);
    })
    .catch(function (error) {
      console.log(error);
    });
  },

    methods: {
        getListCategories(){
            axios.get('/categoryHome')
                .then(response => {
                    console.log(response.data);
                    this.categories = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>

<style lang="scss" scoped>
    .card-header {
        h1 {
            padding-top: 12px;
            font-size: 21px;
            color: rgb(0 0 0);
            margin-bottom: 25px;
        }
    }
    .cat-item {
        list-style-type: none;
        display: inline-block;
        a {
            border: 1px solid rgb(204 204 204);
            border-radius: 15px;
            padding: 8px;
            margin-right: 20px;
        }
    }
</style>
