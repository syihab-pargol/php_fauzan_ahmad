<?php
// Ambil nilai jml dari query string
$jml = isset($_GET['jml']) ? (int)$_GET['jml'] : 0;

echo "<table border=1 cellspacing=0 cellpadding=10 style='border-collapse:collapse; text-align:center;'>\n";

for ($a = $jml; $a > 0; $a--) {
    // Hitung total baris ini
    $total = 0;
    for ($b = $a; $b > 0; $b--) {
        $total += $b;
    }

    // Baris total
    echo "<tr><td colspan=\"$jml\"><b>TOTAL: $total</b></td></tr>\n";

    // Baris angka (mulai dari kiri)
    echo "<tr>\n";
    for ($b = $a; $b > 0; $b--) {
        echo "<td>$b</td>";
    }
    // Sisa kolom kosong supaya jumlah kolom tetap $jml
    for ($c = 0; $c < $jml - $a; $c++) {
        echo "<td>&nbsp;</td>";
    }
    echo "</tr>\n";
}

echo "</table>";
?>
