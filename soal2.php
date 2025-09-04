<?php
// Menyimpan data dari setiap step
$step = 1;
$nama = '';
$umur = '';
$hobi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['step'])) {
        $step = (int)$_POST['step'];
        if ($step === 1) {
            $nama = $_POST['nama'] ?? '';
            $step = 2;
        } elseif ($step === 2) {
            $nama = $_POST['nama'] ?? '';
            $umur = $_POST['umur'] ?? '';
            $step = 3;
        } elseif ($step === 3) {
            $nama = $_POST['nama'] ?? '';
            $umur = $_POST['umur'] ?? '';
            $hobi = $_POST['hobi'] ?? '';
            $step = 4;
        }
    }
}

// Tampilan form sesuai step
if ($step === 1) {
?>
    <form method="post">
        <label>Nama Anda :</label>
        <input type="text" name="nama" required>
        <input type="hidden" name="step" value="1">
        <br><br>
        <button type="submit">SUBMIT</button>
    </form>
<?php
} elseif ($step === 2) {
?>
    <form method="post">
        <label>Umur Anda :</label>
        <input type="number" name="umur" required>
        <input type="hidden" name="step" value="2">
        <input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        <br><br>
        <button type="submit">SUBMIT</button>
    </form>
<?php
} elseif ($step === 3) {
?>
    <form method="post">
        <label>Hobi Anda :</label>
        <input type="text" name="hobi" required>
        <input type="hidden" name="step" value="3">
        <input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        <input type="hidden" name="umur" value="<?php echo htmlspecialchars($umur); ?>">
        <br><br>
        <button type="submit">SUBMIT</button>
    </form>
<?php
} else {
?>
    <div style="border:1px solid #000; padding:10px; width:250px;">
        Nama: <?php echo htmlspecialchars($nama); ?><br>
        Umur: <?php echo htmlspecialchars($umur); ?><br>
        Hobi: <?php echo htmlspecialchars($hobi); ?>
    </div>
<?php
}
?>