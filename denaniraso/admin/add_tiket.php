<?php
$conn = new mysqli("localhost", "root", "", "epen");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $no_hp = $_POST["no_hp"];
    $gmail = $_POST["gmail"];
    $alamat = $_POST["alamat"];
    $tanggal_kunjung = $_POST["tanggal_kunjung"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];

    $sql = "INSERT INTO data_tiket (nama, no_hp, gmail, alamat, tanggal_kunjung, jumlah, harga) 
            VALUES ('$nama', '$no_hp', '$gmail', '$alamat', '$tanggal_kunjung', '$jumlah', '$harga')";

    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "Gagal menambahkan data: " . $conn->error;
    }
}
?>

<form method="post" action="">
    <h2>Tambah Data Tiket</h2>
    Nama: <input type="text" name="nama"><br>
    No HP: <input type="text" name="no_hp"><br>
    Gmail: <input type="email" name="gmail"><br>
    Alamat: <input type="text" name="alamat"><br>
    Tanggal Kunjung: <input type="date" name="tanggal_kunjung"><br>
    Jumlah: <input type="number" name="jumlah"><br>
    Harga: <input type="number" name="harga"><br>
    <input type="submit" value="Tambah">
</form>
