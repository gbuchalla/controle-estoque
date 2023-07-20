<template>
    <div>
        <div class="row">
            <router-link :to="{name: 'orders-today'}" class="btn btn-primary">Voltar</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Detalhes da Ordem</h1>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Informações gerais da
                                                        ordem</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Nome :</b> {{ orders.name }} </li>
                                                        <li class="list-group-item"><b>Telefone :</b> {{ orders.phone }}
                                                        </li>
                                                        <li class="list-group-item"><b>Endereço :</b> {{ orders.address }}
                                                        </li>
                                                        <li class="list-group-item"><b>Data :</b> {{ orders.order_date }}
                                                        </li>
                                                        <li class="list-group-item"><b>Método de Pagamento :</b> {{
                                                            orders.payment_method }}</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Informações sobre a
                                                        transação</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>SubTotal :</b> R$ {{ orders.sub_total }}
                                                            </li>
                                                        <li class="list-group-item" v-if="orders.tax"><b>Taxa de Imposto :</b> {{ orders.tax
                                                        }} %</li>
                                                        <li class="list-group-item"><b>Valor Total :</b> R$ {{ orders.total }}
                                                        </li>
                                                        <li class="list-group-item"><b>Valor Pago :</b> R$ {{ orders.pay }}
                                                        </li>
                                                        <li class="list-group-item"><b>Saldo Devedor :</b> R$ {{
                                                            orders.due }}</li>
                                                    </ul>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <div class="card">
                                                <div
                                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Informações sobre os
                                                        produtos adquiridos</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light text-center">
                                                            <tr>
                                                                <th>Nome do Produto</th>
                                                                <th>Código do Produto</th>
                                                                <th>Imagem</th>
                                                                <th>Quantidade</th>
                                                                <th>Preço Unitário</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            <tr v-for="detail in details">
                                                                <td>{{ detail.product_name }}</td>
                                                                <td>{{ detail.product_code }}</td>
                                                                <td><img :src="'/' + detail.image" id="em_photo"></td>
                                                                <td>{{ detail.product_quantity }}</td>
                                                                <td>R$ {{ detail.product_price }}</td>
                                                                <td>R$ {{ detail.sub_total }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="text-center"></div>
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        this.getOrder();
        this.getOrderDetails();
    },

    data() {
        return {
            errors: {},
            orders: {},
            details: {},
        }
    },

    methods: {
        getOrder() {
            let id = this.$route.params.id
            axios.get(`/api/orders/${id}`)
                .then(({ data }) => (this.orders = data))
                .catch(error => console.log(error))
        },
        getOrderDetails() {
            let id = this.$route.params.id
            axios.get(`/api/orders/${id}/details`)
                .then(({ data }) => (this.details = data))
                .catch(error => console.log(error))
        }
    }
}

</script>


<style type="text/css">#em_photo {
    height: 40px;
    width: 40px;
}</style>