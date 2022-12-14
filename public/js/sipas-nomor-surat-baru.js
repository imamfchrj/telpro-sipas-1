function klasifikasi(kategori) {
    if(kategori.value == 'HK') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Hukum</option>\
            <optgroup label="Peraturan Non Perusahaan">\
            <option value="100">100 - Peraturan Non Perusahaan</option>\
            <option value="110">110 - Peraturan Lembaga</option>\
            <option value="120">120 - Peraturan Non - Perusahaan Lainnya</option>\
            <optgroup label="Peraturan Perusahaan">\
            <option value="200">200 - Peraturan Perusahaan</option>\
            <option value="210">210 - Peraturan Bidang Keuangan</option>\
            <option value="220">220 - Peraturan Bidang Logistik</option>\
            <option value="230">230 - Peraturan Bidang Sumber Daya Manusia</option>\
            <option value="240">240 - Peraturan Bidang Pengawasan/Hukum</option>\
            <option value="250">250 - Peraturan Bidang Pengolahan Data/Pelaporan</option>\
            <option value="260">260 - Peraturan Bidang Penelitian/Pengembangan</option>\
            <option value="270">270 - Peraturan Bidang Lainnya</option>\
            <optgroup label="Perdata">\
            <option value="300">300 - Perdata</option>\
            <option value="310">310 - Perseorangan</option>\
            <option value="320">320 - Kebendaan</option>\
            <option value="330">330 - Pembuktian dan Kadaluarsa</option>\
            <option value="340">340 - Tanah/Bangunan</option>\
            <optgroup label="Pidana">\
            <option value="400">400 - Pidana</option>\
            <option value="410">410 - Kejahatan/Kriminalitas</option>\
            <option value="420">420 - Pelanggaran</option>\
            <optgroup label="Perijinan">\
            <option value="500">500 - Perijinan</option>\
            <option value="510">510 - Surat Kuasa</option>\
            <option value="520">520 - Dispensasi</option>\
            <option value="530">530 - Lisensi</option>\
            <option value="540">540 - Konsensi</option>\
            <option value="550">550 - Rekomendasi</option>\
            <option value="560">560 - Surat Ijin</option>\
            <option value="570">570 - Legalisasi Dokumen</option>\
            <option value="580">580 - Perijinan Lainnya</option>\
            <optgroup label ="Pelayanan Hukum">\
            <option value="600">600 - Pelayanan Hukum</option>\
            <option value="610">610 - Bantuan Hukum/Konsultasi</option>\
            <option value="620">620 - Kajian Hukum</option>\
            <optgroup label="Penyelesaian Hukum">\
            <option value="700">700 - Penyelesaian Hukum</option>\
            <option value="710">710 - Gugatan/Sengketa</option>\
            <option value="720">720 - Peradilan Tata Usaha Negara (PTUN)</option>\
            <option value="730">730 - Klaim/Ganti Rugi</option>\
            <option value="740">740 - Arbitrase</option>\
            <optgroup label="Kerja Sama/Perikatan Dalam Negeri">\
            <option value="800">800 - Kerja Sama/Perikatan Dalam Negeri</option>\
            <option value="810">810 - Kontrak/PKS</option>\
            <option value="820">820 - Amandemen</option>\
            <option value="830">830 - Side Letter</option>\
            <option value="840">840 - Memorandum of Understanding (MOU)</option>\
            <option value="850">850 - Bentuk Kerjasama/Perikatan Dalam Negeri Lainnya</option>\
            <optgroup label="Kerja Sama/Perikatan Luar Negeri">\
            <option value="900">900 - Kerja Sama/Perikatan Luar Negeri</option>\
            <option value="910">910 - Kontrak/PKS</option>\
            <option value="920">920 - Amandemen</option>\
            <option value="930">930 - Side Letter</option>\
            <option value="940">940 - Memorandum of Understanding (MOU)</option>\
            <option value="950">950 - Bentuk Kerjasama/Perikatan Luar Negeri Lainnya</option>'
        )
    }
    else if(kategori.value == 'KU') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Keuangan</option>\
            <optgroup label="Perbankan">\
            <option value="100">100 - Perbankan</option>\
            <option value="110">110 - Bank</option>\
            <option value="120">120 - Deposito</option>\
            <option value="130">130 - Garansi Bank</option>\
            <option value="140">140 - Hutang (Pinjaman)/Kredit</option>\
            <option value="150">150 - Rekening</option>\
            <option value="160">160 - Cek/Giro/Kiriman Uang</option>\
            <option value="170">170 - Bunga Bank</option>\
            <optgroup label="Anggaran">\
            <option value="200">200 - Anggaran</option>\
            <option value="210">210 - Penyusunan Rencana Kerja dan Anggaran</option>\
            <option value="220">220 - Permintaan Dana/Anggaran</option>\
            <option value="230">230 - Distribusi/Redistribusi</option>\
            <option value="240">240 - Realisasi Anggara</option>\
            <option value="250">250 - SUKKA</option>\
            <option value="260">260 - Pertanggungan</option>\
            <optgroup label="Perbendaharaan">\
            <option value="300">300 - Perbendaharaan</option>\
            <option value="310">310 - Perpajakan</option>\
            <option value="320">320 - Petty Cash</option>\
            <option value="330">330 - Penggunaan Laba</option>\
            <option value="340">340 - Asuransi</option>\
            <option value="350">350 - Piutang</option>\
            <option value="360">360 - Kas</option>\
            <option value="370">370 - Uang Jaminan</option>\
            <optgroup label="Pendapatan">\
            <option value="400">400 - Pendapatan</option>\
            <option value="410">410 - Pendapatan Sewa Gedung</option>\
            <option value="420">420 - Pendapatan Service Charge</option>\
            <option value="430">430 - Pendapatan Jasa Pengelolaan Gedung</option>\
            <option value="440">440 - Pendapatan Jasa Pengembangan Properti</option>\
            <option value="450">450 - Pendapatan Jasa Proyek Manajemen</option>\
            <option value="460">460 - Pendapatan Operasional Lainnya</option>\
            <optgroup label="Akuntansi">\
            <option value="500">500 - Akuntansi</option>\
            <option value="510">510 - Perlakuan Akuntansi</option>\
            <option value="520">520 - Cash Flow</option>\
            <option value="530">530 - Neraca/Rugi Laba</option>\
            <option value="540">540 - Analisa Laporan Keuangan</option>\
            <option value="550">550 - Pembukaan</option>\
            <option value="560">560 - Rekonsiliasi</option>\
            <optgroup label="Administrasi Keuangan">\
            <option value="600">600 - Administrasi Keuangan</option>\
            <option value="610">610 - Statistik</option>\
            <option value="620">620 - Pentarifan</option>\
            <option value="630">630 - Surat Berharga (Obligasi, Saham, dll)</option>'
        )
    }
    else if(kategori.value == 'LG') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Logistik</option>\
            <optgroup label="Perencanaan & Analisis Kebutuhan">\
            <option value="100">100 - Perencanaan & Analisis Kebutuhan</option>\
            <option value="110">110 - Perencanaan Kebutuhan</option>\
            <option value="120">120 - Harga Standar/Referensi/Patokan</option>\
            <optgroup label="Pengadaan">\
            <option value="200">200 - Pengadaan</option>\
            <option value="210">210 - Permintaan Barang dan atau Jasa</option>\
            <option value="220">220 - Penawaran Harga</option>\
            <option value="230">230 - Konfirmasi</option>\
            <option value="240">240 - Tender</option>\
            <option value="250">250 - Evaluasi</option>\
            <option value="260">260 - Klarifikasi/Negoisasi</option>\
            <option value="270">270 - Penetapan Pemenang</option>\
            <option value="280">280 - Pengadaan/Pembelian Langsung</option>\
            <optgroup label="Penerimaan, Penyerahan & Distribusi">\
            <option value="300">300 - Penerimaan, Penyerahan & Distribusi</option>\
            <option value="310">310 - Pemeriksaan</option>\
            <option value="320">320 - Penerimaan</option>\
            <option value="330">330 - Penyimpanan/Pergudangan</option>\
            <option value="340">340 - Distribusi/Pengiriman</option>\
            <option value="350">350 - Peminjaman/Pengeluaran</option>\
            <option value="360">360 - Pengembalian</option>\
            <optgroup label="Penghapusan Barang">\
            <option value="400">400 - Penghapusan Barang</option>\
            <option value="410">410 - Usulan Penghapusan</option>\
            <option value="420">420 - Penghibahan</option>\
            <option value="430">430 - Penjualan/Pelelangan</option>\
            <optgroup label="Administrasi Logistik">\
            <option value="500">500 - Administrasi Logistik</option>\
            <option value="510">510 - Kodefikasi/Indexing</option>\
            <option value="520">520 - Inventarisasi Barang</option>\
            <option value="530">530 - Rekanan Barang/Rekanan Jasa</option>\
            <option value="540">540 - Pengelolaan Bukti Kepemilikan</option>\
            <option value="550">550 - Persediaan & Inventory</option>\
            <option value="560">560 - Mutasi Barang</option>\
            <option value="570">570 - Administrasi Logistik Lainnya</option>'
        )
    }
    else if(kategori.value == 'PR') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Public Relation</option>\
            <optgroup label="Keperluan">\
            <option value="100">100 - Keperluan</option>\
            <option value="110">110 - Pers</option>\
            <option value="120">120 - Promosi</option>\
            <option value="130">130 - Customer Education</option>\
            <option value="140">140 - Ucapan Terima Kasih</option>\
            <option value="150">150 - Media Internal</option>\
            <option value="160">160 - Pidato/Sambutan</option>\
            <option value="170">170 - Perlombaan</option>\
            <option value="180">180 - Budaya Perusahaan</option>\
            <option value="190">190 - Penghargaan Kepada Pihak Luar</option>\
            <optgroup label="Keprotokolan">\
            <option value="200">200 - Keprotokolan</option>\
            <option value="210">210 - Kunjungan</option>\
            <option value="220">220 - Upacara</option>\
            <option value="230">230 - Rapat</option>\
            <option value="240">240 - Pengumuman</option>\
            <option value="250">250 - Peliputan</option>\
            <optgroup label="Dokumentasi">\
            <option value="300">300 - Dokumentasi</option>\
            <option value="310">310 - Bahan Pustaka</option>\
            <option value="320">320 - Pengelolaan Dokumentasi</option>\
            <option value="330">330 - Pelayanan Informasi</option>'
        )
    }
    else if(kategori.value == 'LP') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Pengelolaan Data & Pelaporan</option>\
            <optgroup label="Pengolahan Data/Pelaporan Teknis">\
            <option value="100">100 - Pengolahan Data/Pelaporan Teknis</option>\
            <option value="110">110 - Pengolahan Data/Pelaporan Pengelolaan Gedung</option>\
            <option value="120">120 - Pengolahan Data/Pelaporan Penyewaan Gedung</option>\
            <option value="130">130 - Pengolahan Data/Pelaporan Pengembangan Properti</option>\
            <option value="140">140 - Pengolahan Data/Pelaporan Konstruksi</option>\
            <optgroup label="Pengolahan Data/Pelaporan Fungsional">\
            <option value="200">200 - Pengolahan Data/Pelaporan Fungsional</option>\
            <option value="210">210 - Pengolahan Data/Pelaporan Logistik</option>\
            <option value="220">220 - Pengolahan Data/Pelaporan Personalia</option>\
            <option value="230">230 - Pengolahan Data/Pelaporan Pengawasan</option>\
            <option value="240">240 - Pengolahan Data/Pelaporan Hukum</option>\
            <option value="250">250 - Pengolahan Data/Pelaporan Penelitian Pengembangan</option>\
            <option value="260">260 - Pengolahan Data/Pelaporan Marketing</option>\
            <option value="270">270 - Pengolahan Data/Pelaporan Keuangan</option>\
            <option value="280">280 - Pengolahan Data/Pelaporan Fungsional Lainnya</option>'
        )
    }
    else if(kategori.value == 'PD') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Pendidikan & Pelatihan</option>\
            <optgroup label="Analisa Kebutuhan Diklat">\
            <option value="100">100 - Analisa Kebutuhan Diklat</option>\
            <option value="110">110 - Perencanaan Kebutuhan Diklat</option>\
            <option value="120">120 - Jadwal/Kursil Diklat</option>\
            <optgroup label="Pendidikan & Pelatihan Teknik">\
            <option value="200">200 - Pendidikan & Pelatihan Teknik</option>\
            <option value="210">210 - Teknik Pendingin (Air Conditioner)</option>\
            <option value="220">220 - Teknik Mekanikal</option>\
            <option value="230">230 - Teknik Elektrikal</option>\
            <option value="240">240 - Teknik Sipil</option>\
            <option value="250">250 - Teknik Plumbing</option>\
            <option value="260">260 - Pendidikan Teknik Lainnya</option>\
            <optgroup label="Pendidikan & Pelatihan Umum">\
            <option value="300">300 - Pendidikan & Pelatihan Umum</option>\
            <option value="310">310 - Pendidikan/Pelatihan Bidang Keuangan</option>\
            <option value="320">320 - Pendidikan/Pelatihan Bidang Adm dan Manajemen</option>\
            <option value="330">330 - Pendidikan/Pelatihan Bidang Hukum</option>\
            <option value="340">340 - Pendidikan/Pelatihan Bidang Pelayanan</option>\
            <option value="350">350 - Pendidikan/Pelatihan Bidang SDM</option>\
            <option value="360">360 - Pendidikan/Pelatihan Bidang Pengamanan</option>\
            <option value="370">370 - Pendidikan/Pelatihan Bidang Pengetahuan Pendukung Lainnya</option>\
            <optgroup label="Pendidikan & Pelatihan Khusus">\
            <option value="400">400 - Pendidikan & Pelatihan Khusus</option>\
            <optgroup label="Pelayanan Pendidikan & Pelatihan">\
            <option value="500">500 - Pelayanan Pendidikan & Pelatihan</option>\
            <option value="510">510 - Kesejahteraan Peserta</option>\
            <option value="520">520 - Tugas Akhir/Kerja Praktek</option>\
            <option value="530">530 - Program Latihan Kerja</option>\
            <option value="540">540 - Seminar/Workshop/Penataran</option>\
            <option value="550">550 - Saran Pendidikan</option>\
            <option value="560">560 - Sistem Pengajaran Khusus (CBT/BIT/SBJJ)</option>\
            <option value="570">570 - Tenaga Pengajar</option>\
            <option value="580">580 - Buku Pedoman Pelatihan/Diklat</option>\
            <option value="590">590 - Pelayanan Pendidikan/Pelatihan Lainnya</option>\
            <optgroup label="Administrasi/Evaluasi Pendidikan & Pelatihan">\
            <option value="600">600 - Administrasi/Evaluasi Pendidikan & Pelatihan</option>\
            <option value="610">610 - Ujian/Test</option>\
            <option value="620">620 - Ijazah/Sertifikat</option>\
            <option value="630">630 - Administrasi Pendidikan & Pelatihan Lainnya</option>'
        )
    }
    else if(kategori.value == 'PS') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Personalia</option>\
            <optgroup label="Organisasi & Perencanaan Kebutuhan">\
            <option value="100">100 - Organisasi & Perencanaan Kebutuhan</option>\
            <option value="110">110 - Survey Kebutuhan</option>\
            <option value="120">120 - Formasi Karyawan</option>\
            <option value="130">130 - Analisa Jabatan</option>\
            <option value="140">140 - Penyusunan Jabatan (Struktural/Fungsional)</option>\
            <option value="150">150 - Struktur Organisasi</option>\
            <option value="160">160 - Uraian Kerja</option>\
            <option value="170">170 - Pembentukan Tim Kerja</option>\
            <option value="180">180 - Jalur Karir</option>\
            <optgroup label="Rekrutmen">\
            <option value="200">200 - Rekrutmen</option>\
            <option value="210">210 - Lamaran</option>\
            <option value="220">220 - Panggilan</option>\
            <option value="230">230 - Test/Seleksi</option>\
            <option value="240">240 - Evaluasi</option>\
            <optgroup label="Administrasi Personalia">\
            <option value="300">300 - Administrasi Personalia</option>\
            <option value="310">310 - Identitas Karyawan/Personal Data</option>\
            <option value="320">320 - Pengangkatan</option>\
            <option value="330">330 - Penugasan</option>\
            <option value="340">340 - Permintaan Karyawan</option>\
            <option value="350">350 - Perjalanan Dinas</option>\
            <option value="360">360 - Cuti</option>\
            <option value="370">370 - Ijin</option>\
            <option value="380">380 - Sumpah/Janji Karyawan</option>\
            <option value="390">390 - Absensi/Daftar Hadir</option>\
            <optgroup label="Kepangkatan/Grade">\
            <option value="400">400 - Kepangkatan/Grade</option>\
            <option value="410">410 - Kenaikan Pangkat</option>\
            <option value="420">420 - Penyesuaian Pendidikan</option>\
            <option value="430">430 - Penundaan Kenaikan Pangkat</option>\
            <option value="440">440 - Penurunan Pangkat</option>\
            <option value="450">450 - Kenaikan Pangkat/Penghargaan</option>\
            <optgroup label="Penggajian">\
            <option value="500">500 - Penggajian</option>\
            <option value="510">510 - Kenaikan Gaji</option>\
            <option value="520">520 - Penurunan Gaji</option>\
            <option value="530">530 - Daftar Gaji/Jenjang Gaji</option>\
            <option value="540">540 - Penyesuaian Gaji</option>\
            <option value="550">550 - Penundaan Kenaikan Gaji</option>\
            <option value="560">560 - Sistem Penggajian (Kompensasi)</option>\
            <optgroup label="Kesejahteraan">\
            <option value="600">600 - Kesejahteraan</option>\
            <option value="610">610 - Kesehatan</option>\
            <option value="620">620 - Bantuan Dana Karyawan</option>\
            <option value="630">630 - Pembinaan Rohani/Jasmani</option>\
            <option value="640">640 - Transportasi</option>\
            <option value="650">650 - Akomodasi</option>\
            <option value="660">660 - Bea Siswa</option>\
            <option value="670">670 - Lembur</option>\
            <option value="680">680 - Bantuan Sosial</option>\
            <optgroup label="Pembinaan/Penilaian">\
            <option value="700">700 - Pembinaan/Penilaian</option>\
            <option value="710">710 - Ujian Dinas/Penjenjangan</option>\
            <option value="720">720 - Pemindahan (Mutasi)</option>\
            <option value="730">730 - Pembinaan/Penilaian</option>\
            <option value="740">740 - Promosi Jabatan</option>\
            <option value="750">750 - Kelulusan</option>\
            <option value="760">760 - Screening</option>\
            <option value="770">770 - Penghargaan Karyawan</option>\
            <optgroup label="Penertiban">\
            <option value="800">800 - Penertiban</option>\
            <option value="810">810 - Pelanggaran Disiplin</option>\
            <option value="820">820 - Pemeriksaan</option>\
            <option value="830">830 - Peringatan</option>\
            <option value="840">840 - Tindak Administrasi/Hukuman Disiplin</option>\
            <option value="850">850 - Rehabilitasi</option>\
            <optgroup label="Pensiun & Pemberhentian">\
            <option value="900">900 - Pensiun & Pemberhentian</option>\
            <option value="910">910 - Pemberhentian Dengan Hormat</option>\
            <option value="920">920 - Pemberhentian Dengan Tidak Hormat</option>\
            <option value="930">930 - Masa Persiapan Pensiun</option>\
            <option value="940">940 - Pensiun</option>\
            <option value="950">950 - Nominatif Pensiun</option>'
        )
    }
    else if(kategori.value == 'UM') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Umum</option>\
            <optgroup label="Manajemen Perkantoran">\
            <option value="100">100 - Manajemen Perkantoran</option>\
            <option value="110">110 - Sistem Kearsipan</option>\
            <option value="120">120 - Building Management</option>\
            <option value="130">130 - Form/Model Administrasi</option>\
            <option value="140">140 - Alat Tulis Menulis (ATM/ATK)</option>\
            <optgroup label="Barang Inventaris Perusahaan">\
            <option value="200">200 - Barang Inventaris Perusahaan</option>\
            <option value="210">210 - Meubelair</option>\
            <option value="220">220 - Mesin Kantor</option>\
            <option value="230">230 - Peralatan Kantor</option>\
            <option value="240">240 - Kendaraan Bermotor</option>\
            <option value="250">250 - Barang Inventaris Perusahaan Lainnya</option>\
            <optgroup label="Kebersihan">\
            <option value="300">300 - Kebersihan</option>\
            <option value="310">310 - Cleaning Service</option>\
            <option value="320">320 - Kebersihan Lingkungan</option>\
            <option value="330">330 - Peralatan/Perangkat Pembersih</option>\
            <optgroup label="Pengamanan">\
            <option value="400">400 - Pengamanan</option>\
            <option value="410">410 - Keselamatan Kerja</option>\
            <option value="420">420 - Keamanan Lingkungan</option>\
            <option value="430">430 - Pengamanan Perangkat/Sarana</option>\
            <option value="440">440 - Peralatan/Perangkat Pengamanan</option>\
            <optgroup label="Yayasan/Perkumpulan/Lembaga">\
            <option value="500">500 - Yayasan/Perkumpulan/Lembaga</option>\
            <option value="510">510 - Koperasi</option>\
            <option value="520">520 - KORPRI</option>\
            <option value="530">530 - Dharma Wanita</option>\
            <option value="540">540 - Yayasan Dana Pensiun</option>\
            <option value="550">550 - Industri Kecil</option>\
            <option value="560">560 - Anak Perusahaan</option>\
            <option value="570">570 - Yayasan/Perkumpulan/Lembaga Lainnya</option>'
        )
    }
    else if(kategori.value == 'LB') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Penelitian & Pengembangan</option>\
            <optgroup label="Perencanaan Perusahaan">\
            <option value="100">100 - Perencanaan Perusahaan</option>\
            <option value="110">110 - Business Plan</option>\
            <optgroup label="Penelitian/Pengujian/Pengembangan">\
            <option value="200">200 - Penelitian/Pengujian/Pengembangan</option>\
            <option value="210">210 - Penelitian/Pengujian/Pengembangan Sistem Informasi</option>\
            <option value="220">220 - Penelitian/Pengujian/Pengembangan Catu Daya/Mechanical Electrical</option>\
            <option value="230">230 - Penelitian/Pengujian/Pengembangan Pengelolaan Gedung</option>\
            <option value="240">240 - Penelitian/Pengujian/Pengembangan Lainnya</option>\
            <optgroup label="Penelitian & Pengembangan Manajemen Fungsional">\
            <option value="300">300 - Penelitian & Pengembangan Manajemen Fungsional</option>\
            <option value="310">310 - Penelitian/Pengembangan Manajemen Teknik</option>\
            <option value="320">320 - Penelitian/Pengembangan Manajemen Pelayanan</option>\
            <option value="330">330 - Penelitian/Pengembangan Manajemen Personalia</option>\
            <option value="340">340 - Penelitian/Pengembangan Manajemen Pendidikan & Pelatihan</option>\
            <option value="350">350 - Penelitian/Pengembangan Manajemen Logistik</option>\
            <option value="360">360 - Penelitian/Pengembangan Manajemen Keuangan</option>\
            <option value="370">370 - Penelitian/Pengembangan Manajemen Pengawasan & Hukum</option>\
            <option value="380">380 - Penelitian/Pengembangan Manajemen Pelaporan Data & Pengolahan Data</option>\
            <option value="390">390 - Penelitian/Pengembangan Manajemen Fungsional Lainnya</option>'
        )
    }
    else if(kategori.value == 'PW') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>\
            <option value="000">000 - Pengawasan</option>\
            <optgroup label="Pengawasan Fungsional">\
            <option value="100">100 - Pengawasan Fungsional</option>\
            <option value="110">110 - Pengawasan Personalia</option>\
            <option value="120">120 - Pengawasan Logistik</option>\
            <option value="130">130 - Keuangan dan Anggaran</option>\
            <option value="140">140 - Pengawasan Hukum</option>\
            <option value="150">150 - Pengawasan Humas</option>\
            <option value="160">160 - Pengawasan Pendidikan & Pelatihan</option>\
            <option value="170">170 - Pengawasan Penelitian & Pengembangan</option>\
            <option value="180">180 - Bidang/Fungsional Lainnya</option>'
        )
    }
    else if(kategori.value == '') {
        $('#klasifikasiSk').html(
            '<option value="">- Pilih -</option>'
        )
    }
}