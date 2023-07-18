<template>
    <div>
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-chart-line mr-2 title-icon"></i>
                    <span>Painel de visão geral</span></h1>
            </div>

            <div class="row mb-3 justify-content-center">
                <!-- Sold (month) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-success h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Vendas no mês</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ sales_month }}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                        <span>Mês: {{ date.slice(3) }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-up text-success mr-1"></i>
                                    <i class="fas fa-dollar-sign text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Expenditure (month) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-danger h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Despesas no mês</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ expenses }} </div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span>Mês: {{ date.slice(3) }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-down text-danger mr-1"></i>
                                    <i class="fas fa-dollar-sign text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <!-- Sold (today) card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-success h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Vendas no dia</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ sales_day }}</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                        <span>Hoje - {{ date }}</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-up text-success mr-1"></i>
                                    <i class="fas fa-dollar-sign text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Out of stock products table -->   
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
        this.getMonthSales();
        this.getTodaySales();
        this.getMonthExpenses();
        this.getStockOut();
    },

    data() {
        return {
            sales_day: '',
            sales_month: '',
            expenses: '',
            stockOutProducts: ''
        }
    },

    computed: {
        date() {
            return new Date().toLocaleDateString('pt-br');
        }
    },

    methods: {
        getTodaySales() {
            axios.get('/api/today/sales')
                .then(({ data }) => (this.sales_day = data))
                .catch(err => console.log(err))
        },
        getMonthSales() {
            axios.get('/api/month/sales')
                .then(({ data }) => (this.sales_month = data))
                .catch(err => console.log(err))
        },
        getMonthExpenses() {
            axios.get('/api/month/expenses')
                .then(({ data }) => (this.expenses = data))
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

<style type="text/css">
#em_photo {
    height: 40px;
    width: 40px;
}
.title-icon {
    color:#4C60DA;
}
</style>