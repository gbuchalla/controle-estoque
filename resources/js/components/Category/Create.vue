<template>
    <div>
        <div class="row">
            <router-link to="/categories" class="btn btn-primary">Lista de categorias</router-link>

        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Adicionar categorias</h1>
                                    </div>

                                    <form class="user" @submit.prevent="categoryInsert">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="inputName">Nome da categoria</label>
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="" v-model="form.category_name">
                                                    <small class="text-danger" v-if="errors.category_name"> {{
                                                        errors.category_name[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                                        </div>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                    </div>
                                    <div class="text-center">
                                    </div>
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
                category_name: null
            },
            errors: {}
        }
    },
    methods: {
        categoryInsert() {
            axios.post('/api/categories', this.form)
                .then(() => {
                    this.$router.push({ name: 'categories' })
                    Notification.success()
                })
                .catch(error => this.errors = error.response.data.errors)
        },
    }
}
</script>

<style type="text/css"></style>