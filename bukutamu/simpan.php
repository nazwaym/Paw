<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: bukutamu.php');
    exit;
}

$file_path = __DIR__ . '/bukutamu.txt';

$nama  = trim($_POST['nama'] ?? '');
$pesan = trim($_POST['pesan'] ?? '');
$mood  = trim($_POST['mood'] ?? '');

if ($nama === '' || $pesan === '') {
    $_SESSION['form_error'] = 'Nama dan Pesan tidak boleh kosong.';
    $_SESSION['old_input'] = $_POST;
    header('Location: bukutamu.php'); 
    exit;
}

date_default_timezone_set('Asia/Jakarta');

$hari_list = [
    'Sunday'    => 'Minggu',
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu'
];

$hari_inggris = date('l');
$hari_indonesia = $hari_list[$hari_inggris];

$waktu = $hari_indonesia . ', ' . date('Y-m-d H:i:s');

$nama_safe  = str_replace('|', '-', $nama);
$mood_safe  = str_replace('|', '-', $mood);
$pesan_safe = str_replace(["\r\n", "\r", "\n"], '\\n', $pesan);

$line = $waktu . '|' . $nama_safe . '|' . $mood_safe . '|' . $pesan_safe . PHP_EOL;

$result = @file_put_contents($file_path, $line, FILE_APPEND | LOCK_EX);

if ($result === false) {
    $_SESSION['form_error'] = 'Gagal menyimpan pesan. Pastikan folder writable.';
    $_SESSION['old_input'] = $_POST;
    header('Location: bukutamu.php');
    exit;
}

unset($_SESSION['form_error'], $_SESSION['old_input']);

$_SESSION['success_message'] = 'Pesan Anda berhasil terkirim!';
header('Location: lihat.php');
exit;
?>
