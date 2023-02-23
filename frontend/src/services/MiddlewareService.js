import axios from 'axios';
const MiddlewareService = axios.create({
    baseURL: 'http://localhost:8000/api/'
});

MiddlewareService.interceptors.request.use(function (config) {
    config.headers.Authorization = `Bearer ${JSON.parse(localStorage.getItem('user')).token}`
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

export default MiddlewareService;