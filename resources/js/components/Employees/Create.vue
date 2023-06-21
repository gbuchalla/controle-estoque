<template>
    <div>

        <div class="row">
            <router-link to="/employees" class="btn btn-primary">Lista de funcionários</router-link>

        </div>



        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Adicionar funcionário</h1>
                                    </div>

                                    <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Nome completo" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }}
                                                    </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Endereço de email" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Endereço residencial" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0]
                                                    }} </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Salário" v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }}
                                                    </small>
                                                </div>

                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Data de entrada na empresa"
                                                        v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date"> {{
                                                        errors.joining_date[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="RG" v-model="form.rg">
                                                    <small class="text-danger" v-if="errors.rg"> {{ errors.rg[0] }} </small>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                        placeholder="Telefone - Ex: (90)99999-9999" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }}
                                                    </small>
                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        @change="onFileSelected">

                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }}
                                                    </small>
                                                    <label class="custom-file-label" for="customFile">Escolha a
                                                        imagem</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <img :src="form.photo" style="height: 40px; width: 40px;">
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
</div></template>



<script type="text/javascript">
  
  export default {
    created(){
        if (!User.loggedIn()) {
            this.$router.push({name: 'login'})
        }
    },

    data(){
        return {
            form:{
                name: null,
                email: null,
                phone: null,
                salary: null,
                address: null,
                photo: null,
                rg: null,
                joining_date: null
            },
            errors:{}
        }
    },

    methods: {
        onFileSelected(event){
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result
                };
                reader.readAsDataURL(file);
            }
        },
        employeeInsert() {
            axios.post('/api/employees',this.form)
            .then(() => {
                    this.$router.push({ name: 'employees'})
                    Notification.success()
            })
            .catch(error =>this.errors = error.response.data.errors)
        },
} 


  }
   
</script>


<style type="text/css">
  
</style>