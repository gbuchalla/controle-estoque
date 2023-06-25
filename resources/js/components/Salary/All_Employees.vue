<template>
    <div>
        <div class="row">
            <router-link :to="{ name: 'employees-create' }" class="btn btn-primary">Adicionar um funcionário</router-link>
        </div>
        
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de funcionários</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">

                            <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Telefone</th>
                                    <th>Salário</th>
                                    <th>Data de entrada</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="employee in filterSearch" :key="employee.id">
                                    <td> {{ employee.name }} </td>
                                    <td><img :src="employee.photo" id="em_photo"></td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <router-link :to="{ name: 'salaries-pay', params: { employee_id: employee.id } }"
                                            class="btn btn-sm btn-primary">
                                            Registrar pagamento de salário
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
            employees: [],
            searchTerm: ''
        }
    },

    computed: {
        filterSearch() {
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        getEmployees() {
            axios.get('/api/employees/')
                .then(({ data }) => (this.employees = data))
                .catch(err => console.log(err))
        },
    },

    created() {
        this.getEmployees();
    }
} 
</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>