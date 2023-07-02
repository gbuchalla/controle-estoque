<template>
    <div>
        <div class="row">
            <router-link to="/expenses" class="btn btn-primary">Lista de despesas</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Atualizar dados da despesa</h1>
                                    </div>
                                    <form class="user" @submit.prevent="expenseUpdate">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="inputDetails"><b>Detalhes da despesa</b></label>
                                                    <textarea class="form-control" id="inputDetails" rows="3"
                                                        v-model="form.details"></textarea>
                                                    <small class="text-danger" v-if="errors.details"> {{ errors.details[0] }} </small>
                                                </div>
                                                <div class="col-md-12"><br>
                                                    <label for="inputAmount"><b>Valor (R$)</b></label>
                                                    <input type="text" class="form-control" id="inputAmount" 
                                                    placeholder="Insira o valor" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount"> {{ errors.amount[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label for="inputDate">Data da despesa</label>
                                                        <input type="date" v-model="form.expense_date" id="inputDate">
                                                        <small class="text-danger" v-if="errors.expense_date"> {{ errors.expense_date[0] }} </small>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
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
        };
        this.getExpense();
    },

    data() {
        return {
            form: {
                details: '',
                amount: '',
                expense_date: ''
            },
            errors: {},
        }
    },

    methods: {
        getExpense() {
            let id = this.$route.params.id
            axios.get('/api/expenses/' + id)
                .then(({ data }) => (this.form = data))
                .catch(error => this.errors = error.response.data.errors)
        },
        expenseUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/expenses/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'expenses' })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }
}
</script>


<style type="text/css"></style>