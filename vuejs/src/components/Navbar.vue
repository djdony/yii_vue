<template>
    <!-- Navigation -->
    <nav class="navbar shadow bg-white rounded justify-content-between flex-nowrap flex-row fixed-top">
      <div class="container">
        <a class="navbar-brand float-left" href="" >
           <span v-if="user">Welcome {{user.username}}</span> 
            <span v-else>Main</span> 
        </a>
        <ul class="nav navbar-nav flex-row float-right">
          <li class="nav-item">
            <router-link class="nav-link pr-3" v-if="isLogged === false" to="/login">Sign in</router-link>
          </li>
          <li class="nav-item">
            <router-link class="btn btn-outline-primary" v-if="isLogged === false" to="/register">Sign up</router-link>
            <a href="javascript:void(0)" v-if="isLogged === true" @click="logout">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
</template>

<script>
  import auth from "../services/auth";
  export default {
    name: "Navbar",
    props: {
      user: Object,
    },
    data () {
        return {
        isLogged: auth.isLoggedIn()
        }
    },
    methods: { 
      logout() {
        auth.logout();
        location.reload()
      }
    }
  }
</script>