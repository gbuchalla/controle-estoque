const Login = require('./components/auth/Login.vue').default;
const Register = require('./components/auth/Register.vue').default;
const Logout = require('./components/auth/Logout.vue').default;
// import Register from './components/auth/Register.vue'; // sintaxe opcional

const Home = require('./components/Home.vue').default;

export const routes = [
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/logout', component: Logout, name: 'logout' },

    { path: '/', component: Home, name: 'home'}
];
