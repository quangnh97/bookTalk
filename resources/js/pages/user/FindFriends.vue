<template>
  <div class="col-md-6 col-sm-12 col-xs-12 center-con">
    <div class="panel panel-default">
      <div class="panel-heading">{{auth.name}}</div>
      <div class="panel-body">
        <div class="col-sm-12 col-md-12">
          <div v-for="(user, index) in users" :key="user.id">
            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
              <div class="col-md-2 pull-left">
                <img  :src="'/images/' + user.pic" width="80px" height="80px" class="img-rounded"/>
              </div>

              <div class="col-md-7 pull-left">
                <h3 style="margin:0px;">
                  <router-link :to="'/profile/' + user.slug" > {{ user.name }} </router-link>
                </h3>
                <p><i class="fa fa-globe"></i> {{user.city}} - {{user.country}}</p>
                <p>{{user.about}}</p>
              </div>

              <div class="col-md-3 pull-right">
                <span v-if="checkFriend(user.id,index) &&  user.isFriend == 0"> 
                  <input @click="addFriend(user.id,index)" type="submit" class="btn btn-info btn-sm" value="Add to Friend">        
                </span>
                <span v-else>Request Already Sent</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let temp
  export default {
    props: {
      auth: {
        type: Object
      }
    },

    data() {
      return {
        users: [],
      }
    },
    
    ready: function() {
      this.created();
    },

    created() {
      //get all users
      axios.get('/getAllUsers')
      .then(response => {
        this.users = response.data;
        this.users.forEach(item => {
          Vue.set(item, 'isFriend', 0)
        })
        console.log(this.users);
      }) 
      .catch(function (error) {
        console.log(error);
      }); 
    },

    methods: {
      addFriend(id,index) {
        axios.get('/addFriend/' + id)
        .then( (response) =>{
          this.users[index].isFriend = 1;  
        })
        .catch(function (error) {
          console.log(error); 
        });
      },

      checkFriend(idUser, index) {
        axios.get('/checkFriend/' + idUser)
        .then( res => {
          // console.log(this.users[0])
          // console.log(this.users[0].isFriend)
          this.users[index].isFriend = res.data;
        })
        .catch(function(error) {
          console.log(error);
        });
        return true;
      }

    },

  }
</script>