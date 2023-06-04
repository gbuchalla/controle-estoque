const Login = require('./components/auth/Login.vue').default;
const Register = require('./components/auth/Register.vue').default;
// import Register from './components/auth/Register.vue'; // syntax opcional

export const routes = [
    { path: '/', component: Login, name: '/' },
    { path: '/register', component: Register, name: 'register' }
];
