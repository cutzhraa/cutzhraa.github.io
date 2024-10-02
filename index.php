<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jok Mobil Seken Pekanbaru</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link ke file CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="logo.jpg" type="image/jpeg">
</head>
<body>

<header>
    <div class="header-container">
        <img src="logo.jpg" alt="Logo Toko" class="logo"> <!-- Logo -->
        <h1>Jok Mobil Seken Pekanbaru</h1>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i></a></li> <!-- Ikon untuk Beranda -->
                <!-- <li><a href="about.php">Tentang Kami</a></li> -->
                <!-- <li><a href="login_legian.php">Login</a></li> -->
                <!-- <li><a href="kontak.php">Kontak</a></li> -->
                <li><a href="keranjang.php"><i class="fas fa-shopping-cart"></i></a></li> <!-- Ikon untuk Keranjang -->
            </ul>
        </nav>
    </div>
</header>

<section id="gallery">
    <div class="text-tengah">
        <h2>Galeri</h2>
        <div class="gallery">
            <?php
            include 'koneksi.php'; // Koneksi ke database
            
            // Kueri untuk mengambil gambar dari tabel penjualan
            $galleryQuery = "SELECT gambar FROM penjualan WHERE gambar IS NOT NULL LIMIT 3";
            $galleryResult = $conn->query($galleryQuery);
            
            if ($galleryResult->num_rows > 0) {
                while ($row = $galleryResult->fetch_assoc()) {
                    echo '<img src="uploads/' . htmlspecialchars($row['gambar']) . '" alt="Jok Mobil">';
                }
            } else {
                echo '<p>Belum ada gambar yang tersedia.</p>';
            }
            
            $conn->close(); // Menutup koneksi database
            ?>
        </div>
        <!-- Link ke halaman galeri.php -->
        <a href="galeri.php" class="button">Lihat Galeri</a>
    </div>
</section>

<section id="about">
    <div class="text-tengah">
        <h2>Tentang Kami</h2>
        <!-- <h3>Toko Kustomisasi Otomotif</h3> -->
        <p class="about-us-description">
        Kami adalah Jok Mobil Seken Pekanbaru, penyedia jok mobil dan aksesorisnya. Menjual berbagai macam jok copotan Import, Elektrik, Manual, Racing, dll. Kami berkomitmen untuk memberikan pengalaman terbaik bagi pengguna mobil.
            Di Toko Kustomisasi Otomotif, kami tidak hanya menyediakan berbagai jenis jok mobil berkualitas dari berbagai merek ternama, tetapi juga berkomitmen untuk memberikan layanan terbaik kepada pelanggan kami. 
            Setiap produk yang kami tawarkan telah melalui proses inspeksi yang ketat untuk memastikan kualitas dan kenyamanan, sehingga Anda dapat mengandalkan kami untuk menemukan jok yang sesuai dengan kebutuhan dan gaya mobil Anda.
            Tidak hanya itu, kami juga melayani pemasangan jok secara profesional, memastikan bahwa setiap produk yang Anda beli dari kami dipasang dengan sempurna.
            Kami memahami bahwa setiap kendaraan memiliki karakteristik dan kebutuhan yang unik. Oleh karena itu, tim kami siap membantu Anda memilih jok yang tepat, mulai dari jok elektrik mewah, hingga jok racing yang sporty dan dinamis, semua disesuaikan dengan preferensi dan anggaran Anda.
            Pengiriman melalui Kargo Dakota, Indah Kargo, dll.
        </p>
        <div class="social-media">
            <p style="font-size: 20px;"><strong>Hubungi Kami</strong></p>
            <a href="https://web.facebook.com/jok.secen/?locale=id_ID&_rdc=1&_rdr" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/+6281273904567" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/Jokmobilbekas.id" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://youtube.com/@jokmobilbekas?si=CztMj0mcwdBGmolS" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
            <a href="mailto:jokexsingapure@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
        </div>
    </div>
</section>

<section id="jadwal-toko">
    <div class="text-tengah">
        <h2>Jadwal Toko</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                include 'koneksi.php';

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil data jadwal toko
                $sql = "SELECT hari, buka, tutup FROM jadwal_toko";
                $jadwalResult = $conn->query($sql);

                // Cek hasil query
                if ($jadwalResult) {
                    if ($jadwalResult->num_rows > 0) {
                        while ($row = $jadwalResult->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['hari']) . '</td>';

                            // Menampilkan "Tutup" jika jam buka atau tutup adalah '00:00:00'
                            $jamBuka = ($row['buka'] === '00:00:00') ? 'Tutup' : htmlspecialchars($row['buka']);
                            $jamTutup = ($row['tutup'] === '00:00:00') ? 'Tutup' : htmlspecialchars($row['tutup']);
                            
                            echo '<td>' . $jamBuka . '</td>';
                            echo '<td>' . $jamTutup . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">Jadwal tidak tersedia.</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">Query gagal: ' . $conn->error . '</td></tr>';
                }

                // Tutup koneksi database
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</section>

<section id="contact">
    <div class="text-tengah">
        <h2>Kontak Kami</h2>
        <!-- <p>Alamat: Gang mama, Jl. Paus Jl. Kartika Sari, Sri Meranti, Kec. Rumbai, Kota Pekanbaru, Riau 28291</p> -->
        <!-- Tambahkan peta menggunakan iframe -->
        <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63834.56011059394!2d101.3920447!3d0.5104126!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab25595be627%3A0x9343fee27ffe71f7!2sKURSI%20SECOND%20PEKANBARU!5e0!3m2!1sid!2sid!4v1726741710980!5m2!1sid!2sid" width="900" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<footer>
    <p>&copy; 2024 Jok Mobil Seken Pekanbaru. Semua Hak Dilindungi.</p>
</footer>

</body>
</html>
