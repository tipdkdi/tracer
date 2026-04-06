<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Alumni Sudah Mengisi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="app" class="container py-4">

        <h3 class="mb-4">Laporan Alumni yang Sudah Mengisi Tracer</h3>

        <div v-if="loading" class="alert alert-info text-center">
            Memuat data...
        </div>

        <div class="table-responsive">
            <table v-if="data.length" class="table table-bordered">
                <thead class="table-dark">
                    <thead class="table-dark">
                        <tr>
                            <th style="width:60px">No</th>
                            <th style="width:150px">NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Kabupaten</th>
                            <th style="width:150px">Tanggal Mengisi</th>
                            <th style="width:160px">Status</th>
                        </tr>
                    </thead>

                </thead>
                <tbody>
                <tbody>
                    <tr v-for="(a, index) in data" :key="a.nim">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ a.nim }}</td>
                        <td>@{{ a.nama }}</td>
                        <td>@{{ a.prodi }}</td>
                        <td>@{{ a.kabupaten }}</td>
                        <td>@{{ formatTanggal(a.tanggal_isi) }}</td>
                        <td>
                            <span v-if="a.status === 'Selesai'" class="badge bg-success">Selesai</span>
                            <span v-else class="badge bg-warning text-dark">Sedang Mengisi</span>
                        </td>
                    </tr>
                </tbody>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    data: [],
                    loading: false
                }
            },
            mounted() {
                this.loadData()
            },
            methods: {
                async loadData() {
                    this.loading = true
                    try {
                        let res = await axios.get('/api/laporan-alumni')
                        this.data = res.data
                    } catch (e) {
                        console.error(e)
                    } finally {
                        this.loading = false
                    }
                },
                formatTanggal(tgl) {
                    if (!tgl) return '-'
                    let d = new Date(tgl)
                    return d.toLocaleDateString('id-ID')
                }
            }
        }).mount('#app')
    </script>

</body>

</html>