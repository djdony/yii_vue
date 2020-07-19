<template>
  <div class="template">
    <Navbar :user="user"/>
    <!-- Main -->
    <div class="App">
      <div class="vertical-center">
          <router-view />
      </div>
    </div>
  </div>
</template>
<script>
  import auth from "@/services/auth";
  import Navbar from "@/components/Navbar";
  export default {
    name: "Default",
    components: {Navbar},
    data(){
      return {
        user: {}
      }
    },
    async mounted() {
      this.user = await auth.getUser()
    }
  }
</script>