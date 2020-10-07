<template>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">Registration </div>

      <div class="panel-body">
        <div class="alert alert-danger" v-if="has_error && !success">
          <p v-if="error == 'registration_validation_error'">Validation error, please see the message below.</p>
          <p v-else>Error, unable to register at this time. If the problem persists, please contact an administrator.</p>
        </div>

        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

          <div class="form-group" v-bind:class="{'has-error': has_error && errors.name}">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control" required autofocus v-model="name">
            <span class="help-block" v-if="has_error && errors.name">{{errors.name}}</span>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
            <label for="email">E-mail</label>
            <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
            <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
          </div>

          <div class="form-group" style="height: 30px;">
            <label for="name" class="col-md-2 control-label" style="padding-left: 0px;" >Gender</label>

            <div class="col-md-6">
              <select name="gender" class="col-md-6 control-label"  v-model="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
            <label for="password">Password</label>
            <input type="password" id="password" class="form-control" v-model="password">
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
          </div>

          <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
          </div>

          <button type="submit" class="btn btn-primary">Registration </button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        gender: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },

    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.name,
            email: app.email,
            gender: app.gender,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>

<style scoped>
  @media (min-width: 1200px) {
    .container {
        max-width: 720px !important;
    }
  }
</style>