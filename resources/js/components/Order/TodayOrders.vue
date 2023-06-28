<template>
    <div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Pesquisar">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Ordens do Dia</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>Valor total</th>
                                    <th>Valor pago</th>
                                    <th>Saldo devedor</th>
                                    <th>Método de pagamento</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in filtersearch" :key="order.id">
                                    <td> {{ order.name }} </td>
                                    <td> {{ order.total }} $ </td>
                                    <td> {{ order.pay }} $ </td>
                                    <td> {{ order.due }} $ </td>
                                    <td> {{ order.payment_method }} </td>

                                    <td>
                                        <router-link :to="{ name: 'orders-show', params: { id: order.id } }"
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
            orders: [],
            searchTerm: ''
        }
    },

    computed: {
        filtersearch() {
            return this.orders.filter(order => {
                return order.name.match(this.searchTerm)
            })
        }
    },

    methods: {
        getTodayOrders() {
            axios.get('/api/orders/today')
                .then(({ data }) => (this.orders = data))
                .catch(err => console.log(err))
        },
    },

    created() {
        this.getTodayOrders();
    }
} 
</script>


<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
</style>