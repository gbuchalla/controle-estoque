<template>
    <div>
        <div class="row">
            <router-link :to="{name: 'expenses-create'}" class="btn btn-primary">Adicionar despesa</router-link>
        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de despesas</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Detalhes</th>
                                    <th>Valor (R$)</th>
                                    <th>Data</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="expense in filtersearch" :key="expense.id">
                                    <td> {{ expense.details }} </td>
                                    <td> {{ expense.amount }} </td>
                                    <td> {{ expense.expense_date }} </td>
                                    <td>
                                        <router-link :to="{ name: 'expenses-edit', params: { id: expense.id } }"
                                            class="btn btn-sm btn-primary">Editar</router-link>
                                        <a @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger">
                                            <font color="#ffffff">Excluir</font>
                                        </a>
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
            expenses: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch() {
            return this.expenses.filter(expense => {
                return expense.expense_date.match(this.searchTerm)
            })
        }
    },

    methods: {
        listExpenses() {
            axios.get('/api/expenses/')
                .then(({ data }) => (this.expenses = data))
                .catch()
        },
        deleteExpense(id) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "A exclusão não poderá ser revertida",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/expenses/' + id)
                        .then(() => {
                            this.expenses = this.expenses.filter(expense => {
                                return expense.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({ name: 'expenses' })
                        })
                    Swal.fire(
                        'Excluído!',
                        'O arquivo foi excluído.',
                        'success'
                    )
                }
            })

        }
    },
    created() {
        this.listExpenses();
    }
} 
</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>