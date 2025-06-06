<?php
$conn = new mysqli("localhost", "root", "", "epen");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM data_tiket WHERE id_pelanggan = $id";
    if ($conn->query($sql)) {
        header("Location: data_tiket.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
}
?>
