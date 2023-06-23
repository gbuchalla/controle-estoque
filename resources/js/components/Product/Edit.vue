  

<template>
    <div>
        <div class="row">
            <router-link to="/products" class="btn btn-primary">Lista de produtos</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Atualizar dados do produto</h1>
                                    </div>

                                    <form class="user" @submit.prevent="ProductUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputName">Nome do produtoe</label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Nome do produto" v-model="form.product_name">
                                                    <small class="text-danger" v-if="errors.product_name"> {{
                                                        errors.product_name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputCode">Código do produto</label>
                                                    <input type="text" class="form-control" id="inputCode"
                                                        placeholder="Código do produto" v-model="form.product_code">
                                                    <small class="text-danger" v-if="errors.product_code"> {{
                                                        errors.product_code[0] }} </small>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputCategory">Categoria do produto</label>
                                                    <select class="form-control" id="inputCategory"
                                                        v-model="form.category_id">
                                                        <option :value="category.id" v-for="category in categories">{{
                                                            category.category_name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputSupplier">Fornecedor do produto</label>
                                                    <select class="form-control" id="inputSupplier"
                                                        v-model="form.supplier_id">
                                                        <option :value="supplier.id" v-for="supplier in suppliers">{{
                                                            supplier.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <label for="inputBuyingPrice">Preço de compra (R$)</label>
                                                    <input type="text" class="form-control" id="inputBuyingPrice"
                                                        v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price"> {{
                                                        errors.buying_price[0] }} </small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="inputSellingPrice">Preço de venda (R$)</label>
                                                    <input type="text" class="form-control" id="inputSellingPrice"
                                                        v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price"> {{
                                                        errors.selling_price[0] }} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputDate">Data de compra</label>
                                                    <input type="date" class="form-control" id="inputDate"
                                                        v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date"> {{
                                                        errors.buying_date[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputQuantity">Quantidade de produto</label>
                                                    <input type="text" class="form-control" id="inputQuantity"
                                                        placeholder="Insira a quantidade do produto"
                                                        v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity"> {{
                                                        errors.product_quantity[0] }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        @change="onFileSelected">

                                                    <small class="text-danger" v-if="errors.image"> {{ errors.image[0] }}
                                                    </small>
                                                    <label class="custom-file-label" for="customFile">Escolha uma
                                                        imagem</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.image" style="height: 40px; width: 40px;">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
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
            form: {
                product_name: '',
                product_code: '',
                category_id: '',
                supplier_id: '',
                image: '',
                newimage: '',
                buying_price: '',
                selling_price: '',
                buying_date: '',
                product_quantity: ''
            },
            errors: {},
            categories: {},
            suppliers: {},
        }
    },
    
    created() {
        let id = this.$route.params.id
        axios.get('/api/products/' + id)
            .then(({ data }) => (this.form = data))
            .catch(console.log('Error'))

        axios.get('/api/categories/')
            .then(({ data }) => (this.categories = data))
            .catch(console.log('Error'))

        axios.get('/api/suppliers/')
            .then(({ data }) => (this.suppliers = data))
            .catch(console.log('Error'))
    },

    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newimage = event.target.result
                };
                reader.readAsDataURL(file);
            }

        },
        ProductUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/products/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'products' })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }


}

</script>


<style type="text/css"></style>