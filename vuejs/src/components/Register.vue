<template>
    <div class="inner-block">
        <form @submit.prevent="register" action="">
            <h3>Sign Up</h3>

            <div class="form-group">
                <label>Username</label>
                <input type="text" v-model="form.username" class="form-control form-control-lg"/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="form.password"  class="form-control form-control-lg" />
            </div>

    <div class="form-group">
                <label>Repeat Password</label>
                <input type="password"  v-model="form.password_repeat" class="form-control form-control-lg" />
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Sign Up</button>
            <p class="forgot-password text-right">
                Already registered 
                <router-link :to="{name: 'login'}">sign in?</router-link>
            </p>
        </form>
    </div>
</template>

<script>
  import authService from "../services/auth";
  export default {
    name: "Register",
    data() {
      return {
        form: {
          username: '',
          password: '',
          password_repeat: ''
        },
        errors: null
      }
    },
    methods: {
      async register() {
        console.log(this.form);
        const {success, errors} = await authService.register(this.form);
        if (success) {
          this.$router.push({name: 'home'});
          location.reload()
        } else {
          this.errors = errors;
        }
      }
    }
  }
</script>