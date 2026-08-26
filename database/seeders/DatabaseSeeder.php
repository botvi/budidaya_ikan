<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pembudidaya;
use App\Models\JenisIkan;
use App\Models\Kolam;
use App\Models\IkanKolam;
use App\Models\HasilPanen;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for truncation
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // ---- USERS ----
        User::truncate();
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@budidayaikan.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Operator Dinas',
            'email' => 'operator@budidayaikan.id',
            'password' => Hash::make('password'),
            'role' => 'operator',
        ]);

        // ---- PEMBUDIDAYA ----
        Pembudidaya::truncate();
        $pembudidaya = [
            ['nik' => '1409012301850001', 'nama' => 'Ahmad Syukri', 'alamat' => 'Jl. Siak Sri Indrapura No.12, Pekanbaru', 'no_hp' => '08127654321', 'email' => 'ahmad.syukri@gmail.com', 'jenis_kelamin' => 'L', 'tanggal_daftar' => '2022-03-10', 'status' => 'aktif'],
            ['nik' => '1409012508880002', 'nama' => 'Siti Rahayu', 'alamat' => 'Jl. Kubang Raya No.45, Kampar', 'no_hp' => '08234567890', 'email' => 'siti.rahayu@gmail.com', 'jenis_kelamin' => 'P', 'tanggal_daftar' => '2022-05-15', 'status' => 'aktif'],
            ['nik' => '1409013107900003', 'nama' => 'Bambang Sutrisno', 'alamat' => 'Jl. Lintas Sumatra KM 10, Pelalawan', 'no_hp' => '08345678901', 'email' => null, 'jenis_kelamin' => 'L', 'tanggal_daftar' => '2023-01-20', 'status' => 'aktif'],
            ['nik' => '1409010209920004', 'nama' => 'Rini Wulandari', 'alamat' => 'Jl. Bagan Siapi-api No.7, Rokan Hilir', 'no_hp' => '08456789012', 'email' => 'rini.wulandari@yahoo.com', 'jenis_kelamin' => 'P', 'tanggal_daftar' => '2023-06-08', 'status' => 'aktif'],
            ['nik' => '1409011512870005', 'nama' => 'Dedi Kurniawan', 'alamat' => 'Jl. Tembilahan Hulu No.33, Indragiri Hilir', 'no_hp' => '08567890123', 'email' => null, 'jenis_kelamin' => 'L', 'tanggal_daftar' => '2024-02-14', 'status' => 'aktif'],
            ['nik' => '1409010803850006', 'nama' => 'Nursyam Harahap', 'alamat' => 'Jl. Raja Ali Haji No.22, Tanjungpinang', 'no_hp' => '08678901234', 'email' => 'nursyam.h@gmail.com', 'jenis_kelamin' => 'L', 'tanggal_daftar' => '2024-07-01', 'status' => 'aktif'],
        ];
        foreach ($pembudidaya as $p) {
            Pembudidaya::create($p);
        }

        // ---- JENIS IKAN ----
        JenisIkan::truncate();
        $ikanData = [
            ['nama_ikan' => 'Lele', 'nama_latin' => 'Clarias sp.', 'deskripsi' => 'Ikan lele merupakan salah satu ikan air tawar yang paling populer dibudidayakan di Indonesia karena pertumbuhannya cepat dan tahan terhadap kondisi air yang kurang baik.', 'umur_panen_hari' => 60, 'status' => 'aktif'],
            ['nama_ikan' => 'Nila', 'nama_latin' => 'Oreochromis niloticus', 'deskripsi' => 'Ikan nila adalah ikan air tawar yang sangat adaptif, mudah berkembang biak, dan memiliki rasa daging yang enak sehingga banyak diminati konsumen.', 'umur_panen_hari' => 120, 'status' => 'aktif'],
            ['nama_ikan' => 'Mas', 'nama_latin' => 'Cyprinus carpio', 'deskripsi' => 'Ikan mas atau karper merupakan ikan budidaya tertua dan paling banyak dibudidayakan di dunia. Dagingnya lezat dan bernilai ekonomi tinggi.', 'umur_panen_hari' => 150, 'status' => 'aktif'],
            ['nama_ikan' => 'Patin', 'nama_latin' => 'Pangasius sp.', 'deskripsi' => 'Ikan patin adalah ikan air tawar khas Sumatera yang memiliki nilai ekonomi tinggi. Sangat cocok dibudidayakan di daerah Riau karena habitatnya di sungai-sungai besar.', 'umur_panen_hari' => 180, 'status' => 'aktif'],
            ['nama_ikan' => 'Baung', 'nama_latin' => 'Hemibagrus nemurus', 'deskripsi' => 'Ikan baung merupakan ikan khas sungai Sumatera, populer di Riau. Harganya tinggi dan dagingnya gurih, sehingga menjadi primadona budidaya lokal.', 'umur_panen_hari' => 210, 'status' => 'aktif'],
            ['nama_ikan' => 'Gurame', 'nama_latin' => 'Osphronemus goramy', 'deskripsi' => 'Ikan gurame merupakan ikan air tawar dengan harga jual tertinggi. Pertumbuhannya lambat namun nilai ekonomisnya sangat menguntungkan.', 'umur_panen_hari' => 365, 'status' => 'aktif'],
        ];
        foreach ($ikanData as $i) {
            JenisIkan::create($i);
        }

        // ---- KOLAM ----
        Kolam::truncate();
        $kolamData = [
            // Pekanbaru area
            ['pembudidaya_id' => 1, 'nama_kolam' => 'Kolam Lele A1', 'jenis_kolam' => 'terpal', 'luas_m2' => 200, 'kedalaman_m' => 1.2, 'alamat_kolam' => 'Jl. Siak Sri Indrapura No.12, Pekanbaru', 'latitude' => 0.5332, 'longitude' => 101.4486, 'status_kolam' => 'aktif', 'keterangan' => 'Kolam utama produksi lele'],
            ['pembudidaya_id' => 1, 'nama_kolam' => 'Kolam Lele A2', 'jenis_kolam' => 'terpal', 'luas_m2' => 150, 'kedalaman_m' => 1.0, 'alamat_kolam' => 'Jl. Siak Sri Indrapura No.12, Pekanbaru', 'latitude' => 0.5338, 'longitude' => 101.4492, 'status_kolam' => 'aktif', 'keterangan' => 'Kolam pembesaran'],
            ['pembudidaya_id' => 2, 'nama_kolam' => 'Kolam Nila Siti', 'jenis_kolam' => 'beton', 'luas_m2' => 400, 'kedalaman_m' => 1.5, 'alamat_kolam' => 'Jl. Kubang Raya No.45, Kampar', 'latitude' => 0.3623, 'longitude' => 101.4598, 'status_kolam' => 'aktif', 'keterangan' => 'Kolam nila beton'],
            ['pembudidaya_id' => 2, 'nama_kolam' => 'Kolam Mas Siti', 'jenis_kolam' => 'tanah', 'luas_m2' => 600, 'kedalaman_m' => 1.8, 'alamat_kolam' => 'Jl. Kubang Raya No.45, Kampar', 'latitude' => 0.3638, 'longitude' => 101.4612, 'status_kolam' => 'aktif', 'keterangan' => 'Kolam mas galian tanah'],
            // Pelalawan area
            ['pembudidaya_id' => 3, 'nama_kolam' => 'Tambak Patin B1', 'jenis_kolam' => 'tanah', 'luas_m2' => 1000, 'kedalaman_m' => 2.0, 'alamat_kolam' => 'Jl. Lintas Sumatra KM 10, Pelalawan', 'latitude' => 0.1532, 'longitude' => 102.1486, 'status_kolam' => 'aktif', 'keterangan' => 'Tambak patin skala besar'],
            ['pembudidaya_id' => 3, 'nama_kolam' => 'Tambak Patin B2', 'jenis_kolam' => 'tanah', 'luas_m2' => 800, 'kedalaman_m' => 1.8, 'alamat_kolam' => 'Jl. Lintas Sumatra KM 10, Pelalawan', 'latitude' => 0.1555, 'longitude' => 102.1510, 'status_kolam' => 'perbaikan', 'keterangan' => 'Sedang dalam perbaikan pematang'],
            // Rokan Hilir area
            ['pembudidaya_id' => 4, 'nama_kolam' => 'Kolam Baung R1', 'jenis_kolam' => 'keramba', 'luas_m2' => 50, 'kedalaman_m' => 3.0, 'alamat_kolam' => 'Sungai Rokan, Rokan Hilir', 'latitude' => 2.0214, 'longitude' => 100.9542, 'status_kolam' => 'aktif', 'keterangan' => 'Keramba jaring apung di sungai Rokan'],
            ['pembudidaya_id' => 4, 'nama_kolam' => 'Kolam Nila R2', 'jenis_kolam' => 'beton', 'luas_m2' => 300, 'kedalaman_m' => 1.2, 'alamat_kolam' => 'Jl. Bagan Siapi-api No.7, Rokan Hilir', 'latitude' => 2.0238, 'longitude' => 100.9568, 'status_kolam' => 'aktif', 'keterangan' => 'Kolam beton dekat rumah'],
            // Indragiri Hilir area
            ['pembudidaya_id' => 5, 'nama_kolam' => 'Tambak Patin D1', 'jenis_kolam' => 'tanah', 'luas_m2' => 1200, 'kedalaman_m' => 2.5, 'alamat_kolam' => 'Jl. Tembilahan Hulu No.33, Indragiri Hilir', 'latitude' => -0.3412, 'longitude' => 103.1622, 'status_kolam' => 'aktif', 'keterangan' => 'Tambak utama patin jumbo'],
            // Tanjungpinang
            ['pembudidaya_id' => 6, 'nama_kolam' => 'KJA Gurame T1', 'jenis_kolam' => 'keramba', 'luas_m2' => 80, 'kedalaman_m' => 4.0, 'alamat_kolam' => 'Teluk Keriting, Tanjungpinang', 'latitude' => 0.9225, 'longitude' => 104.4384, 'status_kolam' => 'aktif', 'keterangan' => 'Keramba jaring apung laut'],
        ];
        foreach ($kolamData as $k) {
            Kolam::create($k);
        }

        // ---- IKAN KOLAM ----
        IkanKolam::truncate();
        $ikanKolam = [
            ['kolam_id' => 1, 'jenis_ikan_id' => 1, 'jumlah_benih' => 5000, 'tanggal_tebar' => '2024-04-01', 'status' => 'aktif', 'catatan' => 'Benih lele sangkuriang'],
            ['kolam_id' => 2, 'jenis_ikan_id' => 1, 'jumlah_benih' => 3000, 'tanggal_tebar' => '2024-05-15', 'status' => 'aktif', 'catatan' => 'Batch kedua'],
            ['kolam_id' => 3, 'jenis_ikan_id' => 2, 'jumlah_benih' => 8000, 'tanggal_tebar' => '2024-03-10', 'status' => 'aktif', 'catatan' => 'Nila merah'],
            ['kolam_id' => 4, 'jenis_ikan_id' => 3, 'jumlah_benih' => 2000, 'tanggal_tebar' => '2024-01-20', 'status' => 'panen', 'catatan' => 'Sudah dipanen'],
            ['kolam_id' => 5, 'jenis_ikan_id' => 4, 'jumlah_benih' => 10000, 'tanggal_tebar' => '2024-02-01', 'status' => 'aktif', 'catatan' => 'Patin jambal'],
            ['kolam_id' => 6, 'jenis_ikan_id' => 4, 'jumlah_benih' => 8000, 'tanggal_tebar' => '2024-01-15', 'status' => 'aktif', 'catatan' => 'Menunggu perbaikan kolam'],
            ['kolam_id' => 7, 'jenis_ikan_id' => 5, 'jumlah_benih' => 1500, 'tanggal_tebar' => '2024-06-01', 'status' => 'aktif', 'catatan' => 'Baung hasil tangkapan sungai'],
            ['kolam_id' => 8, 'jenis_ikan_id' => 2, 'jumlah_benih' => 5000, 'tanggal_tebar' => '2024-05-01', 'status' => 'aktif', 'catatan' => 'Nila merah nirwana'],
            ['kolam_id' => 9, 'jenis_ikan_id' => 4, 'jumlah_benih' => 15000, 'tanggal_tebar' => '2024-03-15', 'status' => 'aktif', 'catatan' => 'Patin jumbo'],
            ['kolam_id' => 10, 'jenis_ikan_id' => 6, 'jumlah_benih' => 500, 'tanggal_tebar' => '2023-12-01', 'status' => 'aktif', 'catatan' => 'Gurame soang'],
        ];
        foreach ($ikanKolam as $ik) {
            IkanKolam::create($ik);
        }

        // ---- HASIL PANEN ----
        HasilPanen::truncate();
        $hasilPanen = [
            ['kolam_id' => 4, 'jenis_ikan_id' => 3, 'tanggal_panen' => '2024-06-20', 'total_panen_kg' => 480, 'keterangan' => 'Panen raya pertama ikan mas'],
            ['kolam_id' => 1, 'jenis_ikan_id' => 1, 'tanggal_panen' => '2024-05-30', 'total_panen_kg' => 350, 'keterangan' => 'Panen perdana lele A1'],
            ['kolam_id' => 3, 'jenis_ikan_id' => 2, 'tanggal_panen' => '2024-07-10', 'total_panen_kg' => 620, 'keterangan' => 'Panen nila merah'],
            ['kolam_id' => 5, 'jenis_ikan_id' => 4, 'tanggal_panen' => '2024-08-01', 'total_panen_kg' => 900, 'keterangan' => 'Panen patin jumbo skala besar'],
            ['kolam_id' => 7, 'jenis_ikan_id' => 5, 'tanggal_panen' => '2024-09-15', 'total_panen_kg' => 180, 'keterangan' => 'Panen baung premium'],
        ];
        foreach ($hasilPanen as $hp) {
            HasilPanen::create($hp);
        }

        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
