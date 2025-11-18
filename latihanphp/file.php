<?php
// Menulis ke file (append) dengan lock
$filePath = "data.txt";
$dataToWrite = "Contoh Teks " . date('Y-m-d H:i:s') . PHP_EOL;
file_put_contents($filePath, $dataToWrite, FILE_APPEND | LOCK_EX);

// Membaca file
echo "<strong>Isi file data.txt:</strong><br>";
if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
} else {
    echo "File tidak ditemukan.";
}
?>
