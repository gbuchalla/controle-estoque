<template>
  <div>
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
          <i class="fas fa-cash-register mr-2 title-icon"></i>
          <span> Caixa para registro de ordens</span>
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><router-link :to="{name: 'home'}">Início</router-link></li>
          <li class="breadcrumb-item active" aria-current="page">Caixa</li>
        </ol>
      </div>

      <div class="row mb-3">
        <div class="col-xl-5 col-lg-5">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

              <!-- TODO: COLOCAR UM ROUTER-LINK P/ EXPENSES-CREATE E UM P/ CUSTOMERS-CREATE -->
              <router-link :to="{ name: 'expenses-create'}" class="m-0 font-weight-bold text-primary">Inserir despesa</router-link> 
              <router-link :to="{name: 'customers-create'}" class="btn btn-sm btn-info">
                <font color="#ffffff">Adicionar cliente</font>
              </router-link>
            </div>
            <div class="table-responsive" style="font-size: 12px;">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Unidade</th>
                    <th>Total</th>
                    <th class="pr-3">Ação</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="cart in carts" :key="cart.id">
                    <td>{{ cart.product_name }}</td>
                    <td>
                      <input type="text" readonly="" style="width: 15px;" :value="cart.product_quantity">
                      <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success table-tbn ">+</button>
                      <button @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger table-tbn "
                        v-if="cart.product_quantity >= 2">-</button>
                      <button class="btn btn-sm btn-danger table-tbn " v-else="" disabled="">-</button>
                    </td>
                    <td>{{ cart.product_price }}</td>
                    <td>{{ cart.sub_total }}</td>
                    <td class="pr-3">
                      <a @click="removeItem(cart.id)" class="btn btn-sm btn-primary table-tbn ">
                        <font color="#ffffff">x</font>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="card-footer">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">Quantidade total de produtos:
                  <strong>{{ quantity }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">Subtotal:
                  <strong>R$ {{ subtotal }}</strong>
                </li>

                <li v-if="extraInfo.tax" class="list-group-item d-flex justify-content-between align-items-center">Taxa de imposto:
                  <strong>{{ extraInfo.tax }} %</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">Total:
                  <strong>R$ {{ total }}</strong>
                </li>
              </ul>
              <br>

              <form @submit.prevent="storeOrder">
                <label>Nome do cliente</label>
                <select class="form-control" v-model="customer_id">
                  <option :value="customer.id" v-for="customer in customers">{{ customer.name }}</option>
                </select>

                <label>Valor pago (R$)</label>
                <input type="text" class="form-control" required v-model="pay">

                <label>Saldo devedor (R$)</label>
                <input type="text" class="form-control" required v-model="due">

                <label>Método de pagamento</label>
                <select class="form-control" v-model="payment_method">
                  <option value="Dinheiro">Dinheiro</option>
                  <option value="Débito">Cartão - Débito</option>
                  <option value="Crédito">Cartão - Crédito</option>
                  <option value="Pix">Pix</option>
                </select>

                <br>
                <button type="submit" class="btn btn-success">Registrar Ordem</button>
              </form>

            </div>
          </div>
        </div>

        <div class="col-xl-7 col-lg-7">
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Produtos vendidos</h6>
            </div>

            <!-- Start list of products -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                  aria-selected="true">Todos produtos</a>
              </li>
              <li class="nav-item" v-for="category in categories" :key="category.id">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                  aria-selected="false" @click="getSubproducts(category.id)">{{ category.category_name }}</a>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card-body">
                  <input type="text" v-model="productSearchTerm" class="form-control" style="width: 300px;"
                    placeholder="Pesquisar produto">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in productsFilterSearch"
                      :key="product.id">
                      <button class="btn btn-sm" @click.prevent="addToCart(product.id)">
                        <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                          <img :src="product.image" id="em_photo" class="card-img-top">
                          <div class="card-body">
                            <h6 class="card-title">{{ product.product_name }}</h6>
                            <span class="badge badge-success" v-if="product.product_quantity >= 1">Disponível: {{
                              product.product_quantity }} </span>
                            <span class="badge badge-danger" v-else=" ">Sem estoque</span>
                          </div>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <input type="text" v-model="subproductSearchTerm" class="form-control" style="width: 300px;"
                  placeholder="Procurar produto da categoria">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="subproduct in subproductsFilterSearch"
                    :key="subproduct.id">
                    <button class="btn btn-sm" @click.prevent="addToCart(subproduct.id)">
                      <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                        <img :src="subproduct.image" id="em_photo" class="card-img-top">
                        <div class="card-body">
                          <h6 class="card-title">{{ subproduct.product_name }}</h6>
                          <span class="badge badge-success" v-if="subproduct.product_quantity >= 1">Disponível: {{
                            subproduct.product_quantity }} </span>
                          <span class="badge badge-danger" v-else=" ">Sem estoque</span>
                        </div>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End category subproducts -->
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
      this.$router.push({ name: 'login' });
    };
    this.getProducts();
    this.getCategories();
    this.getCustomers();
    this.getCartProducts();
    this.getExtraInfo();
    Reload.$on('AfterAdd', () => {
      this.getCartProducts();
    });
  },

  data() {
    return {
      customer_id: '',
      pay: '',
      due: '',
      payment_method: '',

      products: [],
      categories: '',
      subproducts: [],
      productSearchTerm: '',
      subproductSearchTerm: '',
      customers: '',
      errors: '',
      carts: [],
      extraInfo: ''
    }
  },

  computed: {
    productsFilterSearch() {
      return this.products.filter(product => {
        return product.product_name.match(this.productSearchTerm);
      })
    },

    subproductsFilterSearch() {
      return this.subproducts.filter(subproduct => {
        return subproduct.product_name.match(this.subproductSearchTerm);
      })
    },

    quantity() {
      let quantity = 0;
      for (let i = 0; i < this.carts.length; i++) {
        quantity += (parseInt(this.carts[i].product_quantity));
      }
      return quantity;
    },

    subtotal() {
      let subtotal = 0;
      for (let i = 0; i < this.carts.length; i++) {
        subtotal += (parseInt(this.carts[i].product_quantity) * parseFloat(this.carts[i].product_price));
      }
      return subtotal;
    },

    total() {
      let total
      if (this.extraInfo.tax) {
        total = this.subtotal * (extraInfo.tax / 100) + subtotal;
      } else {
        total = this.subtotal;
      }
      return total;
    }
  },

  methods: {

    // Start cart methods
    addToCart(product_id) {
      axios.post(`/api/cart/${product_id}`)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.cart_success();
        })
        .catch(err => console.log(err));
    },

    getCartProducts() {
      axios.get('/api/cart/products')
        .then(({ data }) => (this.carts = data))
        .catch();
    },

    removeItem(id) {
      axios.delete(`/api/cart/${id}`)
        .then(() => {
          Reload.$emit('AfterAdd');
          Notification.cart_delete();
        })
        .catch(err => console.log(err));
    },

    increment(id) {
      axios.patch(`/api/cart/products/${id}/increment`)
        .then(() => {
          Reload.$emit('AfterAdd');
          // Notification.success();
        })
        .catch(err => console.log(err));
    },

    decrement(id) {
      axios.patch(`/api/cart/products/${id}/decrement`)
        .then(() => {
          Reload.$emit('AfterAdd');
          // Notification.success();
        })
        .catch(err => console.log(err));
    },

    getExtraInfo() {
      axios.get('/api/extra')
        .then(({ data }) => (this.extraInfo = data))
        .catch(err => console.log(err));
    },

    storeOrder() {
      let data = { quantity: this.quantity, sub_total: this.subtotal, customer_id: this.customer_id, payment_method: this.payment_method, pay: this.pay, due: this.due, tax: this.extraInfo.tax, total: this.total }

      axios.post('/api/orders', data)
        .then(() => {
          Notification.success();
          this.$router.push({ name: 'home' });
        });
    },
    // End cart methods 

    // Start methods to fetch resources
    getProducts() {
      axios.get('/api/products/')
        .then(({ data }) => (this.products = data))
        .catch();
    },

    getCategories() {
      axios.get('/api/categories/')
        .then(({ data }) => (this.categories = data))
        .catch();
    },

    getCustomers() {
      axios.get('/api/customers/')
        .then(({ data }) => (this.customers = data))
        .catch();
    },
    
    getSubproducts(category_id) {
      axios.get(`/api/products/categories/${category_id}`)
        .then(({ data }) => {
          return this.subproducts = data;
        })
        .catch();
    }
    // End methods to fetch resources
  }
}

</script>


<style type="text/css" scoped>
#em_photo {
  height: 100px;
  width: 135px;
}
.table-tbn {
  line-height: 1;
  width:16px;
  text-align: center;
  padding-inline: 2px;
}
</style>