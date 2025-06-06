<?php
session_start();
$conn = new mysqli("localhost", "root", "", "epen");

$nama_pengguna = "Admin";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $result = $conn->query("SELECT nama FROM login WHERE username = '$username'");
    if ($result && $row = $result->fetch_assoc()) {
        $nama_pengguna = $row['nama'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Sistem Epen</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            color: #222;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color:#b2d8d8
            color: #000;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #000;
            text-decoration: underline;
        }

        img {
            border-radius: 4px;
        }

        input[type="submit"], input[type="button"], a.button {
            background-color: #444;
            color: white;
            border: none;
            padding: 8px 14px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover,
        a.button:hover {
            background-color: #222;
        }

        a.button {
            margin-bottom: 10px;
            display: inline-block;
        }

        .welcome-container {
            max-width: 600px;
            margin: 120px auto;
            text-align: center;
            padding: 40px;
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
        }

        .welcome-container h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color:#008080;
        }

        .welcome-container p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #ccc;
        }

        .top-right-logout {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-button {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 13px;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="top-right-logout">
        <a href="../landingpage/index.html" class="logout-button">Logout</a>
    </div>
    <div class="welcome-container">
        <h1>Sistem Informasi Tiket Epen</h1>
        <p>Halo, <strong><?= htmlspecialchars($nama_pengguna) ?></strong>! Selamat datang di sistem informasi pemesanan tiket.</p>
        <a href="data_tiket.php" class="button">Data Tiket</a><br>
        <a href="pembayaran.php" class="button">Data Pembayaran</a><br>
    </div>
</body>

</html>
