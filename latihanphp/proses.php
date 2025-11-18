<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sanitasi sederhana
    $nama = htmlspecialchars(trim($_POST['nama']));
    $umur = (int) $_POST['umur'];
    echo "Nama: $nama<br>Umur: $umur";
} else {
    echo "Akses tidak valid.";
}
?>
