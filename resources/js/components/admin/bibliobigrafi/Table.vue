<template>
    <div class="row">
        <div class="col-xl-12 mb-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Biliobigraphy</h3>
                        </div>
                        <div class="col text-right">
                            <a :href="this.route" class="btn btn-sm btn-primary">Tambah Biliobigraphy</a>
                        </div>
                    </div>
                </div>
                <template v-if="datas.data.length > 0">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Salinan</th>
                                    <th scope="col">ISBN ISNN</th>
                                    <th scope="col">Perubahan Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in datas.data" :key="data.id">
                                    <th scope="row" style="width: 19%">
                                        <a :href="edit(data.id)" class="btn btn-primary btn-sm">Edit</a>
                                        <button @click="deleted(data.id)" class="btn btn-danger btn-sm">Hapus</button>
                                    </th>
                                    <td>
                                        <div class="row">
                                            <div class="col col-lg-12">
                                                {{ data.judul }}
                                            </div>
                                            <div class="mt-2" v-for="buku_transaksi in data.buku_transaksi"
                                                :key="buku_transaksi.id">
                                                <span
                                                    class="ml-3 badge badge-pill badge-success">{{ buku_transaksi.pengarang.nama_pengarang }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ data.bibliobigrafi_count }}
                                    </td>
                                    <td>
                                        {{ data.isbn_isnn }}
                                    </td>
                                    <td>
                                        {{ data.updated_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </template>

                <template v-else>
                    <h4 class="text-center">Belum Ada Data!</h4>
                </template>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['route', 'fetch', 'index'],
        data() {
            return {
                datas: {},
            }
        },

        methods: {
            edit(val) {
                return `bibliobigrafi/${val}/edit`;
            },

            deleted(val) {
                this.$swal({
                    title: 'Hapus Data?',
                    text: "Jika anda menghapus data ini, data lain kemungkinan besar akan ikut terhapus",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, hapus!'
                }).then((result) => {
                    if (result.value) {
                        axios.post('/pustakawan/bibliobigrafi/' + val, {
                                _method: 'DELETE'
                            })
                            .then(res => {
                                this.$swal({
                                    position: 'top-end',
                                    type: 'success',
                                    title: res.data.message.toUpperCase(),
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                setTimeout(() => {
                                    window.location = this.index;
                                }, 1800);
                            })
                            .catch(err => console.log(err))
                    }
                });
            },

            getResults(page = 1) {
                return axios.get(this.fetch + '?page=' + page)
                    .then(res => this.datas = res.data)
                    .catch(err => console.log(err));
            }
        },

        created() {

            Fire.$on('searching', () => {
                let query = this.$parent.search;
                axios.get('/pustakawan/bibliobigrafi-search?q=' + query)
                    .then(res => {
                        // console.log(res)
                        this.datas = res.data
                    })
                    .catch(err => console.log(err))
            })

            this.getResults();
        },
    }

</script>


<style scoped>
    .table td,
    .table th {
        font-size: 0.8125rem;
        white-space: normal !important;
    }

</style>
