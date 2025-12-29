# MEMBUAT PENCARIAN DATA 


Nama: ADINDA AULIA NABILA PUTRI

Nim: 312410309

Kelas: TI.24.A.4

# MEMBUAT FILE ```koneksi.php```

```
<?php
// konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "praktikum14";

// koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
```

File ```koneksi.php``` berfungsi untuk menghubungkan PHP dengan database MySQL. Koneksi dilakukan menggunakan fungsi ```mysql_connect()``` dengan parameter host, username, password, dana nama database. Jika koneksi gagal, sistem akan menampilkan pesan error untuk membantu proses debugging. 

# MEMBUAT FILE ```index.php```

```
<?php
include "koneksi.php";

// ambil keyword pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

// query awal + filter pencarian
$sql = "SELECT * FROM data_barang";
if (!empty($keyword)) {
    $sql .= " WHERE nama_barang LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Data Barang Elektronik</h1>

    <!-- Tombol tambah data -->
    <a href="tambah.php" class="btn">+ Tambah Barang</a>

    <!-- FORM PENCARIAN -->
    <form method="GET" style="margin:15px 0;">
        <input type="text" name="keyword" 
               placeholder="Cari nama barang..."
               value="<?= $keyword ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- TABEL DATA -->
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td align="center">
                <img src="gambar/<?= $row['gambar']; ?>" 
                     width="70" height="70">
            </td>
            <td><?= $row['nama_barang']; ?></td>
            <td>Rp <?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
            <td>Rp <?= number_format($row['harga_beli'], 0, ',', '.'); ?></td>
            <td><?= $row['stok']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_barang']; ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_barang']; ?>"
                   onclick="return confirm('Yakin hapus data?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

        <?php if (mysqli_num_rows($result) == 0) { ?>
        <tr>
            <td colspan="6" align="center">Data tidak ditemukan</td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
```

File ```index.php``` berfungsi sebagai halaman utama untuk menampilkan data barang. Halaman ini di lengkapi dengan fitur pencarian data menggunakan klausa ```WHERE``` dan ```LIKE```, serta menampilkan gambar, harga jual, harga beli, dan stok barang. Nilai ```<?= $keyword ?>``` menjaga agar teks pencarian tidak hilang setelah submit.

# HASIL DARI BROWSER 

<img width="1347" height="547" alt="Screenshot 2025-12-29 112043" src="https://github.com/user-attachments/assets/d3b58964-8e1f-4b42-9451-7cce67284ed7" />
