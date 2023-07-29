import axios from "axios";

axios.interceptors.request.use(function (config) {
  if (localStorage.token !== undefined) {
    config.headers["Authorization"] = `Bearer ${localStorage.token}`;
  }
  return config;
}, function (error) {
  return Promise.reject(error);
});

axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {

  if (error.response.status === 401) {
    console.log('error 401');
  }
  else if (error.response.status === 500) {
    window.location.href = window.location.origin + '/error-500'
  }

  return Promise.reject(error);
});

export default axios;

axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    console.log(error.response.status)
    if(error.response.status == 401){
        console.log('logout')
    }else if(error.response.status == 500){
       window.location.href = window.location.origin + '/error-500'
    }
    return Promise.reject(error);
});