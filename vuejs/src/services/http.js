import axios from 'axios';
import auth from "./auth";
import router from '../router';

/** Default config for axios instance */
const API_ENDPOINT = process.env.VUE_APP_API_ENDPOINT || 'http://basic/';
let config = {
  baseURL: `${API_ENDPOINT}api/`
};

/** Creating the instance for axios */
const httpClient = axios.create(config);

/** Auth token interceptors */
const authInterceptor = config => {
  config.headers.Authorization = `Bearer ${auth.getToken()}`;
  return config;
};


/** Adding the request interceptors */
httpClient.interceptors.request.use(authInterceptor);

/** Adding the response interceptors */
httpClient.interceptors.response.use(
  response => {
    /** TODO: Add any response interceptors */
    return response;
  },
  error => {
    if (error.response.status === 401){
      router.push({name: 'index'}).catch(()=>{})
    }
    /** TODO: Do something with response error */
    return Promise.reject(error);
  }
);

export default httpClient;