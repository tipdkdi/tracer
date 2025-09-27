<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pemantauan Survei Alumni</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div id="app" class="container py-4">
        <h3 class="mb-4">Pemantauan Survei Alumni</h3>

        <!-- Dropdown Kabupaten -->
        <div class="mb-3">
            <label class="form-label">Pilih Kabupaten/Kota</label>
            <select v-model="selectedKabupaten" @change="loadAlumni" class="form-select">
                <option value="">-- Pilih Kabupaten/Kota --</option>
                <option v-for="kab in daftarKabupaten" :key="kab" :value="kab">{{ kab }}</option>
            </select>
        </div>

        <!-- Tabel Data -->
        <table v-if="alumni.length" class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>TAHUN LULUS</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>PRODI</th>
                    <th>KABUPATEN</th>
                    <th>HP</th>
                    <th>STATUS SURVEI</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="a in alumni" :key="a.id">
                    <td>{{ a.tahun_lulus }}</td>
                    <td>{{ a.nim }}</td>
                    <td>{{ a.nama }}</td>
                    <td>{{ a.prodi }}</td>
                    <td>{{ a.kabupaten_mhs }}</td>
                    <td>{{ a.hp }}</td>
                    <td>
                        <span v-if="a.status === 'Selesai'" class="badge bg-success">Selesai</span>
                        <span v-else-if="a.status === 'Sedang Mengisi'" class="badge bg-warning">Sedang Mengisi</span>
                        <span v-else class="badge bg-secondary">Belum Login</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    selectedKabupaten: "",
                    daftarKabupaten: [
                        "KAB. MUNA",
                        "KAB. MUNA BARAT",
                        "KAB. BUTON",
                        "KAB. BUTON UTARA",
                        "KAB. BUTON SELATAN",
                        "KAB. BUTON TENGAH",
                        "KAB. KOLAKA",
                        "KAB. KOLAKA UTARA",
                        "KAB. KOLAKA TIMUR",
                        "KAB. KONAWE",
                        "KAB. KONAWE SELATAN",
                        "KAB. KONAWE UTARA",
                        "KAB. KONAWE KEPULAUAN",
                        "KAB. BOMBANA",
                        "KAB. WAKATOBI",
                        "KAB. KEP. BUTON",
                        "KAB. KEP. MUNA",
                        "KOTA KENDARI",
                        "KOTA BAUBAU"
                    ],
                    alumni: []
                }
            },
            methods: {
                async loadAlumni() {
                    if (!this.selectedKabupaten) {
                        this.alumni = [];
                        return;
                    }

                    try {
                        // Ambil alumni per kabupaten
                        let res = await axios.get(`/api/alumni?kabupaten=${this.selectedKabupaten}`);
                        this.alumni = res.data;

                        // Loop alumni dan cek status
                        for (let i = 0; i < this.alumni.length; i++) {
                            let a = this.alumni[i];
                            let statusRes = await axios.get(`/api/status/${a.nim}/${a.tahun_lulus}`);
                            this.alumni[i].status = statusRes.data.status;
                        }
                    } catch (e) {
                        console.error(e);
                    }
                }
            }
        }).mount("#app");
    </script>
</body>

</html>