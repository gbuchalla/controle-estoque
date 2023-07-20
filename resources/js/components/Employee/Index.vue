<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'employees-create' }" class="btn btn-primary">Adicionar funcionário</router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de funcionários</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush text-center">
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
                            <tbody class="text-center">
                                <tr v-for="employee in filtersearch" :key="employee.id">
                                    <td> {{ employee.name }} </td>
                                    <td><img :src="employee.photo" id="em_photo"></td>
                                    <td>{{ employee.phone }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.joining_date }}</td>
                                    <td>
                                        <router-link :to="{ name: 'employees-edit', params: { id: employee.id } }"
                                            class="btn btn-sm btn-primary">Editar</router-link>

                                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger">
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
        <!--Row-->



    </div>
</template>



<script type="text/javascript">
  
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: 'login' })
        };
        this.listEmployees();
    },
    data() {
        return {
            employees: [],
            searchTerm: '',
            errors: {}
        }
    },
    computed: {
        filtersearch() {
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm)
            })
        }
    },
    methods: {
        listEmployees() {
            axios.get('/api/employees/')
                .then(({ data }) => (this.employees = data))
                .catch(error => this.errors = error.response.data.errors)
        },
        deleteEmployee(id) {
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
                    axios.delete('/api/employees/' + id)
                        .then(() => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({ name: 'employees' })
                        })
                    Swal.fire(
                        'Excluído!',
                        'O arquivo foi excluído.',
                        'success'
                    )
                }
            })
        }

    }
} 
</script>


<style type="text/css">
#em_photo{
height: 40px;
width: 40px;
}
</style>