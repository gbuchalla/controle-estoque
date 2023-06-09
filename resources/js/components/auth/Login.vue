<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Entrar na sua conta</h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group" >
                                            <input type="email" class="form-control" v-model="form.email" id="input-email"
                                                aria-describedby="emailHelp" placeholder="Endereço de email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" v-model="form.password" id="input-password"
                                                placeholder="Senha">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar de mim</label>
                                            </div>
                                        </div>
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
import { userInfo } from 'os';

export default {
    data () {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login() {   
            axios.post('/api/auth/login', this.form)
                .then(res => {
                    console.log(res);
                    User.storeDataIfValid(res);
                })
                .catch(error => console.log(error.response))
        }
    }

}
</script>
