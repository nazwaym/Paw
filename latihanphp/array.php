<?php
// Indexed array
$buah = array("Apel", "Jeruk", "Mangga");
echo "<strong>Indexed array:</strong><br>";
foreach ($buah as $item) {
    echo $item . "<br>";
}

echo "<hr>";

// Associative array
$siswa = array("nama" => "Andi", "umur" => 17);
echo "<strong>Associative array:</strong><br>";
echo "Nama: " . $siswa["nama"] . ", Umur: " . $siswa["umur"];
?>
