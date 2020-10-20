<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        Welcome to your administrator dashboard
      </div>
    </div>
    <div class="card card-default">
        <div class="btn-group-vertical">
            <div class="button-setting">
                <div type="button" class="btn btn-warning st-s" style="margin-left: 0px !important">Quản lí</div>
            </div>
            <div class="button-setting">
                <div class="mini-color" />
                <div class="bt-st">
                    <router-link :to="{name:'categories-manager'}">
                        <button type="button" class="btn btn-warning st-sp">
                            Thể loại sách
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="button-setting">
                <div class="mini-color" />
                <div class="bt-st">
                    <router-link :to="{name:'books-manager'}">
                        <button type="button" class="btn btn-warning st-sp">
                            Tất cả sách
                        </button>
                    </router-link>
                </div>
            </div>
            <div class="button-setting">
                <div class="mini-color" />
                <div class="bt-st">
                    <router-link :to="{name:'users-manager'}">
                        <button type="button" class="btn btn-warning st-sp">
                            Quản lí user
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
        <router-view />
    </div>
  </div>
</template>

<script>
  import userList from '../../components/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>

<style lang="scss" scoped>
    .btn-group-vertical {
        width: 275px;
        float: left;
    }

    .st-s {
        background-color: rgb(254 230 122) !important;
        width: 82%;
    }

    .btn {
        color: rgb(0 0 0);
    }
    .mini-color {
        float: left;
        width: 1%;
        background-color: #fee67a;
        margin-left: 7%;
    }

    .bt-st {
        float: left;
        background-color: #fee67a;
        width: 80%;

    }

    .btn-warning {
        background-color: #ffffff !important;
        border: 0;
        border-color: #ffffff;
        width: 100%;
        max-width: 250px;
        margin: 0;
        margin-left: 2%;
    }

    .btn-warning:focus {
        box-shadow: 0 0 0 1px rgba(222, 207, 69, 0.5);
    }

    .st-s {
        background-color: #fee67a !important;
        width: 82%;
    }

    .st-pc {
        background-color: #efefef !important;

    }

    .st-sp {
        background-color: #efefef !important;
    }

    .st-ss {
        background-color: #efefef !important;
    }

    .button-setting {
        margin: 2%;
        width: 260px;
        height: 35px;
    }


</style>
