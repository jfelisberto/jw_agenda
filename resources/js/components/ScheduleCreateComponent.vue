<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Agenda de contatos - Cadastro</h4>
                    </div>

                    <div class="card-body">
                        <form id="formContact" class="form">
                            <ul class="nav nav-tabs" id="formTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="true">Contato</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" id="adrContact-tab" data-bs-toggle="tab" data-bs-target="#adrContact" role="tab" aria-controls="adrContact" aria-selected="false">Endereço Residencial</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" id="adrCompany-tab" data-bs-toggle="tab" data-bs-target="#adrCompany" role="tab" aria-controls="adrCompany" aria-selected="false">Endereço comercial</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="fomrTabContent">
                                <div class="form-group mb-3 tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="name">Nome</label>
                                            <input type="text" id="name" name="name" v-model="name" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email" v-model="email" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="mobile">Celular</label>
                                            <input type="text" id="mobile" name="mobile" v-model="mobile" class="form-control cellphoneMask" />
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">Telefone</label>
                                            <input type="text" id="phone" name="phone" v-model="phone" class="form-control phoneMask" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="cnpj">CNPJ</label>
                                            <input type="text" id="cnpj" name="cnpj" v-model="cnpj" class="form-control cpfcnpjMask" />
                                        </div>
                                        <div class="col-6">
                                            <label for="company">Empresa</label>
                                            <input type="text" id="company" name="company" v-model="company" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 tab-pane fade" id="adrContact" role="tabpanel" aria-labelledby="adrContact-tab">
                                    <input type="hidden" id="adrctt_contact_id" name="adrctt_contact_id" v-model="adrctt_contact_id" />
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrctt_zipcode">CEP</label>
                                            <input type="text" id="adrctt_zipcode" name="adrctt_zipcode" v-model="adrctt_zipcode" class="form-control cepMask" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrctt_public_place">Tipo de logradouro</label>
                                            <input type="text" id="adrctt_public_place" name="adrctt_public_place" v-model="adrctt_public_place" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <label for="adrctt_address">Logradouro</label>
                                            <input type="text" id="adrctt_address" name="adrctt_address" v-model="adrctt_address" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="adrctt_number">Número</label>
                                            <input type="text" id="adrctt_number" name="adrctt_number" v-model="adrctt_number" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="adrctt_complement">Complemento</label>
                                            <input type="text" id="adrctt_complement" name="adrctt_complement" v-model="adrctt_complement" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrctt_district">Bairro</label>
                                            <input type="text" id="adrctt_district" name="adrctt_district" v-model="adrctt_district" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrctt_city">Cidade</label>
                                            <input type="text" id="adrctt_city" name="adrctt_city" v-model="adrctt_city" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrctt_state">Estado</label>
                                            <input type="text" id="adrctt_state" name="adrctt_state" v-model="adrctt_state" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrctt_country">País</label>
                                            <input type="text" id="adrctt_country" name="adrctt_country" v-model="adrctt_country" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 tab-pane fade" id="adrCompany" role="tabpanel" aria-labelledby="adrCompany-tab">
                                    <input type="hidden" id="adrcmp_contact_id" name="adrcmp_contact_id" v-model="adrcmp_contact_id" />
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrcmp_zipcode">CEP</label>
                                            <input type="text" id="adrcmp_zipcode" name="adrcmp_zipcode" v-model="adrcmp_zipcode" class="form-control cepMask" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrcmp_public_place">Tipo de logradouro</label>
                                            <input type="text" id="adrcmp_public_place" name="adrcmp_public_place" v-model="adrcmp_public_place" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <label for="adrcmp_address">Logradouro</label>
                                            <input type="text" id="adrcmp_address" name="adrcmp_address" v-model="adrcmp_address" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="adrcmp_number">Número</label>
                                            <input type="text" id="adrcmp_number" name="adrcmp_number" v-model="adrcmp_number" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label for="adrcmp_complement">Complemento</label>
                                            <input type="text" id="adrcmp_complement" name="adrcmp_complement" v-model="adrcmp_complement" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrcmp_district">Bairro</label>
                                            <input type="text" id="adrcmp_district" name="adrcmp_district" v-model="adrcmp_district" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrcmp_city">Cidade</label>
                                            <input type="text" id="adrcmp_city" name="adrcmp_city" v-model="adrcmp_city" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="adrcmp_state">Estado</label>
                                            <input type="text" id="adrcmp_state" name="adrcmp_state" v-model="adrcmp_state" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label for="adrcmp_country">País</label>
                                            <input type="text" id="adrcmp_country" name="adrcmp_country" v-model="adrcmp_country" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let http = 'http://jefweb.net/jefweb/jw_agenda/public/api'
    export default {
        data: () => {
            return {
                name: '',
                email: '',
                mobile: '',
                phone: '',
                cnpj: '',
                company: '',
                adrctt_contact_id: '',
                adrctt_type: 'contact',
                adrctt_zipcode: '',
                adrctt_public_place: '',
                adrctt_address: '',
                adrctt_number: '',
                adrctt_complement: '',
                adrctt_district: '',
                adrctt_city: '',
                adrctt_state: '',
                adrctt_country: 'Brasil',
                adrcmp_contact_id: '',
                adrcmp_type: 'company',
                adrcmp_zipcode: '',
                adrcmp_public_place: '',
                adrcmp_address: '',
                adrcmp_number: '',
                adrcmp_complement: '',
                adrcmp_district: '',
                adrcmp_city: '',
                adrcmp_state: '',
                adrcmp_country: 'Brasil'
            }
        },
        methods: {
            addContact() {
                var data = {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    phone: this.phone,
                    cnpj: this.cnpj,
                    address: [
                        {
                            contact_id: this.adrctt_contact_id,
                            user_id: '',
                            type: 'contact',
                            zipcode: this.adrctt_zipcode,
                            public_place: this.adrctt_public_place,
                            address: this.adrctt_address,
                            number: this.adrctt_number,
                            complement: this.adrctt_complement,
                            district: this.adrctt_district,
                            city: this.adrctt_city,
                            state: this.adrctt_state,
                            country: this.adrctt_country,
                        },
                        {
                            contact_id: this.adrcmp_contact_id,
                            user_id: '',
                            type: 'company',
                            zipcode: this.adrcmp_zipcode,
                            public_place: this.adrcmp_public_place,
                            address: this.adrcmp_address,
                            number: this.adrcmp_number,
                            complement: this.adrcmp_complement,
                            district: this.adrcmp_district,
                            city: this.adrcmp_city,
                            state: this.adrcmp_state,
                            country: this.adrcmp_country,
                        }
                    ]
                }

                this.$http.post('/api/contact',data).then((response)=>{
                    sa(response.data.status, 'Mensagem', response.data.message, 1500)
                    if (response.data.status === 'success') {
                        // retorna para listagem
                    }
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
