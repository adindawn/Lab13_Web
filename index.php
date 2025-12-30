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
