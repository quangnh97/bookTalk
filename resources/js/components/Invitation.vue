<template>
  <ul class="nav navbar-nav" style="position: absolute; left: 600px;">
    <li>
      <router-link :to="{name: 'findFriends'}">Find Friends</router-link>
    </li>

    <li>
      <router-link :to="{ name: 'request' }">My Requests
        <span style="color:green; font-weight:bold;font-size:16px">
          ({{ invite }})
        </span>
      </router-link>
    </li>
  </ul>
</template>

<script>
  export default {
    data() {
      return {
        invite: 0
      }
    },
    ready: function() {
      this.created();
    },

    created() {
      //get all users
      // setInterval(() => {
        axios.get('/getInvitation')
        .then(res => {
          setTimeout(() => {
            console.log('invite:' + res.data)
            this.invite = res.data;
          }, 10000);

        }) 
        .catch(function (error) {
          console.log(error);
        }); 
      // }, 10000)
    },
  }
</script>