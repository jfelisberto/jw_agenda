<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Agenda de contatos
                            <button type="button" class="btn btn-primary btn-sm float-end openModal" data-title="Criar Contato" data-modal="modalForm" @click="newContact"><i class="fas fa-user-plus"></i></button>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table id="tblData" class="table ">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Celular</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id="listContent">
                                <tr v-for="contact in contacts" :key="contact.id" v-bind:id="contact.id">
                                    <td>{{ contact.name }}</td>
                                    <td>{{ contact.mobile }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm openModal" v-bind:data-id="contact.id" data-title="Editar Contato" data-modal="modalForm" title="Atualizar registro" @click="editContact(contact.id)"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" v-bind:data-id="contact.id" title="Excluir registro" @click="deleteContact(contact.id, contact.name)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalForm" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modalTitle" class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" data-id="formContact" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formContact" class="form">
                            <input type="hidden" id="item_id" name="item_id" v-model="id" />
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
                            <div class="row">&nbsp;</div>
                            <div class="tab-content" id="fomrTabContent">
                                <div class="form-group mb-3 tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="name">Nome</label>
                                            <input type="text" id="name" name="name" v-model="name" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" id="email" name="email" v-model="email" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="mobile">Celular</label>
                                            <input type="text" id="mobile" name="mobile" v-model="mobile" class="form-control cellphoneMask" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="phone">Telefone</label>
                                            <input type="text" id="phone" name="phone" v-model="phone" class="form-control phoneMask" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_cnpj">CNPJ</label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="adrcmp_cnpj" name="cnpj" v-model="cnpj" class="form-control cnpjMask" />
                                                <span class="input-group-text" id="basic-addon2" zip-prefix="adrcmp_" zip-control="" title="Buscar dados do CNPJ" @click="getCNPJ('adrcmp_','')"><i class="fas fa-search fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_company">Empresa</label>
                                            <input type="text" id="adrcmp_company" name="company" v-model="company" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 tab-pane fade" id="adrContact" role="tabpanel" aria-labelledby="adrContact-tab">
                                    <input type="hidden" id="adrctt_contact_id" name="adrctt_contact_id" v-model="adrctt_contact_id" />
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_zipcode">CEP</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" id="adrctt_ibge" name="adrctt_ibge" v-model="adrctt_ibge" />
                                                <input type="hidden" id="adrctt_siafi" name="adrctt_siafi" v-model="adrctt_siafi" />
                                                <input type="text" id="adrctt_zipcode" name="adrctt_zipcode" v-model="adrctt_zipcode" class="form-control cepMask" />
                                                <span class="input-group-text" id="basic-addon2" zip-prefix="adrctt_" zip-control="" title="Buscar CEP" @click="getCEP('adrctt_','')"><i class="fas fa-search fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_public_place">Tipo de logradouro</label>
                                            <input type="text" id="adrctt_public_place" name="adrctt_public_place" v-model="adrctt_public_place" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <label class="form-label" for="adrctt_address">Logradouro</label>
                                            <input type="text" id="adrctt_address" name="adrctt_address" v-model="adrctt_address" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label class="form-label" for="adrctt_number">Número</label>
                                            <input type="text" id="adrctt_number" name="adrctt_number" v-model="adrctt_number" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label class="form-label" for="adrctt_complement">Complemento</label>
                                            <input type="text" id="adrctt_complement" name="adrctt_complement" v-model="adrctt_complement" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_district">Bairro</label>
                                            <input type="text" id="adrctt_district" name="adrctt_district" v-model="adrctt_district" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_city">Cidade</label>
                                            <input type="text" id="adrctt_city" name="adrctt_city" v-model="adrctt_city" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_state">Estado</label>
                                            <input type="text" id="adrctt_state" name="adrctt_state" v-model="adrctt_state" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrctt_country">País</label>
                                            <input type="text" id="adrctt_country" name="adrctt_country" v-model="adrctt_country" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 tab-pane fade" id="adrCompany" role="tabpanel" aria-labelledby="adrCompany-tab">
                                    <input type="hidden" id="adrcmp_contact_id" name="adrcmp_contact_id" v-model="adrcmp_contact_id" />
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_zipcode">CEP</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" id="adrcmp_ibge" name="adrcmp_ibge" v-model="adrcmp_ibge" />
                                                <input type="hidden" id="adrcmp_siafi" name="adrcmp_siafi" v-model="adrcmp_siafi" />
                                                <input type="text" id="adrcmp_zipcode" name="adrcmp_zipcode" v-model="adrcmp_zipcode" class="form-control cepMask" />
                                                <span class="input-group-text" id="basic-addon2" zip-prefix="adrcmp_" zip-control="" title="Buscar CEP" @click="getCEP('adrcmp_','')"><i class="fas fa-search fa-fw"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_public_place">Tipo de logradouro</label>
                                            <input type="text" id="adrcmp_public_place" name="adrcmp_public_place" v-model="adrcmp_public_place" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <label class="form-label" for="adrcmp_address">Logradouro</label>
                                            <input type="text" id="adrcmp_address" name="adrcmp_address" v-model="adrcmp_address" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label class="form-label" for="adrcmp_number">Número</label>
                                            <input type="text" id="adrcmp_number" name="adrcmp_number" v-model="adrcmp_number" class="form-control" />
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <label class="form-label" for="adrcmp_complement">Complemento</label>
                                            <input type="text" id="adrcmp_complement" name="adrcmp_complement" v-model="adrcmp_complement" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_district">Bairro</label>
                                            <input type="text" id="adrcmp_district" name="adrcmp_district" v-model="adrcmp_district" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_city">Cidade</label>
                                            <input type="text" id="adrcmp_city" name="adrcmp_city" v-model="adrcmp_city" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_state">Estado</label>
                                            <input type="text" id="adrcmp_state" name="adrcmp_state" v-model="adrcmp_state" class="form-control" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label" for="adrcmp_country">País</label>
                                            <input type="text" id="adrcmp_country" name="adrcmp_country" v-model="adrcmp_country" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm modal-close" data-bs-dismiss="modal" data-id="formContact"><i class="fas fa-ban"></i> Cancelar</button>
                        <button type="button" id="saveData" class="btn btn-primary btn-sm hidden" @click="addContact"><i class="fas fa-save"></i> Salvar</button>
                        <button type="button" id="editData" class="btn btn-primary btn-sm hidden" @click="updContact"><i class="fas fa-save"></i> Atualizar</button>
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
                adrctt_ibge: '',
                adrctt_siafi: '',
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
                adrcmp_ibge: '',
                adrcmp_siafi: '',
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
            this.getContacts()
        },
        methods: {
            newContact() {
                this.name = ''
                this.email = ''
                this.mobile = ''
                this.phone = ''
                this.cnpj = ''
                this.company = ''
                this.adrctt_address_id = ''
                this.adrctt_contact_id = ''
                this.adrctt_type = 'contact',
                this.adrctt_ibge = ''
                this.adrctt_siafi = ''
                this.adrctt_zipcode = ''
                this.adrctt_public_place = ''
                this.adrctt_address = ''
                this.adrctt_number = ''
                this.adrctt_complement = ''
                this.adrctt_district = ''
                this.adrctt_city = ''
                this.adrctt_state = ''
                this.adrctt_country = 'Brasil'
                this.adrcmp_address_id = ''
                this.adrcmp_contact_id = ''
                this.adrcmp_type = 'company',
                this.adrcmp_ibge = ''
                this.adrcmp_siafi = ''
                this.adrcmp_zipcode = ''
                this.adrcmp_public_place = ''
                this.adrcmp_address = ''
                this.adrcmp_number = ''
                this.adrcmp_complement = ''
                this.adrcmp_district = ''
                this.adrcmp_city = ''
                this.adrcmp_state = ''
                this.adrcmp_country = 'Brasil'

                $('#editData').addClass('hidden')
                $('#saveData').removeClass('hidden')
                $('#formTab .nav-link').removeClass('active')
                $('#formTab #contact-tab').addClass('active')
                $('#fomrTabContent .tab-pane').removeClass('show').removeClass('active')
                $("#fomrTabContent #contact").addClass('show').addClass('active')
            },
            addContact() {
                var data = {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    phone: this.phone,
                    cnpj: this.cnpj,
                    company: this.company,
                    address: [
                        {
                            contact_id: '',
                            user_id: '',
                            type: 'contact',
                            ibge: this.adrctt_ibge,
                            siafi: this.adrctt_siafi,
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
                            contact_id: '',
                            user_id: '',
                            type: 'company',
                            ibge: this.adrcmp_ibge,
                            siafi: this.adrcmp_siafi,
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
                    sa(response.data.status, '', response.data.message, 1500)
                    if (response.data.status === 'success') {
                        this.$http.get('/api/contact').then((response)=>{
                            this.contacts = response.data.data;
                        });
                        closeModal('formContact')
                    }
                })
            },
            editContact(id) {
                this.$http.get('/api/contact/'+id+'/edit').then((response)=>{
                    sa(response.data.status, '', response.data.message, 1500)
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
                            this.adrctt_ibge = response.data.data.address[0].ibge
                            this.adrctt_siafi = response.data.data.address[0].siafi
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
                            this.adrctt_ibge = ''
                            this.adrctt_siafi = ''
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
                            this.adrcmp_ibge = response.data.data.address[1].ibge
                            this.adrcmp_siafi = response.data.data.address[1].siafi
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
                            this.adrcmp_ibge = ''
                            this.adrcmp_siafi = ''
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
                        $('#saveData').addClass('hidden')
                        $('#editData').removeClass('hidden')
                        $('#formTab .nav-link').removeClass('active')
                        $('#formTab #contact-tab').addClass('active')
                        $('#fomrTabContent .tab-pane').removeClass('show').removeClass('active')
                        $("#fomrTabContent #contact").addClass('show').addClass('active')
                    }
                })
            },
            getContacts() {
                this.$http.get('/api/contact').then((response)=>{
                    this.contacts = response.data.data;
                });
            },
            updContact() {
                var data = {
                    name: this.name,
                    email: this.email,
                    mobile: this.mobile,
                    phone: this.phone,
                    cnpj: this.cnpj,
                    company: this.company,
                    address: [
                        {
                            id: this.adrctt_address_id,
                            contact_id: this.adrctt_contact_id,
                            user_id: '',
                            type: 'contact',
                            siafi: this.adrctt_siafi,
                            ibge: this.adrctt_ibge,
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
                            contact_id: this.adrcmp_contact_id,
                            user_id: '',
                            type: 'company',
                            zipcode: this.adrcmp_zipcode,
                            siafi: this.adrcmp_siafi,
                            ibge: this.adrcmp_ibge,
                            public_place: this.adrcmp_public_place,
                            address: this.adrcmp_address,
                            number: this.adrcmp_number,
                            complement: this.adrcmp_complement,
                            district: this.adrcmp_district,
                            city: this.adrcmp_city,
                            state: this.adrcmp_state,
                            country: this.adrcmp_country
                        }
                    ]
                }

                this.$http.put('/api/contact/'+this.id,data).then((response)=>{
                    sa(response.data.status, '', response.data.message, 1500)
                    if (response.data.status === 'success') {
                        this.$http.get('/api/contact').then((response)=>{
                            this.contacts = response.data.data;
                        });
                        closeModal('formEditContact')
                    }
                })
            },
            deleteContact(id, name) {
                const swalBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success btn-js',
                        cancelButton: 'btn btn-danger btn-js'
                    },
                    buttonsStyling: false,
                });
                var http = this.$http
                swalBootstrapButtons.fire({
                    'title': 'Cuidado',
                    'html': 'Tem certeza de que deseja excluir o contato<br /><b>' + name + '</b>',
                    'type': 'warning',
                    'showCancelButton': true,
                    'confirmButtonText': 'OK',
                    'cancelButtonText': 'Cancelar',
                    'reverseButtons': false
                }).then(function (result) {
                    if (result.value) {
                        http.delete('/api/contact/'+id).then((response)=>{
                            sa(response.data.status, '', response.data.message, 1500)
                            setTimeout(()=> {
                                document.location.reload(true);
                                //this.getContacts
                            }, 500)
                            //this.getContacts()
                        })
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        return false;
                    }
                });
            },
            getCEP(zipPrefix, zipControl) {
                var data = {
                    zipcode: '',
                    zipPrefix: zipPrefix,
                    zipControl: zipControl,
                }
                if (zipPrefix === 'adrctt_') {
                    data.zipcode = this.adrctt_zipcode
                } else {
                    data.zipcode = this.adrcmp_zipcode
                }

                this.$http.post('/api/search/getCEP',data).then((response)=>{
                    sa(response.data.status, '', response.data.message, 1500)
                    if (response.data.status === 'success') {
                        if (zipPrefix === 'adrctt_') {
                            this.adrctt_ibge = response.data.data.ibge
                            this.adrctt_siafi = response.data.data.siafi
                            this.adrctt_public_place = response.data.data.public_place
                            this.adrctt_address = response.data.data.address
                            this.adrctt_district = response.data.data.district
                            this.adrctt_city = response.data.data.city
                            this.adrctt_state = response.data.data.state
                            this.adrctt_country = 'Brasil'
                        } else {
                            this.adrcmp_ibge = response.data.data.ibge
                            this.adrcmp_siafi = response.data.data.siafi
                            this.adrcmp_public_place = response.data.data.public_place
                            this.adrcmp_address = response.data.data.address
                            this.adrcmp_district = response.data.data.district
                            this.adrcmp_city = response.data.data.city
                            this.adrcmp_state = response.data.data.state
                            this.adrcmp_country = 'Brasil'
                        }
                    }
                })
            },
            getCNPJ(zipPrefix, zipControl) {
                var data = {
                    cnpj: this.cnpj,
                    zipPrefix: zipPrefix,
                    zipControl: zipControl,
                }
                this.$http.post('/api/search/getCNPJ',data).then((response)=>{
                    sa(response.data.status, '', response.data.message, 1500)
                    if (response.data.status === 'success') {
                        this.company = response.data.data.nome_fantasia

                        if (response.data.data.cep) {
                            data.zipcode = response.data.data.cep

                            this.$http.post('/api/search/getCEP',data).then((response)=>{
                                sa(response.data.status, '', response.data.message, 1500)
                                if (response.data.status === 'success') {
                                    this.adrcmp_ibge = response.data.data.ibge
                                    this.adrcmp_siafi = response.data.data.siafi
                                    this.adrcmp_zipcode = data.zipcode
                                    this.adrcmp_public_place = response.data.data.public_place
                                    this.adrcmp_address = response.data.data.address
                                    this.adrcmp_district = response.data.data.district
                                    this.adrcmp_city = response.data.data.city
                                    this.adrcmp_state = response.data.data.state
                                    this.adrcmp_country = 'Brasil'
                                }
                            })
                        }
                    }
                })
            }
        }
    }
</script>
