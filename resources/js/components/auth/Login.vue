<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-11 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Entrar na conta</h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input type="email" class="form-control" v-model="form.email" id="input-email"
                                                aria-describedby="emailHelp" placeholder="Endereço de email">
                                            <div v-if="errors.email" class="text-danger"><small>{{ errors.email[0] }}</small></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="form.password"
                                                id="input-password" placeholder="Senha">
                                            <div v-if="errors.password" class="text-danger"><small>{{ errors.password[0] }}</small></div>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar de mim</label>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/register" class="font-weight-bold small">Criar uma conta</router-link>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    created () {
        if (localStorage.getItem('token')) {
            this.$router.push({name: 'home'});
        }
    },
    data () {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: {}
        }
    },
    methods: {
        login() {
            axios.post('/api/auth/login', this.form)
                .then(res => {
                    console.log(res);
                    User.storeDataIfValid(res);
                    this.$router.push({ name: 'home' })
                        .then(Toast.fire({
                            icon: 'success',
                            title: 'Login feito com sucesso'
                        }));
                })
                .catch(error => {
                    if (error.response.data.error) {
                        this.errors = error.response.data.error;
                        Toast.fire({
                            icon: 'warning',
                            title: 'Email e/ou senha incorretos'
                        })
                    } else {
                        this.errors = '';
                    }
                })
               
        }
    }   
}
</script>
