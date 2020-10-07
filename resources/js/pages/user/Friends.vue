<template>
  <div class="col-md-6 col-sm-12 col-xs-12 center-con">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">{{auth.name}}, Your Friends</div>
                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                      <div v-for="friend in friends" :key="friend.id">
                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                          <div class="col-md-2 pull-left">
                            <img  :src="'/images/'+ friend.pic " width="80px" height="80px" class="img-rounded"/>
                          </div>
                          <div class="col-md-7 pull-left">
                            <h3 style="margin:0px;">
                              <router-link :to="'/profile/'+ friend.slug">{{ friend.name }}</router-link>
                            </h3>
                            <p><b>Gender:</b> {{friend.gender}}</p>
                            <p><b>Email:</b> {{ friend.email}}</p>
                          </div>
                          <div class="col-md-3 pull-right">
                            <p>
                              <input type="submit" class="btn btn-default btn-sm" @click="unFriend(friend.id)" value="UnFriend" >
                            </p>
                          </div>
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
        friends:[],
      }
    },
    
    ready: function() {
      this.created();
    },

    created() {
      //list friends
      axios.get('/friends')
      .then(response => {
        this.friends = response.data;
        console.log(this.friends);
      }) 
      .catch(function (error) {
        console.log(error);
      }); 
    },

    methods: {
      unFriend(id) {
        axios.get('/unfriend/' + id)
        .then( (response) =>{
          console.log(response.data); 
          this.friends = response.data;
          // console.log(app.posts);
        })
        .catch(function (error) {
          console.log(error); 
        });
      },
    }

    
  }
</script>