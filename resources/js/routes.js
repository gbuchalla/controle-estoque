const Login = require('./components/auth/Login.vue').default;
const Register = require('./components/auth/Register.vue').default;

const Home = require('./components/Home.vue').default;
// import Register from './components/auth/Register.vue'; // sintaxe opcional

export const routes = [
    { path: '/login', component: Login, name: 'login' },
    { path: '/register', component: Register, name: 'register' },
    { path: '/', component: Home, name: 'home'}
];
