<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pemantauan Survei Alumni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <option v-for="kab in daftarKabupaten" :key="kab" :value="kab">@{{ kab }}</option>
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
                    <td>@{{ a.tahun_lulus }}</td>
                    <td>@{{ a.nim }}</td>
                    <td>@{{ a.nama }}</td>
                    <td>@{{ a.prodi }}</td>
                    <td>@{{ a.kabupaten }}</td>

                    <td>
                        <a :href="`https://wa.me/62${a.no_hp.replace(/^0/, '')}?text=${encodeURIComponent(pesanWA(a))}`"
                            target="_blank"
                            class="btn btn-success btn-sm">
                            Chat WA (@{{ a.no_hp }})
                        </a>
                    </td>

                    <td>
                        <!-- Status badge -->
                        <span v-if="a.status === 'Selesai'" class="badge bg-success">Selesai</span>
                        <span v-else-if="a.status === 'Sedang Mengisi'" class="badge bg-warning">Sedang Mengisi</span>
                        <span v-else-if="a.status === null" class="badge bg-light text-muted">Loading...</span>
                        <span v-else class="badge bg-secondary">Belum Mulai</span>
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
                        // Set status awal null supaya tampil "Loading..."
                        this.alumni = res.data.map(a => ({
                            ...a,
                            status: null
                        }));

                        // Ambil status survei tiap alumni (paralel)
                        await Promise.all(
                            this.alumni.map(async (a, i) => {
                                let statusRes = await axios.get(`/api/status/${a.nim}/2025`);
                                this.alumni[i].status = statusRes.data.status;
                            })
                        );

                    } catch (e) {
                        console.error(e);
                    }
                },
                pesanWA(a) {
                    return `_Bismillah_\n\n` +
                        `Tracer Study merupakan alternatif metode yang digunakan oleh Perguruan Tinggi di Indonesia untuk menerima umpan balik dari para alumninya. Umpan balik yang diperoleh dari alumni tersebut digunakan oleh program studi di Perguruan Tinggi sebagai evaluasi untuk pengembangan kualitas dan sistem Pendidikan yang dilaksanakan di perguruan tinggi. Umpan balik ini dapat bermanfaat pula bagi program studi di Perguruan Tinggi untuk memetakan lapangan kerja dan usaha agar sesuai dengan tuntutan dunia kerja.\n\n` +

                        `Sehubungan dengan *pentingnya* hal tersebut, kami mohon kepada alumni atas nama *${a.nama} (NIM ${a.nim}) Prodi ${a.prodi}* untuk meluangkan waktu mengisi tracer study periode tahun 2025 di *salah satu website resmi IAIN Kendari* https://tracerstudy.iainkendari.ac.id/ dengan ketentuan :\n\n` +

                        `Silahkan Login/Masuk dengan menggunakan:\n` +
                        `NIM Anda sewaktu kuliah (${a.nim})\n` +
                        `Dan\n` +
                        `Password : bulan - tanggal - tahun Lahir Anda\n\n` +

                        `Setelah login, pada halaman depan silahkan *pilih tahun pengisian: 2025*\n` +
                        `Kemudian lanjut mengisi data diri Anda, dimulai dengan mengisi:\n` +
                        `1. Tahun Kelulusan\n` +
                        `2. Bulan Kelulusan/Yudisium\n` +
                        `3. Dst.\n\n` +

                        `Tim Tracer IAIN Kendari juga turun langsung ke beberapa kabupaten/kota untuk melakukan Survei, mohon bantuan dan kerjasamanya demi kelancaran pendataan ini.\n\n` +

                        `JIka mengalami kendala dapat menghubungi kami.\n\n` +

                        `Demikian permohonan ini disampaikan. Atas perhatian dan partisipasinya para alumni dalam mengisi kuesioner Tracer Study, diucapkan terima kasih banyak.\n\n` +

                        `Salam hangat,\n*Tim Tracer Study IAIN Kendari*`;
                }
            }
        }).mount("#app");
    </script>
</body>

</html>