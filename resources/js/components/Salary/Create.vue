<template>
    <div>

        <div class="row">
            <router-link to="/employees" class="btn btn-primary">Lista de funcionários</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrar pagamento de salário</h1>
                                    </div>
                                    <form class="user" @submit.prevent="registerPayment">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputName"><b>Nome do funcionário</b></label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Nome completo" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }}
                                                    </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail"><b>Endereço de email</b></label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="Email" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputMonth"><b>Mês de pagamento</b></label>
                                                    <select class="form-control" id="inputMonth"
                                                        v-model="form.salary_month">
                                                        <option> --Escolha um mês-- </option>
                                                        <option value="January"> Janeiro </option>
                                                        <option value="February"> Fevereiro </option>
                                                        <option value="March"> Março </option>
                                                        <option value="April"> Abril </option>
                                                        <option value="May"> Maio </option>
                                                        <option value="Jun"> Junho </option>
                                                        <option value="July"> Julho </option>
                                                        <option value="August"> Agosto </option>
                                                        <option value="September"> Setembro </option>
                                                        <option value="October"> Outubro </option>
                                                        <option value="November"> Novembro </option>
                                                        <option value="December"> Dezembro </option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.salary_month"> {{
                                                        errors.salary_month[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSalary"><b>Salário (R$)</b></label>
                                                    <input type="text" class="form-control" id="inputSalary"
                                                        placeholder="Informe o salário em reais" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount"> {{ errors.amount[0] }}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Registrar
                                                pagamento</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center"></div>
                                    <div class="text-center"></div>
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
        if (!User.loggedIn()) {
            this.$router.push({ name: 'login' })
        }
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                salary_month: '',
                amount: ''
            },
            errors: {}
        }
    },

    created() {
        let id = this.$route.params.id
        axios.get('/api/employees/' + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log('Error'))
    },

    methods: {
        registerPayment() {
            let id = this.$route.params.id
            axios.post(`/salaries/${id}/pay`, this.form)
                .then(() => {
                    this.$router.push({ name: 'employees-salaries' })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }
}

</script>


<style type="text/css"></style>