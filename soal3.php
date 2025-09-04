<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "123456"; // sesuaikan password MySQL Anda
$db = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pencarian
$search_nama = $_GET['nama'] ?? '';
$search_alamat = $_GET['alamat'] ?? '';
$search_hobi = $_GET['hobi'] ?? '';

// Query utama
$sql = "SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobi
        FROM person p
        LEFT JOIN hobi h ON p.id = h.person_id
        WHERE 1=1";

if ($search_nama) {
    $sql .= " AND p.nama LIKE '%" . $conn->real_escape_string($search_nama) . "%'";
}
if ($search_alamat) {
    $sql .= " AND p.alamat LIKE '%" . $conn->real_escape_string($search_alamat) . "%'";
}
if ($search_hobi) {
    $sql .= " AND h.hobi LIKE '%" . $conn->real_escape_string($search_hobi) . "%'";
}

$sql .= " GROUP BY p.id, p.nama, p.alamat";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Soal 3 - Listing Person & Hobi</title>
    <style>
        table { border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px 12px; }
        .box { border:1px solid #000; padding:20px; width:350px; margin-bottom:20px; }
    </style>
</head>
<body>
    <div class="box">
        <table>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Hobi</th>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['hobi']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">Data tidak ditemukan</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="box">
        <form method="get">
            <label>Nama :</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($search_nama); ?>"><br><br>
            <label>Alamat :</label>
            <input type="text" name="alamat" value="<?php echo htmlspecialchars($search_alamat); ?>"><br><br>
            <label>Hobi :</label>
            <input type="text" name="hobi" value="<?php echo htmlspecialchars($search_hobi); ?>"><br><br>
            <button type="submit">SEARCH</button>
        </form>
    </div>
</body>
</html>
<?php
$conn->close();
?>