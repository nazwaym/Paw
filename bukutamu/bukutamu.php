<?php
session_start();

$error_message = $_SESSION['form_error'] ?? null;

$old_nama = $_SESSION['old_input']['nama'] ?? '';
$old_pesan = $_SESSION['old_input']['pesan'] ?? '';
$old_mood = $_SESSION['old_input']['mood'] ?? '';

unset($_SESSION['form_error']);
unset($_SESSION['old_input']);
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Buku Tamu — Isi Pesan</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css" />
  </head>
  
  <body>
    <div class="container">
      <header class="header">
        <h1>Buku Tamu</h1>
        <p>Isi pesan singkat — tampilan sederhana dan mudah digunakan.</p>
      </header>

      <section class="card" aria-labelledby="form-title">
        <h2 id="form-title">Isi Pesan</h2>

        <?php
        if ($error_message) {
            echo '<div class="alert-error">' . htmlspecialchars($error_message) . '</div>';
        }
        ?>

        <form id="guestbook-form" action="simpan.php" method="post" novalidate>
          <div class="form-row">
            <label for="nama">Nama</label>
            <input
              id="nama"
              name="nama"
              type="text"
              placeholder="Contoh: Budi Santoso"
              required
              value="<?php echo htmlspecialchars($old_nama); ?>"
            />
          </div>

          <div class="form-row">
            <label for="pesan">Pesan</label>
            <textarea
              id="pesan"
              name="pesan"
              placeholder="Tulis kesan atau salam..."
              required
            ><?php echo htmlspecialchars($old_pesan); ?></textarea>
          </div>

          <div class="form-row">
            <label>Perasaan</label>
            <div class="mood-row" role="radiogroup" aria-label="Perasaan">
              <label class="mood-btn">
                <input type="radio" name="mood" value="Senang" required 
                       <?php if ($old_mood === 'Senang') echo 'checked'; ?> />
                <span>Senang</span>
              </label>
              <label class="mood-btn">
                <input type="radio" name="mood" value="Biasa" 
                       <?php if ($old_mood === 'Biasa') echo 'checked'; ?> />
                <span>Biasa</span>
              </label>
              <label class="mood-btn">
                <input type="radio" name="mood" value="Terkesan" 
                       <?php if ($old_mood === 'Terkesan') echo 'checked'; ?> />
                <span>Terkesan</span>
              </label>
            </div>
          </div>

          <div style="margin-top: 12px">
            <button class="btn btn-primary" id="submit-button" type="submit">
              Kirim Pesan
            </button>
          </div>
        </form>

        <p style="margin-top: 24px; text-align: center">
          <a class="link-small" href="lihat.php">Lihat semua pesan →</a>
        </p>
      </section>

      <footer class="footer">
        <p>&copy; <span id="year"></span> Nazwa Yulianti Munjana - 1237050007</p>
      </footer>
    </div>

    <script>
      document.getElementById("year").textContent = new Date().getFullYear();
      document
        .getElementById("guestbook-form")
        .addEventListener("submit", function (e) {
          const btn = document.getElementById("submit-button");
          if (!this.checkValidity()) return;
          btn.disabled = true;
          btn.textContent = "Mengirim...";
        });
    </script>
  </body>
</html>
