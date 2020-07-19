import httpClient from "./http";
import router from "../router";

const auth = {
  currentUser: null,
  isLoggedIn() {
    return !!localStorage.getItem('access_token')
  },
  checkIfIsLogged () {
    let token = this.$localStorage.get('access_token')
    if (token) {
      return true
    } else {
      return false
    }
  },
  getToken() {
    return localStorage.getItem('access_token')
  },
  async login(formData) {
    try {
      const {status, data} = await httpClient.post('user/login', formData);
      if (status === 200) {
        localStorage.setItem('access_token', data.access_token)
      }
      return {
        success: true
      }
    } catch (e) {
      console.log(e.response);
      return {
        success: false,
        errors: e.response.data.errors
      }
    }
  },
  async register(formData) {
    try {
      const {status, data} = await httpClient.post('user/register', formData);
      if (status === 200) {
        localStorage.setItem('access_token', data.access_token)
      }
      return {
        success: true
      }
    } catch (e) {
      console.log(e.response);
      return {
        success: false,
        errors: e.response.data.errors
      }
    }
  },
  logout() {
    localStorage.removeItem('access_token');
    router.push('/login');
  },
  async getUser() {
    try {
      if (!this.currentUser) {
        const {status, data} = await httpClient.get('/user/data');
        if (status === 200) {
          this.currentUser = data;
        }
      }

    } catch (e) {
      return null;
    }

    return this.currentUser;
  }
};

export default auth;