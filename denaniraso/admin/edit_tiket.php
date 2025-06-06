<?php
$conn = new mysqli("localhost", "root", "", "epen");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $result = $conn->query("SELECT * FROM data_tiket WHERE id_pelanggan = $id");
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $no_hp = $_POST["no_hp"];
    $gmail = $_POST["gmail"];
    $alamat = $_POST["alamat"];
    $tanggal_kunjung = $_POST["tanggal_kunjung"];
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];

    $sql = "UPDATE data_tiket SET 
            nama='$nama', no_hp='$no_hp', gmail='$gmail', alamat='$alamat',
            tanggal_kunjung='$tanggal_kunjung', jumlah=$jumlah, harga=$harga
            WHERE id_pelanggan = $id";

    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "Gagal mengedit data: " . $conn->error;
    }
}
?>

<form method="post" action="">
    <h2>Edit Data Tiket</h2>
    <input type="hidden" name="id" value="<?= $data['id_pelanggan'] ?>">
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>
    No HP: <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>"><br>
    Gmail: <input type="email" name="gmail" value="<?= $data['gmail'] ?>"><br>
    Alamat: <input type="text" name="alamat" value="<?= $data['alamat'] ?>"><br>
    Tanggal Kunjung: <input type="date" name="tanggal_kunjung" value="<?= $data['tanggal_kunjung'] ?>"><br>
    Jumlah: <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>"><br>
    Harga: <input type="number" name="harga" value="<?= $data['harga'] ?>"><br>
    <input type="submit" value="Simpan Perubahan">
</form>
