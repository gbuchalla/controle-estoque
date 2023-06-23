<template>
    <div>
        <div class="row">
            <router-link :to="{ name: 'employees-salaries' }" class="btn btn-primary">Lista de salários de
                funcionários</router-link>
        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de registro de pagamento de salário</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Mês</th>
                                    <th>Detalhes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="salary in filtersearch" :key="salary.id">
                                    <td> {{ salary.salary_month }} </td>
                                    <td>
                                        <router-link :to="{ name: 'salaries-show', params: { id: salary.salary_month } }"
                                            class="btn btn-sm btn-primary">Ver detalhes</router-link>
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
        filtersearch() {
            return this.salaries.filter(salary => {
                return salary.salary_month.match(this.searchTerm)
            })
        }
    },

    methods: {
        listPayments() {
            axios.get('/api/salaries/')
                .then(({ data }) => (this.salaries = data))
                .catch()
        },
    },

    created() {
        this.listPayments();
    }
}

</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>