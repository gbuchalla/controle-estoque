<template>
  <div>
    <div class="row">
      <router-link :to="{name: 'orders-today'}" class="btn btn-primary">Ordens do dia</router-link>
    </div>

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Pesquisar ordem pela data de emissão</h1>
                  </div>

                  <form class="user" @submit.prevent="searchDate">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <label for="inputDate"><b>Selecionar data da ordem</b></label>
                          <input type="date" class="form-control" id="inputDate" required="" v-model="date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>
                    </div>
                  </form>

                  <hr>

                  <div class="text-center"></div>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Ordens</h6>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light text-center">
                    <tr>
                      <th>Nome do produto</th>
                      <th>Quantidade</th>
                      <th>SubTotal</th>
                      <th v-if="hasOrderWithTax()">Taxa de imposto</th>
                      <th>Valor total</th>
                      <th>Valor pago</th>
                      <th>Saldo devedor</th>
                    </tr>
                  </thead>

                  <tbody class="text-center">
                    <tr v-for="order in orders">
                      <td>{{ order.name }}</td>
                      <td>{{ order.quantity }}</td>
                      <td>{{ order.sub_total }}</td>
                      <td v-if="order.tax">{{ order.tax }}</td>
                      <td>R$ {{ order.total }} </td>
                      <td>R$ {{ order.pay }} </td>
                      <td>R$ {{ order.due }} </td>
                    </tr>
                  </tbody>
                </table>

              </div>
              <div class="card-footer"></div>
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
    }
  },

  data() {
    return {
      date: '',
      orders: []
    }
  },

  methods: {
    searchDate() {
      const form_data = { date: this.date }
      axios.post('/api/orders/search/', form_data)
        .then(({ data }) => (this.orders = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    hasOrderWithTax() {
      this.orders.forEach(order => {
        if (order.tax) return true;
        return false;
      });
    }
  }
}

</script>


<style type="text/css"></style>