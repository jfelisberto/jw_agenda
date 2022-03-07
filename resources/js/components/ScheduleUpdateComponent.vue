<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Agenda de contatos - Atualização</h4>
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
                            </ul>this.contacts.push(data)
                    getList()
                    closeModal('formContact')
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
                                            <label for="this.contacts.push(data)
                    getList()
                    closeModal('formContact')adrctt_address">Logradouro</label>
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
export default {
    data() {
        return {
            contacts: [],
            id: '',
            name: '',
            email: '',
            mobile: '',
            phone: '',
            cnpj: '',
            company: '',
            adrctt_address_id: '',
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
            adrcmp_address_id: '',
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
    create() {
        console.log('Component Start Create.')
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        editContact(id) {
            this.$http.get('/api/contact/'+id+'/edit').then((response)=>{
                sa(response.data.status, '', response.data.message, 1500)
                console.log(response.data)
                if (response.data.status === 'success') {
                    this.id = response.data.data.id
                    this.name = response.data.data.name
                    this.email = response.data.data.email
                    this.mobile = response.data.data.mobile
                    this.phone = response.data.data.phone
                    this.cnpj = response.data.data.cnpj
                    this.company = response.data.data.company
                    if (typeof response.data.data.address[0] !== "undefined") {
                        this.adrctt_address_id = response.data.data.address[0].id
                        this.adrctt_contact_id = response.data.data.address[0].contact_id
                        this.adrctt_type = response.data.data.address[0].type
                        this.adrctt_zipcode = response.data.data.address[0].zipcode
                        this.adrctt_address = response.data.data.address[0].address
                        this.adrctt_public_place = response.data.data.address[0].public_place
                        this.adrctt_number = response.data.data.address[0].number
                        this.adrctt_complement = response.data.data.address[0].complement
                        this.adrctt_district = response.data.data.address[0].district
                        this.adrctt_city = response.data.data.address[0].city
                        this.adrctt_state = response.data.data.address[0].state
                        this.adrctt_country = response.data.data.address[0].country
                    } else {
                        this.adrctt_address_id = ''
                        this.adrctt_contact_id = ''
                        this.adrctt_type = 'contact',
                        this.adrctt_zipcode = ''
                        this.adrctt_public_place = ''
                        this.adrctt_address = ''
                        this.adrctt_number = ''
                        this.adrctt_complement = ''
                        this.adrctt_district = ''
                        this.adrctt_city = ''
                        this.adrctt_state = ''
                        this.adrctt_country = 'Brasil'
                    }
                    if (typeof response.data.data.address[1] !== "undefined") {
                        this.adrcmp_address_id = response.data.data.address[1].id
                        this.adrcmp_contact_id = response.data.data.address[1].contact_id
                        this.adrcmp_type = response.data.data.address[1].type
                        this.adrcmp_zipcode = response.data.data.address[1].zipcode
                        this.adrcmp_public_place = response.data.data.address[1].public_place
                        this.adrcmp_address = response.data.data.address[1].address
                        this.adrcmp_number = response.data.data.address[1].number
                        this.adrcmp_complement = response.data.data.address[1].complement
                        this.adrcmp_district = response.data.data.address[1].district
                        this.adrcmp_city = response.data.data.address[1].city
                        this.adrcmp_state = response.data.data.address[1].state
                        this.adrcmp_country = response.data.data.address[1].country
                    } else {
                        this.adrcmp_address_id = ''
                        this.adrcmp_contact_id = ''
                        this.adrcmp_type = 'company',
                        this.adrcmp_zipcode = ''
                        this.adrcmp_public_place = ''
                        this.adrcmp_address = ''
                        this.adrcmp_number = ''
                        this.adrcmp_complement = ''
                        this.adrcmp_district = ''
                        this.adrcmp_city = ''
                        this.adrcmp_state = ''
                        this.adrcmp_country = 'Brasil'
                    }
                }
            })
            console.log('Editar o Registro')
        },
        updContact() {
            var data = {
                id: this.id,
                name: this.name,
                email: this.email,
                mobile: this.mobile,
                phone: this.phone,
                cnpj: this.cnpj,
                address: [
                    {
                        id: this.adrctt_address_id,
                        contact_id: this.contact_id,
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
                        id: this.adrcmp_address_id,
                        contact_id: this.contact_id,
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

            this.$http.put('/api/contact/'+this.id,data).then((response)=>{
                sa(response.data.status, 'Mensagem', response.data.message, 1500)
                if (response.data.status === 'success') {
                    // retornar para página de listagem
                }
            })
        },
        deleteContact(id) {
            console.log("Deletar Registro")
        }
    }
}
</script>
