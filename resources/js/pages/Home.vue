<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-header">Please login</div>

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
    }
  },

  ready: function(){
    this.created();
  },

  created() {

    axios.get('/posts')
    .then(response => {
      console.log(response); 
      this.posts = response.data;
    })
    .catch(function (error) {
      console.log(error); 
    });

    // show info user
    axios.get('/user')
    .then(response => {
      this.user = response.data;
      // console.log(this.user);
    })
    .catch(function (error) {
      console.log(error);
    });
  }
}
</script>