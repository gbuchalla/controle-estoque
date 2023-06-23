<template>
    <div>
        <div class="row">
            <router-link to="/salaries" class="btn btn-primary">Voltar</router-link>
        </div>

        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Registros de pagamentos de salário - mês de {{
                            $route.params.id }}</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Mês</th>
                                    <th>Salário (R$)</th>
                                    <th>Data</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="salary in filterSearch" :key="salary.id">
                                    <td> {{ salary.name }} </td>
                                    <td>{{ salary.salary_month }}</td>
                                    <td>{{ salary.amount }}</td>
                                    <td>{{ salary.salary_date }}</td>
                                    <td>
                                        <router-link :to="{ name: 'salaries-edit', params: { id: salary.id } }" class="btn btn-sm btn-primary">
                                            Editar registro
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer"></div>
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
            salaries: [],
            searchTerm: ''
        }
    },

    computed: {
        filterSearch() {
            return this.salaries.filter(salary => {
                return salary.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        getPayments() {
            let month = this.$route.params.id
            axios.get(`/salaries/${month}`)
                .then(({ data }) => (this.salaries = data))
                .catch(error => this.errors = error.response.data.errors)
        },
    },

    created() {
        this.getPayments();
    }
} 
</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>