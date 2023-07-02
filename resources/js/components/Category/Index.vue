<template>
    <div>
        <div class="row">
            <router-link to="/categories-create" class="btn btn-primary">Adicionar categoria</router-link>
        </div>

        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de categorias</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Categoria</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in filtersearch" :key="category.id">
                                    <td> {{ category.category_name }} </td>

                                    <td>
                                        <router-link :to="{ name: 'categories-edit', params: { id: category.id } }"
                                            class="btn btn-sm btn-primary">Editar</router-link>

                                        <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">
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
        };
        this.listCategories();
    },

    data() {
        return {
            categories: [],
            searchTerm: ''
        }
    },
    
    computed: {
        filtersearch() {
            return this.categories.filter(category => {
                return category.category_name.match(this.searchTerm)
            })
        }
    },

    methods: {
        listCategories() {
            axios.get('/api/categories/')
                .then(({ data }) => this.categories = data)
                .catch()
        },
        deleteCategory(id) {
            Swal.fire({
                title: 'Você tem certeza?',
                text: "A exclusão não poderá ser revertida",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            })
            .then((result) => {
                if (result.value) {
                    axios.delete('/api/categories/' + id)
                        .then(() => {
                            this.categories = this.categories.filter(category => {
                                return category.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({ name: 'categories' })
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
#em_photo {
    height: 40px;
    width: 40px;
}
</style>