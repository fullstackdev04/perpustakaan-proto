<template>
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0" v-if="this.users.id">Update Data Anggota</h3>
                    <h3 class="mb-0" v-else>Tambah Data Anggota</h3>
                </div>
                <div class="col-4 text-right">
                    <a :href="this.index" class="btn btn-sm btn-primary">Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form @submit.prevent="simpan">
                <h6 v-if="this.users.id" class="heading-small text-muted mb-4">{{ form.name | capitalize }}</h6>
                <h6 v-else class="heading-small text-muted mb-4">Anggota Information</h6>

                <template class="text-center" v-if="this.users.id">
                    <div class="form-group">
                        <img class="img-thumbnail mx-auto d-block rounded-circle"
                            :src="'../../../../storage/preview/'+form.image" alt="profil">
                    </div>
                </template>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="id">ID Anggota</label>
                                <input v-if="this.users.id" :disabled="true" autocomplete="off" type="text"
                                    v-model="form.id" id="id" class="form-control form-control-alternative" name="id"
                                    placeholder="ID Anggota">
                                <input v-else autocomplete="off" type="text" v-model="form.id" id="id"
                                    class="form-control form-control-alternative" name="id" placeholder="ID Anggota">
                                <template v-if="err.id">
                                    <span class="text-danger">{{ err.id[0] }}</span>
                                </template>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nama Anggota</label>
                                <input autocomplete="off" type="text" v-model="form.name" id="name"
                                    class="form-control form-control-alternative" name="name"
                                    placeholder="Nama Anggota">
                                <template v-if="err.name">
                                    <span class="text-danger">{{ err.name[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="tipe_anggota_id">Tipe Anggota</label>
                                <multiselect v-model="value" tag-placeholder="Add this as new tag"
                                    placeholder="Pilih tipe anggota" label="tipe_anggota" track-by="tipe_anggota"
                                    :options="options"></multiselect>
                                <template v-if="err.tipe_anggota_id">
                                    <span class="text-danger">{{ err.tipe_anggota_id[0] }}</span>
                                </template>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="tgl_lahir">Tanggal Lahir</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input autocomplete="off" class="form-control datepicker" v-model="form.tgl_lahir"
                                        placeholder="Pilih tanggal lahir" type="text">
                                </div>

                                 <template v-if="err.tgl_lahir">
                                    <span class="text-danger">{{ err.tgl_lahir[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="jk">Jenis Kelamin</label>
                                <multiselect v-model="form.jk" :options="jkelamin" :searchable="false"
                                    :close-on-select="false" :show-labels="false" placeholder="Pilih jenis kelamin">
                                </multiselect>
                                <template v-if="err.jk">
                                    <span class="text-danger">{{ err.jk[0] }}</span>
                                </template>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="no_telp">No Telp</label>
                                <input autocomplete="off" type="text" v-model="form.no_telp" id="no_telp"
                                    class="form-control form-control-alternative" name="no_telp"
                                    placeholder="Number Telp">
                                <template v-if="err.no_telp">
                                    <span class="text-danger">{{ err.no_telp[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Email</label>
                                <input autocomplete="off" type="email" v-model="form.email" id="email"
                                    class="form-control form-control-alternative" name="email" placeholder="Email">
                                <template v-if="err.email">
                                    <span class="text-danger">{{ err.email[0] }}</span>
                                </template>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="jurusan">Jurusan</label>
                                <input autocomplete="off" type="text" v-model="form.jurusan" id="jurusan"
                                    class="form-control form-control-alternative" name="jurusan" placeholder="Email">
                                <template v-if="err.jurusan">
                                    <span class="text-danger">{{ err.jurusan[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="alamat">Alamat</label>
                                <textarea rows="5" type="text" v-model="form.alamat" id="alamat"
                                    class="form-control form-control-alternative" name="alamat"
                                    placeholder="Alamat"></textarea>
                                <template v-if="err.alamat">
                                    <span class="text-danger">{{ err.alamat[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password">Password</label>
                                <input autocomplete="off" type="password" v-model="form.password" id="password"
                                    class="form-control form-control-alternative" name="password"
                                    placeholder="***********">
                                <template v-if="err.password">
                                    <span class="text-danger">{{ err.password[0] }}</span>
                                </template>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password_confirmation">Password
                                    Confirmation</label>
                                <input autocomplete="off" type="password" v-model="form.password_confirmation"
                                    id="password_confirmation" class="form-control form-control-alternative"
                                    password_confirmation="password_confirmation" placeholder="***********">
                            </div>
                        </div>
                    </div>

                    <input autocomplete="off" type="hidden" v-model="tipe_anggota">
                    <input autocomplete="off" type="hidden" v-model="tipe_ang">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="catatan">Upload Foto Anggota</label>
                                <div class="custom-file">
                                    <input type="file" v-on:change="onImageChange" class="custom-file-input"
                                        id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">{{ img }}</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    <!-- <span class="text-danger mt-2">{{ img }}</span> -->
                                </div>
                                <template v-if="err.catatan">
                                    <span class="text-danger">{{ err.catatan[0] }}</span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right">

                    <template v-if="loading">
                        <spinner-component></spinner-component>
                    </template>
                    <template v-else>
                        <template v-if="this.users.id">
                            <button :disabled="isDisabled" class="btn btn-success">
                                Perbarui</button>
                        </template>
                        <template v-else>
                            <button :disabled="isDisabled" class="btn btn-success">
                                Tambah</button>
                        </template>
                    </template>

                    <input autocomplete="off" type="hidden" :value="jk">
                    <input autocomplete="off" type="hidden" :value="profil">
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import Spinner from '../tools/Spanner';
    import Multiselect from 'vue-multiselect';
    export default {

        components: {
            SpinnerComponent: Spinner,
            Multiselect
        },

        props: [
            'index',
            'fetch',
            'tipe',
            'users'
        ],

        computed: {
            isDisabled() {
                return (this.form.name.length == '' ? true : false)
            },

            tipe_anggota() {
                return this.form.tipe_anggota_id = this.value.id
            },

            tipe_ang() {
                return this.form.tipe = this.value.masa_berlaku_anggota
            },

            jk() {
                return this.form.jk = (this.fetch.jk == 0 ? 'Pria' : 'Wanita')
            },

            profil() {
                this.form.foto = this.fetch.foto;
                this.form.old = this.fetch.foto;
                return this.form.image = this.fetch.foto;
            },

            // executeLoader()
            // {
            //     return 'halo'
            // }
        },

        data() {
            return {

                value: (this.users.id ? this.fetch.anggota_transaksi.tipe_anggota : ''),
                jkelamin: ['Pria', 'Wanita'],
                options: [],
                img: this.fetch.foto || 'Pilih Foto Anggota',


                form: {
                    id: this.users.id || '',
                    name: this.users.name || '',
                    email: this.users.email || '',
                    password: '',
                    password_confirmation: this.users.password_confirmation || '',
                    tgl_lahir: this.fetch.tgl_lahir || '',
                    tgl_registrasi: this.fetch.tgl_registrasi || '',
                    tgl_ekspired: this.fetch.tgl_ekspired || '',
                    alamat: this.fetch.alamat || '',
                    jk: this.jk || '',
                    no_telp: this.fetch.no_telp || '',
                    tipe: this.tipe_ang,
                    jurusan: this.fetch.jurusan || '',
                    image: '',
                    foto: '',
                    old: '',
                    tipe_anggota_id: this.fetch.tipe_anggota_id || this.tipe_anggota,
                    _method: (this.users.id ? 'PUT' : 'POST')
                },

                loading: false,

                err: {},
            }
        },

        created() {
            this.getTipe();
        },

        methods: {
            getTipe() {
                return axios.get(this.tipe)
                    .then(res => this.options = res.data.data)
                    .catch(err => console.log(err));
            },

            onImageChange(e) {
                this.img = e.target.files[0].name;
                this.form.foto = e.target.files[0].name;
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            simpan() {
                this.loading = true;

                if (!this.users.id) {
                    // create
                    axios.post(this.fetch, this.form)
                        .then(res => {
                            this.$swal({
                                position: 'top-end',
                                type: 'success',
                                title: res.data.message.toUpperCase(),
                                showConfirmButton: false,
                                timer: 3000
                            });

                            setTimeout(() => {
                                window.location = this.index;
                            }, 3200)
                        })
                        .catch(err => {
                            this.err = err.response.data.errors;
                            this.loading = false;
                        })
                } else {
                    // update
                    axios.post('/pustakawan/anggota/' + this.users.id, this.form)
                        .then(res => {
                            this.$swal({
                                position: 'top-end',
                                type: 'success',
                                title: res.data.message.toUpperCase(),
                                showConfirmButton: false,
                                timer: 2500

                            });
                            setTimeout(() => {
                                window.location = this.index;
                            }, 2800);
                        })
                        .catch(err => {
                            this.err = err.response.data.errors;
                            this.loading = false;
                        })
                }
            },
        }
    }

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
