-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2025 pada 13.20
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms_berita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `date`, `title`, `content`, `picture`, `views`) VALUES
(1, '09-03-2025', 'Hawa Sejuk dan Spot Instagramable di Taman Selecta, Cocok Buat Healing!', '<p>Malang selalu punya cara buat bikin orang jatuh cinta. Salah satu tempat wisata yang wajib masuk dalam daftar kunjungan adalah <strong>Taman Rekreasi Selecta</strong>. Terletak di kawasan Batu, tempat ini terkenal dengan udaranya yang sejuk, pemandangan indah, dan pastinya banyak spot kece buat foto-foto. Kalau kamu lagi cari tempat buat santai, refreshing, atau sekadar melepas penat dari hiruk-pikuk kota, Selecta adalah pilihan yang tepat. Yuk, kita bahas lebih dalam tentang keindahan taman ini!</p>\\r\\n        \\r\\n        <h2>Sejarah dan Daya Tarik Taman Selecta</h2>\\r\\n        <p>Taman Rekreasi Selecta bukan tempat wisata baru. Dibangun sejak era kolonial Belanda pada tahun 1930-an, tempat ini awalnya digunakan sebagai tempat peristirahatan bagi pejabat dan orang-orang penting saat itu. Namun, seiring berjalannya waktu, Selecta berkembang menjadi taman rekreasi yang terbuka untuk umum dan menjadi salah satu destinasi wisata favorit di Malang Raya.</p>\\r\\n        <p>Begitu sampai di Taman Selecta, kamu langsung disambut udara segar khas pegunungan yang bikin tubuh dan pikiran jadi rileks. Lokasinya yang berada di ketinggian sekitar 1.100 meter di atas permukaan laut membuat tempat ini punya suhu yang adem, bahkan di siang hari sekalipun. Ditambah lagi, taman bunga yang luas dengan warna-warni menawan bikin suasana makin nyaman dan menyenangkan.</p>\\r\\n        \\r\\n        <h2>Spot Instagramable yang Wajib Dikunjungi</h2>\\r\\n        <p>Selain keindahan alamnya, Selecta juga menawarkan banyak spot instagramable yang cocok buat mempercantik feed media sosialmu. Ada taman bunga dengan latar belakang perbukitan hijau, jembatan kecil yang dikelilingi tanaman warna-warni, hingga kolam air jernih yang bisa jadi tempat foto estetik. Salah satu spot favorit pengunjung adalah <strong>sky bike</strong>, yaitu sepeda yang melayang di atas taman, memberikan sensasi unik dan pemandangan spektakuler dari atas.</p>\\r\\n        \\r\\n        <h2>Wahana Seru di Taman Selecta</h2>\\r\\n        <p>Kalau datang ke sini, jangan lupa juga buat menikmati wahana seru yang ada di dalam taman. Selain sky bike, ada juga wahana perahu ayun, water park, hingga kuda tunggang buat anak-anak maupun dewasa. Kolam renang di Selecta juga cukup menarik karena airnya yang jernih dan sejuk, langsung dari sumber alami di sekitar pegunungan.</p>\\r\\n        \\r\\n        <h2>Kulineran di Taman Selecta</h2>\\r\\n        <p>Setelah puas jalan-jalan dan bermain, kamu bisa mampir ke restoran atau area kuliner di dalam Selecta untuk menikmati makanan khas Malang, seperti bakso Malang yang terkenal lezat. Ada juga berbagai camilan seperti jagung bakar dan pisang goreng yang pas banget disantap sambil menikmati udara dingin di sini.</p>\\r\\n        \\r\\n        <h2>Tips Berkunjung ke Taman Selecta</h2>\\r\\n        <ul>\\r\\n            <li><strong>Datang di pagi atau sore hari</strong> - Suhu lebih segar dan suasana lebih nyaman.</li>\\r\\n            <li><strong>Gunakan pakaian yang nyaman</strong> - Udara cukup dingin, pakailah jaket atau pakaian hangat.</li>\\r\\n            <li><strong>Bawa kamera atau ponsel dengan baterai penuh</strong> - Banyak spot bagus yang sayang kalau nggak diabadikan.</li>\\r\\n            <li><strong>Siapkan uang tunai</strong> - Beberapa tempat menerima pembayaran digital, tetapi lebih baik membawa uang tunai.</li>\\r\\n        </ul>\\r\\n        \\r\\n        <h2>Kesimpulan</h2>\\r\\n        <p>Jadi, kalau kamu butuh tempat buat <strong>healing</strong> dari kesibukan sehari-hari, Taman Selecta adalah pilihan yang sempurna. Dengan udara sejuk, pemandangan indah, dan banyak spot foto keren, tempat ini cocok banget buat liburan santai bersama keluarga, teman, atau bahkan solo trip. Yuk, rencanakan perjalananmu ke Selecta dan rasakan sendiri keindahannya!</p>', 'selecta.jpeg', 2),
(2, '10-03-2025', 'Jelajah Museum Angkut: Wisata Edukasi Seru untuk Pecinta Otomotif', '<p>Kalau kamu pecinta kendaraan atau suka dengan sejarah transportasi, Museum Angkut di Batu, Malang, wajib masuk dalam daftar tempat wisata yang harus dikunjungi!</p>\r\n    <p>Museum ini bukan sekadar tempat pajangan mobil dan motor lawas, tapi juga mengajak pengunjung menjelajahi perkembangan dunia otomotif dari masa ke masa dengan cara yang seru dan interaktif.</p>\r\n    <p>Mulai dari kendaraan klasik, pesawat, hingga suasana kota-kota terkenal dunia, semua bisa kamu temukan di sini. Yuk, kita jelajahi Museum Angkut lebih dalam!</p>\r\n\r\n    <p><strong>Sejarah dan Konsep Museum Angkut</strong></p>\r\n    <p>Museum Angkut pertama kali dibuka pada tahun 2014 oleh Jatim Park Group, pengelola beberapa destinasi wisata populer di Batu. Sebagai museum transportasi pertama dan terbesar di Asia Tenggara, tempat ini punya koleksi lebih dari 300 kendaraan dari berbagai era dan negara.</p>\r\n    <p>Bukan hanya mobil dan motor klasik, tapi juga pesawat, sepeda, becak, hingga kendaraan khas berbagai daerah di Indonesia dan dunia.</p>\r\n\r\n    <p>Yang bikin Museum Angkut makin menarik adalah konsepnya yang tematik. Jadi, saat menjelajahi museum ini, kamu seperti berpindah dari satu kota ke kota lain dengan atmosfer yang benar-benar berbeda. Setiap zona dibuat mirip dengan aslinya, lengkap dengan bangunan, lampu, bahkan musik khas yang membuat pengalamanmu semakin seru.</p>\r\n\r\n    <h4><strong>Zona-Zona Menarik di Museum Angkut</strong></h4>\r\n\r\n    <p><strong>1. Zona Hall Utama</strong></p>\r\n    <p>Begitu masuk, kamu langsung disambut dengan berbagai koleksi kendaraan antik yang elegan. Di sini, ada mobil-mobil klasik dari Amerika dan Eropa yang dulu digunakan oleh para pejabat dan orang-orang berpengaruh di dunia. Salah satu yang paling menarik perhatian adalah mobil kepresidenan yang pernah digunakan oleh Presiden Soekarno!</p>\r\n\r\n    <p><strong>2. Zona Edukasi</strong></p>\r\n    <p>Buat kamu yang penasaran dengan sejarah perkembangan transportasi dari zaman ke zaman, zona ini cocok banget untuk dikunjungi. Ada berbagai informasi menarik tentang bagaimana kendaraan berkembang, mulai dari kereta kuda, sepeda, hingga mobil listrik masa kini.</p>\r\n\r\n    <p><strong>3. Zona Sunda Kelapa & Batavia</strong></p>\r\n    <p>Zona ini menggambarkan suasana pelabuhan Sunda Kelapa pada masa kolonial Belanda. Kamu bisa melihat replika kapal besar, becak tempo dulu, dan berbagai kendaraan khas dari era tersebut. Ditambah dengan suasana khas pasar dan pelabuhan zaman dulu, tempat ini cocok buat yang suka berfoto dengan nuansa vintage.</p>\r\n\r\n    <p><strong>4. Zona Amerika</strong></p>\r\n    <p>Kalau kamu penggemar mobil klasik ala Hollywood, zona ini pasti jadi favoritmu! Ada banyak kendaraan khas Amerika seperti Cadillac, Chevrolet, hingga Ford Mustang. Zona ini juga dihiasi dengan suasana kota-kota di Amerika, lengkap dengan replika Hollywood dan Broadway yang ikonik.</p>\r\n\r\n    <p><strong>5. Zona Eropa</strong></p>\r\n    <p>Di sini, kamu bakal merasa seperti sedang berjalan di jalanan kota-kota klasik di Eropa. Mulai dari London dengan bus merah tingkatnya yang khas, Paris dengan suasana romantisnya, hingga Italia yang penuh dengan mobil-mobil sport mewah seperti Ferrari dan Lamborghini.</p>\r\n\r\n    <p><strong>6. Zona Gangster & Broadway</strong></p>\r\n    <p>Buat kamu yang suka suasana film mafia ala Amerika, zona ini menawarkan pengalaman unik. Dengan latar belakang kota gangster tahun 1920-an, lengkap dengan kendaraan klasik dan suasana gelap penuh lampu neon, tempat ini sering jadi spot favorit untuk foto-foto keren.</p>\r\n\r\n    <h4><strong>Wahana dan Atraksi Menarik</strong></h4>\r\n    <p>Selain koleksi kendaraan yang super keren, Museum Angkut juga menawarkan berbagai atraksi yang sayang untuk dilewatkan:</p>\r\n    <ul>\r\n        <li><strong>The Presidential Car</strong> - Koleksi mobil kepresidenan, termasuk replika mobil yang pernah digunakan oleh Presiden Soekarno.</li>\r\n        <li><strong>Zona Flight Simulator</strong> - Kamu bisa merasakan sensasi menerbangkan pesawat dalam simulator yang seru dan realistis.</li>\r\n        <li><strong>Atraksi Parade Kendaraan</strong> - Setiap sore, ada parade kendaraan klasik yang dikendarai oleh staf museum dengan kostum khas sesuai dengan era kendaraannya.</li>\r\n    </ul>\r\n\r\n    <h4><strong>Zona Pasar Apung: Tempat Makan & Belanja Unik</strong></h4>\r\n    <p>Setelah puas menjelajahi berbagai zona di Museum Angkut, jangan lupa mampir ke Pasar Apung Nusantara yang ada di area luar museum. Konsepnya mirip dengan pasar terapung di Kalimantan, di mana berbagai jajanan tradisional dijual dari perahu-perahu kecil.</p>\r\n    <p>Di sini, kamu bisa mencicipi makanan khas Jawa Timur seperti nasi pecel, tahu petis, rujak cingur, hingga es dawet. Selain makanan, Pasar Apung juga menjual berbagai suvenir khas Malang yang cocok buat oleh-oleh.</p>\r\n\r\n    <h4><strong>Tips Berkunjung ke Museum Angkut</strong></h4>\r\n    <ul>\r\n        <li><strong>Datang lebih awal</strong> - Museum ini cukup luas, jadi kalau ingin menjelajahi semua zona dengan puas, sebaiknya datang pagi atau siang hari.</li>\r\n        <li><strong>Gunakan pakaian dan sepatu yang nyaman</strong> - Karena kamu akan banyak berjalan, pakailah pakaian yang santai dan sepatu yang nyaman.</li>\r\n        <li><strong>Bawa kamera atau ponsel dengan baterai penuh</strong> - Ada banyak spot keren yang sayang banget kalau tidak diabadikan.</li>\r\n        <li><strong>Jangan lupa cek jadwal pertunjukan</strong> - Supaya tidak ketinggalan parade kendaraan atau atraksi seru lainnya.</li>\r\n    </ul>\r\n\r\n    <h4><strong>Kesimpulan</strong></h4>\r\n    <p>Museum Angkut bukan sekadar museum biasa, tapi tempat wisata edukasi yang menyenangkan untuk semua usia. Dengan koleksi kendaraan klasik, zona tematik yang keren, dan berbagai wahana interaktif, tempat ini cocok banget buat pecinta otomotif maupun yang sekadar ingin jalan-jalan dan hunting foto keren.</p>\r\n    <p>Jadi, kalau kamu ke Malang atau Batu, jangan lupa mampir ke Museum Angkut. Siapkan kamera, ajak teman atau keluarga, dan nikmati pengalaman menjelajahi dunia otomotif dalam suasana yang unik dan mengesankan!</p>', 'museumangkut.jpg', 2),
(3, '21-05-2025', 'Alun-Alun tugu', 'Alun-alun Tugu Malang yang saat ini menjadi salah satu landmark kota apel itu dulunya bernama Alun-alun Bunder. Disebut demikian karena memang bentuknya yang melingkar. Bentuk alun-alun ini dulunya bisa dibilang lebih sederhana dari penampakan alun-alun yang sekarang.\r\n\r\nAlun-alun Tugu dibuat dengan memperhatikan beberapa hal. Monumen Tugu yang berada di tengah melambangkan pusat untuk kelima penjuru arah. Selain arah utama yang menuju ke Gedung Balai Kota, keempat arah lainnya mewakili jalan raya yang bermuara di alun-alun ini\r\n\r\nKini, Alun-alun Tugu menjelma menjadi sebuah taman cantik dengan hiasan bunga dan trembesi yang menjadi ikon Kota Malang. Pagar kokoh pun sekarang mengelilingi alun-alun yang juga menjadi destinasi wisata taman malang yang indah dan asyik untuk nongkrong.', 'tugumalang.jpg', 1),
(5, '2025-05-25', 'Gempuran AI 2025', '<p>Kecerdasan buatan (AI) muncul sebagai megatren transformatif dengan potensi untuk membentuk kembali industri masa depan. AI siap untuk mendorong perubahan yang belum pernah terjadi sebelumnya yang mendefinisikan ulang bagaimana bisnis menciptakan dan memberikan nilai, termasuk merevolusi pengalaman pelanggan (CX), efisiensi operasional, dan operasi TI. Dampaknya yang mendalam pada perusahaan, ekonomi, dan masyarakat menjadikannya teknologi penting dalam lanskap digital suatu perusahaan.<br />\\r\\n<br />\\r\\nLaporan ini menyoroti 10 peluang pertumbuhan teratas dalam AI untuk tahun 2025, yang mencakup area penting seperti AI Agentik, model dasar, platform MLOps, dan solusi AI yang bertanggung jawab. Kemajuan ini tidak hanya akan meningkatkan skalabilitas dan efisiensi AI tetapi juga memperkuat praktik AI yang etis dan transparan.<br />\\r\\n<br />\\r\\nPada tahun 2025, AI diharapkan akan terintegrasi ke tingkat yang lebih besar dalam aplikasi perusahaan dan akses ke teknologi akan menjadi lebih demokratis. Adopsi AI diharapkan tetap kuat, dengan perusahaan terus membangun kesiapan organisasi untuk bersaing di dunia digital baru dan mengadopsi praktik terbaik menuju AI yang bertanggung jawab.</p>\\r\\n', '6832a5685dc7e.jpg', 1),
(6, '2025-06-10 ', 'PT GAG Akhirnya Bersuara soal Tambang Nikel di Raja Ampat', '<p>PT GAG Nikel (GN) akhirnya buka suara terkait aktivitas pertambangan di Pulau Gag, Raja Ampat, Papua Barat Daya, yang belakangan menuai perhatian publik.<br />\\r\\n<br />\\r\\nPerusahaan menyebut kegiatan tambang dilakukan dengan prinsip keberlanjutan dan sesuai prosedur teknis yang berlaku.<br />\\r\\n<br />\\r\\nPelaksana Tugas (Plt) Presiden Direktur Gag Nikel Arya Arditya mengatakan lokasi tambang mereka berada di luar zona Geopark Raja Ampat. Ia menyebut empat pulau utama yang masuk dalam batas Geopark, yakni Waigeo, Batanta, Salawati, dan Misool, tidak mencakup Pulau Gag.</p>\\r\\n\\r\\n<p>&quot;Karena Pulau Gag berada cukup jauh dari keempat pulau tersebut, kegiatan pertambangan PT Gag Nikel dipastikan tidak berada di zona Geopark Raja Ampat,&quot; kata Arya dalam keterangan resmi, Selasa (10/6).</p>\\r\\n\\r\\n<p>Perusahaan juga menyayangkan beredarnya informasi yang menyebut bahwa aktivitas tambang telah merusak Pulau Gag. Menurut Arya, Gag Nikel telah menerapkan sejumlah sistem pengelolaan limbah dan pemantauan kualitas air untuk meminimalkan dampak lingkungan.</p>\\r\\n\\r\\n<p>&quot;Kami sudah melakukan berbagai hal dalam melaksanakan operasional berkelanjutan agar tidak merusak Pulau Gag. Antara lain dalam hal pengelolaan limbah, PT Gag Nikel telah menerapkan prosedur sesuai standar pertambangan yang berlaku,&quot; ujarnya.<br />\\r\\n<br />\\r\\nIa menjelaskan sistem drainase, sump pit, dan kolam pengendapan digunakan untuk menampung air larian. Air tersebut kemudian diproses melalui lima kompartemen sebagai filter dan sedimentasi sebelum dilepas ke badan sungai, dengan pengukuran Total Suspended Solids (TSS) dilakukan setiap hari.<br />\\r\\n<br />\\r\\nBeberapa program lingkungan juga dijalankan perusahaan, di antaranya reklamasi area tambang, rehabilitasi daerah aliran sungai (DAS), dan konservasi terumbu karang. Menurut data perusahaan, hingga akhir 2024 reklamasi telah mencakup 131 hektare (ha), dengan lebih dari 350 ribu pohon ditanam.<br />\\r\\n&nbsp;</p>\\r\\n', '68481261eaec6.jpeg', 0),
(7, '2025-06-10', 'Fakultas Teknologi Pertanian IPB Terancam Dibubarkan, Ini Respons Mantan Rektor dan Dekan', '<p>Rencana perubahan struktur Fakultas Teknologi Pertanian (Fateta) Institut Pertanian Bogor (<a href=\\\"https://www.tempo.co/tag/ipb\\\" target=\\\"_blank\\\">IPB</a>) menjadi sekolah teknik menuai respons dari sejumlah tokoh yang punya sejarah panjang dengan fakultas tersebut. Mereka menegaskan pentingnya mempertahankan Fateta sebagai rumah besar pengembangan teknologi pertanian Indonesia yang berkontribusi sejak 1964.</p>\\r\\n\\r\\n<p>Mantan Rektor IPB, Aman Wirakartakusumah, sekaligus pendiri Fateta mengatakan bahwa eksistensi fakultas ini tak bisa dilepaskan dari strategi pembangunan nasional. &ldquo;Sejak awal, Fateta hadir untuk mendukung semua mata rantai sektor pertanian, dari hulu sampai hilir. Teknologi dan keilmuan yang dikembangkan di dalamnya menyokong isu pangan, energi, gizi, hingga kualitas hidup generasi muda menuju Indonesia Emas 2045,&rdquo; ujar Aman saat ditemui di Aula IPB International Conventional Center, Bogor, Jawa Barat, Senin, 9 Juni 2025.</p>\\r\\n\\r\\n<p>Aman juga menekankan Fateta merupakan wujud hibrida antara ilmu teknik, ilmu alam, manajemen, dan teknologi. Menurut dia, membubarkan fakultas ini sama saja dengan mencabut roh teknologi dari pembangunan pertanian Indonesia.</p>\\r\\n\\r\\n<p>Mantan Dekan Fateta IPB Florentinus Gregorius Winarno menyebut Fateta telah melahirkan dan membesarkan insan-insan pertanian tangguh. Dia amat keberatan apabila fakultas tersebut diganti menjadi sekolah teknik. &ldquo;Kalau ditusuk jantung saya, darahnya darah Fateta. Saya bangun Fateta dari yang tidak dikenal, sekarang jadi mendunia,&rdquo; ucapnya.</p>\\r\\n\\r\\n<p>Winarno juga mengisahkan perannya dalam pendirian 17 STM Pembangunan Pertanian yang dulu berada di bawah binaan Fateta. Kini, ia menyayangkan hubungan historis itu nyaris terputus. Menurut dia, perubahan struktur institusi tidak semestinya dilakukan dengan menghapus sejarah. &ldquo;Almamater itu, artinya ibu yang menyusui. Kalau sudah tua, bukan berarti harus diganti dengan ibu muda,&rdquo; katanya menyindir rencana penggantian Fateta dengan sekolah teknik.</p>\\r\\n\\r\\n<p>Sementara itu, Dekan Fateta IPB saat ini menyatakan proses transformasi fakultas ke sekolah teknik telah melalui pertimbangan panjang dan bukan keputusan sepihak. &ldquo;Empat program studi di Fateta, tiga di antaranya sudah berstatus sarjana teknik, satu lagi teknologi pangan. Semua prodi telah memilih untuk masuk ke struktur sekolah teknik,&rdquo; ujarnya.</p>\\r\\n\\r\\n<p>Namun, ia menegaskan bahwa substansi ilmu teknologi pertanian tetap dijaga dan diperkuat. &ldquo;Ilmunya tidak dikurangi sesuil (sedikit) pun. Yang berubah hanya struktur organisasinya,&rdquo; kata dia. Ia membuka peluang diskusi akademik untuk mengevaluasi kembali keputusan ini, asal melalui mekanisme resmi. &ldquo;Silakan saja bikin naskah akademik baru. Tapi harus dosen aktif, bukan alumni,&rdquo; ujarnya.</p>\\r\\n', '684813a7b0fef.jpg', 0),
(8, '2025-06-10', '7 Tren Teknologi 2025: Era AI, Komputasi Kuantum, dan 6G', '<p>Perkembangan teknologi terus melaju pesat, membawa perubahan besar dalam berbagai aspek kehidupan. Jika kita membandingkan era sekarang dengan beberapa dekade lalu, kemajuan teknologi terasa begitu revolusioner. Contohnya, pada tahun 1980, menjalankan program komputer memerlukan waktu berminggu-minggu dengan bantuan kartu berlubang. Kini, kemampuan pemrosesan yang dahulu sulit dicapai oleh komputer besar dapat dengan mudah ditemukan pada ponsel pintar kita.</p>\\r\\n\\r\\n<p>Lalu, apa yang dapat kita harapkan dari dunia teknologi pada tahun 2025? Berikut adalah tujuh tren teknologi yang diprediksi akan mendominasi.</p>\\r\\n\\r\\n<ol>\\r\\n	<li><strong>Era Baru Agen AI: Revolusi Dalam Kehidupan dan Industri</strong><br />\\r\\n	Kecerdasan buatan (AI) terus mengalami perkembangan pesat, dan pada 2025, agen-agen AI diperkirakan akan menjadi bagian integral dari kehidupan kita. Agen AI adalah program pintar yang dirancang untuk menyelesaikan tugas tertentu secara mandiri. Mereka mampu menganalisis situasi, membuat keputusan, dan melaksanakan berbagai operasi kompleks tanpa campur tangan manusia.\\r\\n	<p>Di sektor <strong>manufaktur</strong>, agen AI akan mengubah cara kerja pabrik. Konsep pabrik tanpa pekerja manusia kini bukan lagi sekadar mimpi. Dengan bantuan robot berbasis agen AI, tugas-tugas berat seperti merakit kendaraan, mengatur inventaris, hingga memantau proses produksi akan dilakukan secara otomatis. Tesla, melalui robot humanoid mereka yang bernama <strong>Optimus</strong>, menjadi salah satu pionir di bidang ini. Optimus direncanakan mulai digunakan secara internal pada 2025, dengan target untuk dijual ke perusahaan lain pada 2026. Teknologi ini tidak hanya meningkatkan efisiensi, tetapi juga mengurangi risiko kecelakaan kerja.</p>\\r\\n\\r\\n	<p>Namun, keunggulan agen AI tidak hanya terbatas pada industri manufaktur. Dalam kehidupan sehari-hari, agen ini diperkirakan akan menggantikan berbagai aplikasi ponsel tradisional. Sebagai contoh, bayangkan sebuah agen AI yang dapat mengelola jadwal harian Anda, menjawab email, atau bahkan membantu Anda dalam proses pengajuan hipotek dengan efisiensi tinggi.</p>\\r\\n\\r\\n	<p>Lebih jauh lagi, AI diprediksi akan menjadi pemain utama dalam <strong>manajemen proyek</strong>. Menurut firma konsultan Gartner, hingga 80% tugas manajemen proyek akan dilakukan oleh AI pada 2030. Ini mencakup perencanaan, pengelolaan sumber daya, hingga pelaporan hasil. Agen-agen AI yang cerdas ini akan memungkinkan manajer fokus pada strategi dan pengambilan keputusan tingkat tinggi, sementara tugas-tugas teknis diserahkan kepada teknologi.</p>\\r\\n\\r\\n	<p>Dengan perkembangan seperti ini, agen AI bukan hanya alat bantu, tetapi juga partner dalam mencapai produktivitas yang lebih tinggi di berbagai bidang.</p>\\r\\n	</li>\\r\\n	<li><strong>Personalisasi Berbasis AI: Transformasi Pendidikan dan Bisnis</strong><br />\\r\\n	Kemajuan teknologi AI juga membuka pintu menuju personalisasi yang lebih mendalam di berbagai sektor, khususnya <strong>pendidikan</strong>. Sistem pendidikan tradisional, yang bersifat seragam dan linear, sering kali tidak memenuhi kebutuhan individu. Namun, dengan bantuan AI, program studi dapat dirancang khusus untuk setiap siswa berdasarkan kemampuan, pengalaman, dan preferensi mereka.\\r\\n	<p>Sebagai contoh, seorang siswa dengan minat di bidang seni dan teknologi dapat memiliki kurikulum yang menggabungkan kedua bidang tersebut, sementara AI terus memantau kemajuan belajar mereka. Lebih menarik lagi, teknologi ini bahkan dapat mempertimbangkan <strong>kondisi emosional</strong> siswa. Misalnya, jika AI mendeteksi bahwa siswa memiliki kualitas tidur yang buruk melalui data dari jam tangan pintar, materi pelajaran dapat disesuaikan untuk hari itu agar lebih ringan dan mudah dipahami. Ini menciptakan pengalaman belajar yang tidak hanya efektif tetapi juga lebih manusiawi.</p>\\r\\n\\r\\n	<p>Tidak hanya dalam pendidikan, personalisasi berbasis AI juga membawa dampak besar di <strong>sektor bisnis</strong>. Banyak perusahaan kini melatih model bahasa besar atau <strong><em>Large Language Models</em></strong><strong> (LLMs)</strong> dengan data spesifik untuk meningkatkan efisiensi operasional. LLM, seperti teknologi di balik chatbot canggih, mampu memahami konteks, menjawab pertanyaan, dan bahkan memberikan rekomendasi berbasis data.</p>\\r\\n\\r\\n	<p>Namun, penggunaan LLM memiliki tantangan, terutama kebutuhan akan data dalam jumlah besar dan daya komputasi tinggi. Sebagai solusinya, model bahasa kecil atau <strong><em>Small Language Models</em></strong><strong> (SLMs)</strong> sedang dikembangkan. SLM dirancang untuk menangani tugas-tugas spesifik dengan data yang lebih sedikit dan daya komputasi yang lebih rendah. Keunggulan ini memungkinkan SLM digunakan di perangkat &quot;edge&quot; seperti ponsel pintar, tablet, atau laptop tanpa memerlukan sumber daya dari pusat data awan.</p>\\r\\n\\r\\n	<p>Sebagai ilustrasi, sebuah perusahaan ritel dapat menggunakan SLM untuk menganalisis preferensi pelanggan lokal di suatu wilayah tertentu. Model ini membantu perusahaan memberikan rekomendasi produk yang relevan, meningkatkan kepuasan pelanggan, dan mendorong loyalitas.</p>\\r\\n\\r\\n	<p>Dengan personalisasi berbasis AI, teknologi tidak lagi hanya bersifat universal, tetapi menjadi solusi yang dirancang khusus untuk kebutuhan individu atau organisasi. Perubahan ini tidak hanya membuat kehidupan lebih nyaman, tetapi juga membuka peluang baru di berbagai bidang. <strong>Era di mana teknologi memahami dan menyesuaikan diri dengan kita kini telah dimulai.</strong></p>\\r\\n	</li>\\r\\n	<li><strong>Menuju Era Komputasi Kuantum Praktis: Revolusi Teknologi Masa Depan</strong><br />\\r\\n	Komputasi kuantum sedang membuka jalan menuju masa depan teknologi yang lebih canggih. Berbeda dengan komputer klasik yang memproses data dalam bentuk bit (0 atau 1), komputer kuantum menggunakan qubit, yang mampu berada dalam keadaan superposisi (0 dan 1 secara bersamaan). Kemampuan ini memungkinkan komputer kuantum menyelesaikan masalah yang terlalu kompleks untuk ditangani oleh komputer tradisional.\\r\\n	<p>Namun, tantangan besar dalam pengembangan teknologi ini terletak pada <strong>pengoreksian kesalahan</strong>. Ketika qubit berinteraksi dengan lingkungannya, mereka rentan terhadap gangguan yang dapat menyebabkan kesalahan komputasi. Oleh karena itu, fokus penelitian kini bergeser dari sekadar menambah jumlah qubit menjadi memperbaiki sistem koreksi kesalahan, sebuah langkah penting untuk menciptakan komputer kuantum yang stabil dan praktis.</p>\\r\\n\\r\\n	<p>Pada 2025, para ahli memprediksi kita akan melihat <strong>penerapan nyata komputasi kuantum</strong> di berbagai sektor. Misalnya:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Farmasi</strong>: Mempercepat penemuan obat dengan mensimulasikan molekul yang kompleks secara lebih akurat.</li>\\r\\n		<li><strong>Keuangan</strong>: Meningkatkan kemampuan analisis risiko dan pengoptimalan portofolio investasi.</li>\\r\\n		<li><strong>Logistik</strong>: Mengoptimalkan rute pengiriman untuk menghemat waktu dan biaya.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Jika berhasil diterapkan, komputasi kuantum dapat mengubah cara kita memecahkan masalah besar, membuka peluang inovasi yang belum pernah terbayangkan sebelumnya.</p>\\r\\n	</li>\\r\\n	<li><strong>Dunia Fisik dan Virtual yang Semakin Menyatu: Masa Depan di Ujung Jari</strong><br />\\r\\n	Teknologi seperti <strong><em>Virtual Reality</em></strong><strong> (VR)</strong>, <strong><em>Augmented Reality</em></strong><strong> (AR)</strong>, dan <strong><em>Mixed Reality</em></strong><strong> (MR)</strong> telah mengubah cara kita berinteraksi dengan dunia. Ketiga teknologi ini menawarkan pengalaman yang unik:\\r\\n	<ul>\\r\\n		<li><strong>VR</strong> menciptakan dunia digital sepenuhnya, memungkinkan pengguna &ldquo;masuk&rdquo; ke dalam lingkungan virtual.</li>\\r\\n		<li><strong>AR</strong> memperkaya dunia nyata dengan elemen digital, seperti overlay informasi atau objek virtual.</li>\\r\\n		<li><strong>MR</strong> menggabungkan dunia fisik dan digital secara real-time, menciptakan pengalaman interaktif yang mendalam.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Perusahaan teknologi besar seperti <strong>Apple</strong> dengan <strong>Vision Pro</strong> dan <strong>Meta</strong> dengan <strong>Meta Quest</strong> terus memimpin inovasi dalam bidang ini. Pada 2025, kita dapat mengharapkan perangkat yang lebih canggih, lebih ringan, dan lebih terjangkau. Teknologi ini akan menjadi semakin relevan dalam berbagai aspek kehidupan, seperti:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Pekerjaan</strong>: Rapat virtual yang terasa seperti pertemuan fisik.</li>\\r\\n		<li><strong>Pendidikan</strong>: Simulasi interaktif yang memungkinkan siswa belajar dengan cara yang lebih menarik.</li>\\r\\n		<li><strong>Hiburan</strong>: Pengalaman bermain game dan menonton film yang benar-benar imersif.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Dunia fisik dan virtual kini tidak lagi terpisah. Kombinasi teknologi ini akan menciptakan cara baru untuk bekerja, belajar, bersosialisasi, dan menikmati hiburan.</p>\\r\\n	</li>\\r\\n	<li><strong>Blockchain: Teknologi untuk Transparansi dan Efisiensi Global</strong><br />\\r\\n	Blockchain telah membuktikan dirinya sebagai salah satu inovasi paling revolusioner dalam teknologi. Dengan sistem yang terdesentralisasi dan transparan, blockchain menciptakan rantai data yang tidak dapat diubah dan mudah ditelusuri. Teknologi ini tidak hanya aman tetapi juga meningkatkan efisiensi melalui proses otomatisasi.\\r\\n	<p>Salah satu keunggulan utama blockchain adalah kemampuannya untuk <strong>meningkatkan transparansi</strong> dan <strong>ketertelusuran</strong>. Misalnya, dalam rantai pasokan, blockchain memungkinkan pelacakan produk dari sumber hingga konsumen akhir. Hal ini membantu mengurangi penipuan, memastikan kualitas, dan memberikan informasi yang lebih jelas kepada pelanggan.</p>\\r\\n\\r\\n	<p>Di sektor <strong>kesehatan</strong>, blockchain digunakan untuk:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Mengelola data pasien</strong> secara aman, meminimalkan risiko kebocoran informasi sensitif.</li>\\r\\n		<li><strong>Melacak persediaan medis</strong>, memastikan ketersediaan dan kualitas obat-obatan.</li>\\r\\n		<li><strong>Mempermudah pertukaran informasi</strong> antarpenyedia layanan kesehatan.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Sementara itu, di sektor <strong>keuangan</strong>, blockchain telah menciptakan peluang baru:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Transaksi yang lebih cepat dan murah</strong>, karena tidak memerlukan perantara seperti bank.</li>\\r\\n		<li><strong>Inklusi finansial</strong>, memungkinkan mereka yang tidak memiliki akses ke layanan perbankan tradisional untuk berpartisipasi dalam ekonomi global.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Dengan terus berkembangnya teknologi ini, blockchain memiliki potensi untuk menciptakan dunia yang lebih transparan, efisien, dan terhubung. Dari rantai pasokan hingga layanan keuangan, dampaknya akan terasa di hampir setiap aspek kehidupan.</p>\\r\\n\\r\\n	<p>Era baru yang menggabungkan teknologi kuantum, realitas virtual, dan blockchain kini semakin dekat. Inovasi ini akan mengubah cara kita hidup dan bekerja, menciptakan masa depan yang lebih cerdas dan efisien.</p>\\r\\n	</li>\\r\\n	<li><strong>Dimulainya Era Komunikasi 6G: Kecepatan Super dan Masa Depan Terhubung</strong><br />\\r\\n	Teknologi komunikasi generasi keenam (6G) diprediksi akan mulai distandardisasi pada 2025, membuka pintu menuju konektivitas yang jauh lebih cepat, lebih canggih, dan lebih mendalam dibandingkan generasi sebelumnya, 5G. Jika 5G memungkinkan kecepatan tinggi dan latensi rendah, 6G dirancang untuk <strong>menghadirkan kecepatan data hingga 100 kali lebih cepat</strong> serta latensi mendekati nol.\\r\\n	<p>Dengan kemampuan ini, 6G akan menjadi tulang punggung berbagai inovasi, seperti:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Kota pintar (smart cities)</strong>: Pengelolaan infrastruktur kota secara real-time, termasuk transportasi, energi, dan keamanan.</li>\\r\\n		<li><strong>Kendaraan otonom</strong>: Komunikasi instan antar kendaraan dan infrastruktur jalan, memastikan perjalanan yang lebih aman dan efisien.</li>\\r\\n		<li><strong>Layanan berbasis AI real-time</strong>: Seperti asisten pribadi yang lebih cerdas, interaksi manusia-mesin yang seamless, dan augmented reality (AR) dalam kehidupan sehari-hari.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Namun, keberhasilan implementasi teknologi ini sangat bergantung pada <strong>standar global yang kompatibel</strong>. Standarisasi tersebut diperlukan untuk memastikan berbagai perangkat dan sistem dari seluruh dunia dapat berkomunikasi tanpa hambatan. Kolaborasi antara negara, perusahaan teknologi, dan organisasi internasional akan menjadi kunci dalam mencapai konsensus ini.</p>\\r\\n\\r\\n	<p>Era 6G bukan hanya tentang kecepatan, melainkan tentang menghadirkan pengalaman digital yang lebih imersif, efisien, dan terkoneksi di setiap aspek kehidupan kita.</p>\\r\\n	</li>\\r\\n	<li><strong>Kemajuan Kendaraan Otonom: Menuju Transportasi Masa Depan</strong><br />\\r\\n	Teknologi kendaraan otonom terus berkembang pesat dan diperkirakan akan mencapai tonggak penting pada 2025. Kendaraan otonom ini diklasifikasikan berdasarkan tingkat otonominya, mulai dari <strong>tingkat 0 (manual sepenuhnya)</strong> hingga <strong>tingkat 5 (sepenuhnya tanpa campur tangan manusia)</strong>.\\r\\n	<p>Saat ini, kendaraan tingkat 4, yang mampu <strong>mengemudi secara mandiri dalam kondisi tertentu</strong> dengan sedikit intervensi manusia, sudah mulai dioperasikan di beberapa kota besar seperti San Francisco. Kendaraan ini dirancang untuk memberikan solusi mobilitas yang lebih aman, efisien, dan ramah lingkungan, terutama di daerah perkotaan yang padat.</p>\\r\\n\\r\\n	<p><strong>Mercedes</strong> dan <strong>Tesla</strong> adalah dua pemain utama yang memimpin inovasi dalam teknologi ini:</p>\\r\\n\\r\\n	<ul>\\r\\n		<li><strong>Mercedes-Benz</strong>: Melalui sistem <strong>Drive Pilot</strong>, Mercedes terus mengembangkan kemampuan kendaraan mereka untuk mengemudi mandiri pada kecepatan yang lebih tinggi. Ini akan memberikan kenyamanan lebih bagi pengguna, terutama dalam perjalanan jauh.</li>\\r\\n		<li><strong>Tesla</strong>: Perusahaan ini tengah mengembangkan <strong>Robotaxi</strong>, kendaraan otonom yang dirancang untuk memberikan layanan transportasi tanpa pengemudi. Robotaxi ini diharapkan akan diluncurkan sebelum 2027, menawarkan alternatif transportasi umum yang lebih efisien dan ekonomis.</li>\\r\\n	</ul>\\r\\n\\r\\n	<p>Di masa depan, kendaraan otonom akan menjadi bagian integral dari kehidupan sehari-hari, mengurangi kecelakaan lalu lintas akibat kesalahan manusia dan mengoptimalkan efisiensi transportasi. Dengan dukungan teknologi 6G, kendaraan ini dapat terhubung dengan infrastruktur kota pintar, menciptakan sistem transportasi yang benar-benar terintegrasi.</p>\\r\\n\\r\\n	<p>Kemajuan teknologi ini membawa kita semakin dekat pada era transportasi yang lebih cerdas, aman, dan berkelanjutan, di mana manusia dapat fokus pada hal lain sementara kendaraan &quot;mengemudi&quot; untuk kita.</p>\\r\\n	</li>\\r\\n</ol>\\r\\n', '6848142c3a928.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_author`
--

CREATE TABLE `article_author` (
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article_author`
--

INSERT INTO `article_author` (`article_id`, `author_id`) VALUES
(1, 1),
(2, 3),
(3, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(5, 9),
(6, 4),
(7, 5),
(8, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `author`
--

INSERT INTO `author` (`id`, `nickname`, `email`, `password`, `photo`, `description`) VALUES
(1, 'Budi', 'budi@example.com', 'password123', NULL, NULL),
(2, 'dian', 'dian@gmail.com\r\n', 'password123', 'Profile.png', 'Mahaasiswa semester 4 Teknik Informatika'),
(3, 'Iwan', 'iwan@example.com', 'password123', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `status` enum('ya','tidak') NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku_tamu`
--

INSERT INTO `buku_tamu` (`id`, `nama`, `email`, `komentar`, `status`, `tanggal`) VALUES
(1, 'dian', 'dian@gmail.com', 'Saya Lapar', 'ya', '2025-05-25'),
(4, 'dianles', 'dianaja@gmail.com', 'coba', 'ya', '2025-05-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`) VALUES
(4, 'alam', 'Kategori yang mencakup tempat wisata alam seperti gunung, pantai, air terjun, dan hutan wisata.'),
(5, 'pendidikan', 'Kategori yang berisi tempat wisata edukasi seperti museum, pusat sains, kebun binatang, dan planetarium.'),
(6, 'taman', 'Kategori yang mencakup tempat wisata taman rekreasi seperti taman kota, taman hiburan, dan taman bermain.'),
(9, 'teknologi', 'pembahasan teknologi yang booming di era sekaranng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `subjek` varchar(255) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` enum('belum_dibaca','dibaca') DEFAULT 'belum_dibaca',
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `email`, `nama_lengkap`, `subjek`, `isi_pesan`, `status`, `tanggal`) VALUES
(1, 'dianaja@gmail.com', 'dian', 'haha', 'hihi', 'dibaca', '2025-05-25'),
(3, 'dian@gmail.com', 'dian', 'konten', 'kontennya menarik', 'dibaca', '2025-05-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `article_author`
--
ALTER TABLE `article_author`
  ADD PRIMARY KEY (`article_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indeks untuk tabel `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeks untuk tabel `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `article_author`
--
ALTER TABLE `article_author`
  ADD CONSTRAINT `article_author_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_author_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
