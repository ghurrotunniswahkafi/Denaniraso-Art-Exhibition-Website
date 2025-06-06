<?php
$conn = new mysqli("localhost", "root", "", "epen");

$result = $conn->query("SELECT * FROM data_tiket");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM pembayaran WHERE id_bayar = $id");
    $data = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bayar         = $_POST['id_bayar'];
    $id_pelanggan     = $conn->real_escape_string($_POST['id_pelanggan']);
    $metode           = $conn->real_escape_string($_POST['metode']);
    $jumlah           = $conn->real_escape_string($_POST['jumlah']);
    $total_bayar      = $conn->real_escape_string($_POST['total_bayar']);
    $tanggal_kunjung  = $conn->real_escape_string($_POST['tanggal_kunjung']);
    $gambar           = $data['gambar'];

    if ($_FILES['gambar']['name'] != '') {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/$gambar");
    }

    $sql = "UPDATE pembayaran SET 
            id_pelanggan='$id_pelanggan',
            metode='$metode',
            gambar='$gambar',
            jumlah='$jumlah',
            total_bayar='$total_bayar',
            tanggal_kunjung='$tanggal_kunjung'
            WHERE id_bayar=$id_bayar";

    if ($conn->query($sql)) {
        header("Location: pembayaran.php");
        exit();
    } else {
        echo "<center>Gagal mengedit data: " . $conn->error . "</center>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembayaran</title>
    <link rel="stylesheet" href="../../assets/css/admin-style.css">
</head>
<body>
    <h2><center>Edit Pembayaran</center></h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_bayar" value="<?= $data['id_bayar'] ?>">
        <center>
            <table>
                <tr>
                    <td>ID Pelanggan:</td>
                    <td><input type="number" name="id_pelanggan" value="<?= $data['id_pelanggan'] ?>" required></td>
                </tr>
                <tr>
                    <td>Metode:</td>
                    <td>
                        <select name="metode">
                            <option value="qris" <?= $data['metode'] === 'qris' ? 'selected' : '' ?>>QRIS</option>
                            <option value="transfer" <?= $data['metode'] === 'transfer' ? 'selected' : '' ?>>Transfer</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Upload Bukti (jika diubah):</td>
                    <td><input type="file" name="gambar"></td>
                </tr>
                <tr>
                    <td>Jumlah:</td>
                    <td><input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" required></td>
                </tr>
                <tr>
                    <td>Total Bayar:</td>
                    <td><input type="number" name="total_bayar" value="<?= $data['total_bayar'] ?>" required></td>
                </tr>
                <tr>
                    <td>Tanggal Kunjung:</td>
                    <td><input type="date" name="tanggal_kunjung" value="<?= $data['tanggal_kunjung'] ?>" min="<?= date('Y-m-d') ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <br>
                        <input type="submit" value="Simpan" class="btn">
                        <button type="button" class="btn" onclick="window.location.href='pembayaran.php'">Batal</button>
                    </td>
                </tr>
            </table>
        </center>
    </form>
</body>
</html>
