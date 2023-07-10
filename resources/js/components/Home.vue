<template>
    <div>
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Painel de visão geral</h1>

            </div>

            <div class="row mb-3 justify-content-center">
                <!-- Sold (today) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Valor vendido </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ sold }}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                        <span>Hoje - {{ date }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Income/Earnings (today) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Valor recebido </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ income }} </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span>Hoje - {{ date }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Due (today) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Saldo devedor gerado </div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$ {{ due }} </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span>Hoje - {{ date }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Expenditure (today) card -->
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Despesas </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ expense }} </div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span>Hoje - {{ date }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Produtos fora de estoque</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Foto</th>
                                    <th>Preço de compra</th>
                                    <th>Status</th>
                                    <th style="padding-right:12px;">Quantidade</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <tr v-for="product in stockOutProducts" :key="product.id">
                                    <td> {{ product.product_name }} </td>
                                    <td> {{ product.product_code }} </td>
                                    <td><img :src="product.image" id="em_photo"></td>
                                    <td>{{ product.buying_price }}</td>
                                    <td v-if="product.product_quantity >= 1"><span
                                            class="badge badge-success">Disponível</span></td>
                                    <td v-else=" "><span class="badge badge-danger">Sem estoque</span></td>
                                    <td style="padding-right:12px;">{{ product.product_quantity }}</td>
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

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: 'login' })
        };
        this.getTodaySold();
        this.getTodayIncome();
        this.getTodayDue();
        this.getTodayExpense();
        this.getStockOut();
    },

    data() {
        return {
            sold: '',
            income: '',
            due: '',
            expense: '',
            stockOutProducts: ''
        }
    },

    computed: {
        date() {
            return new Date().toLocaleDateString('pt-br');
        }
    },

    methods: {
        getTodaySold() {
            axios.get('/api/today/sold')
                .then(({ data }) => (this.sold = data))
                .catch(err => console.log(err))
        },
        getTodayIncome() {
            axios.get('/api/today/income')
                .then(({ data }) => (this.income = data))
                .catch(err => console.log(err))
        },
        getTodayDue() {
            axios.get('/api/today/due')
                .then(({ data }) => (this.due = data))
                .catch(err => console.log(err))
        },
        getTodayExpense() {
            axios.get('/api/today/expense')
                .then(({ data }) => (this.expense = data))
                .catch(err => console.log(err))
        },
        getStockOut() {
            axios.get('/api/dashboard/products/stockout')
                .then(({ data }) => (this.stockOutProducts = data))
                .catch(err => console.log(err))
        }
    }
} 
</script>
