<?php
$conn = new mysqli("localhost", "root", "", "epen");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST["id_pelanggan"];
    $metode = $_POST["metode"];
    $jumlah = $_POST["jumlah"];
    $total_bayar = $_POST["total_bayar"];
    $tanggal_kunjung = $_POST["tanggal_kunjung"];
    $gambar = null;

    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $gambar = basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/" . $gambar);
    }

    $sql = "INSERT INTO pembayaran (id_pelanggan, metode, gambar, jumlah, total_bayar, tanggal_kunjung)
        VALUES ('$id_pelanggan', '$metode', '$gambar', '$jumlah', '$total_bayar', '$tanggal_kunjung')";

    if ($conn->query($sql)) {
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<h2>Tambah Data Pembayaran</h2>
<form method="post" enctype="multipart/form-data">
    ID Pelanggan: <input type="number" name="id_pelanggan" required><br>
    Metode:
    <select name="metode">
        <option value="qris">QRIS</option>
        <option value="transfer">Transfer</option>
    </select><br>
    Gambar Bukti: <input type="file" name="gambar"><br>
    Jumlah: <input type="number" name="jumlah" min="1" required><br>
    Total Bayar: <input type="number" min="1" name="total_bayar" required><br>
    Tanggal Kunjung: <input type="date" name="tanggal_kunjung" min="<?= date('Y-m-d') ?>" required><br>
    <input type="submit" value="Simpan">
    <a href="pembayaran.php"><input type="button" value="Batal"></a>
</form>