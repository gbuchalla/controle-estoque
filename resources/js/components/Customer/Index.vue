<template>
    <div>
        <div class="row">
            <router-link to="/customers-create" class="btn btn-primary">Adicionar cliente</router-link>
        </div>

        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de clientes</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Foto</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Endereço</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="customer in filtersearch" :key="customer.id">
                                    <td> {{ customer.name }} </td>
                                    <td><img :src="customer.photo" id="em_photo"></td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.address }}</td>
                                    <td>
                                        <router-link :to="{ name: 'customers-edit', params: { id: customer.id } }"
                                            class="btn btn-sm btn-primary">Editar</router-link>
                                        <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Excluir</font>
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
            customers: [],
            searchTerm: '',
            errors: {}
        }
    },
    computed: {
        filtersearch() {
            return this.customers.filter(customer => {
                return customer.name.match(this.searchTerm)
            })
        }
    },
    methods: {
        listCustomers() {
            axios.get('/api/customers/')
                .then(({ data }) => (this.customers = data))
                .catch(error => this.errors = error.response.data.errors)
        },
        deleteCustomer(id) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: 'A exclusão não poderá ser revertida',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/api/customers/' + id)
                        .then(() => {
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({ name: 'customers' })
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
        this.listCustomers();
    }
} 
</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>