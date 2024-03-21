import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';
let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf;
