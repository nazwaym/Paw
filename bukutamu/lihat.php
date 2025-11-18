<?php
session_start();

$success_message = $_SESSION['success_message'] ?? null;

unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Buku Tamu — Daftar Pesan</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="style.css" />
</head>

<body class="page-list">

  <div class="container container-list">
    <header class="header">
      <h1>Buku Tamu</h1>
      <p class="subtitle">Kumpulan pesan dari para tamu.</p>
    </header>

    <main class="card guest-list" aria-labelledby="list-title">
      <h2 id="list-title">Daftar Pesan</h2>

      <?php
      if ($success_message) {
          echo '<div class="alert-success">' . htmlspecialchars($success_message) . '</div>';
      }

      $file = __DIR__ . '/bukutamu.txt';

      if (!file_exists($file) || filesize($file) === 0) {
          echo '<div class="empty-state">Belum ada pesan. Silakan isi <a class="link-small" href="bukutamu.php">form buku tamu</a>.</div>';
      } else {
          $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
          $lines = array_filter($lines, function($l){ return trim($l) !== ""; });

          if (count($lines) === 0) {
              echo '<div class="empty-state">Belum ada pesan.</div>';
          } else {
              $lines = array_reverse($lines);
              echo '<ul class="messages">';
              
              foreach ($lines as $ln) {
                  $parts = explode("|", $ln, 4);
                  $waktu = $parts[0] ?? '';
                  $nama  = $parts[1] ?? 'Tamu';
                  $mood  = $parts[2] ?? '';
                  $pesan = $parts[3] ?? '';

                  $pesan = str_replace('\\n', "\n", $pesan);

                  $waktu_html = htmlspecialchars($waktu);
                  $nama_html  = htmlspecialchars($nama);
                  $mood_html  = htmlspecialchars($mood);
                  $pesan_html = nl2br(htmlspecialchars($pesan));
                  
                  $mood_icon = '';
                  if ($mood_html === 'Senang') $mood_icon = '😊 ';
                  if ($mood_html === 'Terkesan') $mood_icon = '🤩 ';
                  if ($mood_html === 'Biasa') $mood_icon = '🙂 ';

                  echo '<li class="message" data-mood="' . $mood_html . '">';
                  echo '  <div class="msg-header">';
                  echo '    <div class="msg-author-info">';
                  echo '      <span class="msg-name">' . $nama_html . '</span>';
                  if (!empty($mood_html)) {
                      echo '    <span class="msg-mood">' . $mood_icon . $mood_html . '</span>';
                  }
                  echo '    </div>';
                  echo '    <span class="msg-time">' . $waktu_html . '</span>';
                  echo '  </div>';
                  echo '  <div class="msg-body">' . $pesan_html . '</div>';
                  echo '</li>';
              }
              echo '</ul>';

              $total = count($lines);
              echo '<div class="total-count">Total pesan: <strong>' . $total . '</strong></div>';
          }
      }
      ?>

      <p style="margin-top: 24px; text-align: center;">
        <a class="link-small" href="bukutamu.php">← Kembali ke Form</a>
      </p>
    </main>

    <footer class="footer">
      <p>&copy; <span id="year"></span> Nazwa Yulianti Munjana - 1237050007</p>
    </footer>
  </div>

  <script>
      document.getElementById('year').textContent = new Date().getFullYear();
  </script>

</body>
</html>
