<template>
    <div>
        <div class="row">
            <router-link to="/customers" class="btn btn-primary">Lista de clientes</router-link>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Atualizar dados de cliente</h1>
                                    </div>

                                    <form class="user" @submit.prevent="customerUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputName">Nome do cliente</label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputEmail">Endereço de email</label>
                                                    <input type="email" class="form-control" id="inputEmail"
                                                        placeholder="" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="inputAddress">Endereço</label>
                                                    <input type="text" class="form-control" id="inputAddress"
                                                        placeholder="" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPhone">Telefone</label>
                                                    <input type="text" class="form-control" id="inputPhone"
                                                        placeholder="" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                                                    <label class="custom-file-label" for="customFile">Escolher imagem</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.photo" style="height: 40px; width: 40px;">
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
        };
        this.getCustomer();
    },

    data() {
        return {
            form: {
                name: '',
                email: '',
                phone: '',
                address: '',
                photo: '',
                newphoto: ''
            },
            errors: {}
        }
    },

    methods: {
        getCustomer() {
            let id = this.$route.params.id
            axios.get('/api/customers/' + id)
                .then(({ data }) => (this.form = data))
                .catch(error => this.errors = error.response.data.errors)
        },

        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.newphoto = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },

        customerUpdate() {
            let id = this.$route.params.id
            axios.patch('/api/customers/' + id, this.form)
                .then(() => {
                    this.$router.push({ name: 'customers' })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }
}
</script>


<style type="text/css"></style>