

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
                                        <h1 class="h4 text-gray-900 mb-4">Cadastrar uma conta</h1>
                                    </div>
                                    <form class="user" @submit.prevent="register">
                                        <div class="form-group">

                                            <input type="text" class="form-control" id="exampleInputFirstName"
                                                placeholder="Nome completo" v-model="form.name">
                                            <div v-if="errors.name" class="text-danger"><small>{{ errors.name[0] }}</small></div>
                                        </div>

                                        <div class="form-group">

                                            <input type="email" class="form-control" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Endereço de email"
                                                v-model="form.email">
                                            <div v-if="errors.email" class="text-danger"><small>{{ errors.email[0] }}</small></div>
                                        </div>
                                        <div class="form-group">

                                            <input type="password" class="form-control" id="exampleInputPassword"
                                                placeholder="Senha" v-model="form.password">
                                            <div v-if="errors.password" class="text-danger"><small>{{ errors.password[0] }}</small></div>
                                        </div>

                                        <div class="form-group">

                                            <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                                                placeholder="Confirmar senha" v-model="form.password_confirmation">
                                            <div v-if="errors.password_confirmation" class="text-danger"><small>{{ errors.password_confirmation[0] }}</small></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                                        </div>

                                    </form>
                                    <hr>
                                    <div class="text-center">

                                        <router-link to="/login" class="font-weight-bold small">Já possui uma conta?</router-link>
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



<script type="text/javascript">

export default {
    created() {
        if (User.loggedIn()) {
            this.$router.push({ name: 'home' })
        }
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {}
        }
    },
    methods: {
        register() {
            axios.post('/api/auth/register', this.form)
                .then(res => {
                    User.storeDataIfValid(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Cadastro feito com sucesso'
                    })
                    this.$router.push({ name: 'home' })
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.errors = '';
                    }
                })

        }
    }


} 
</script>


<style type="text/css"></style>