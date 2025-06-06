<?php
$conn = new mysqli("localhost", "root", "", "epen");

$result = $conn->query("SELECT * FROM data_tiket");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tiket</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            color: #333;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #e6e6e6;
        }

        a.button {
            background-color: #444;
            color: white;
            padding: 8px 14px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }

        a.button:hover {
            background-color: #222;
        }

        a.action-link {
            margin-right: 10px;
        }

        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <h1>Data Tiket</h1>

    <a href="add_tiket.php" class="button">+ Tambah Data Tiket</a>
    <center>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Gmail</th>
                <th>Alamat</th>
                <th>Tanggal Kunjung</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_pelanggan'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['no_hp']) ?></td>
                    <td><?= htmlspecialchars($row['gmail']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= $row['tanggal_kunjung'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td class="actions">
                        <a href="edit_tiket.php?id=<?= $row['id_pelanggan'] ?>" class="action-link">Edit</a>
                        <a href="delete_tiket.php?id=<?= $row['id_pelanggan'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table><br><br>
    <button onclick="window.location.href='index.php'">Batal</button>
    </center>
</body>
</html>
