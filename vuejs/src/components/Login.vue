<template>
  <div class="inner-block">
        <form @submit.prevent="login" action="">
              <div v-if="errors" class="errors">
                  <p v-for="(error, field) in errors" :key="field">
                    {{error[0]}}
                  </p>
              </div>
            <h3>Sign In</h3>

            <div class="form-group">
                <label>Username</label>
                <input type="text" v-model="form.username" class="form-control form-control-lg" />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" v-model="form.password" class="form-control form-control-lg" />
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Sign In</button>

            <p class="forgot-password text-right mt-2 mb-4">
                <router-link to="/forgot-password">Forgot password ?</router-link>
            </p>

            <div class="social-icons">
                <ul>
                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>

        </form>
    </div>
</template>
<script>
  import auth from "../services/auth";
  export default {
    name: "Login",
    data() {
      return {
        form: {
          username: '',
          password: ''
        },
        errors: null
      }
    },
    methods: {
      async login() {
        const {success, errors} = await auth.login(this.form);
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
