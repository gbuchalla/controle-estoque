<template>
    <div>

        <div class="row">
            <router-link :to="{ name: 'products-create' }" class="btn btn-primary">Adicionar produto</router-link>
        </div>
        
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de produtos</h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Foto</th>
                                    <th>Categoria</th>
                                    <th>Preço de compra</th>
                                    <th>Preço de venda</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <tr v-for="product in filtersearch" :key="product.id">
                                    <td> {{ product.product_name }} </td>
                                    <td> {{ product.product_code }} </td>
                                    <td><img :src="product.image" id="em_photo"></td>
                                    <td>{{ product.category_name }}</td>
                                    <td>{{ product.buying_price }}</td>
                                    <td>{{ product.selling_price }}</td>
                                    <td>
                                        <router-link :to="{ name: 'products-edit', params: { id: product.id } }"
                                            class="btn btn-sm btn-primary">Editar</router-link>
                                        <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">
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
        this.listProducts();
    },

    data() {
        return {
            products: [],
            searchTerm: ''
        }
    },

    computed: {
        filtersearch() {
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
            })
        }
    },

    methods: {
        listProducts() {
            axios.get('/api/products/')
                .then(({ data }) => (this.products = data))
                .catch()
        },
        deleteProduct(id) {
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
                    axios.delete('/api/products/' + id)
                        .then(() => {
                            this.products = this.products.filter(product => {
                                return product.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({ name: 'products' })
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