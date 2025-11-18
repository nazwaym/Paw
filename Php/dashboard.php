<?php
    session_start();
    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- PANGGIL CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "layout/header.html" ?>

<main class="dashboard-container">

    <?php if (!isset($_SESSION["username"])): ?>

        <!-- ============================
             TAMPILAN UNTUK BELUM LOGIN
        ============================ -->
        <div class="dashboard-card guest-card">
            <h1>🚪 Belum Login</h1>
            <p class="subtext">
                Kamu belum login. Silakan masuk untuk mengakses dashboard.
            </p>

            <a href="login.php" class="btn-login">Login Sekarang</a>
            <a href="register.php" class="btn-register">Daftar Akun</a>

            <div class="notice">
                <p>🔐 Akses dashboard hanya untuk pengguna terdaftar</p>
            </div>
        </div>

    <?php else: ?>

        <!-- ============================
                TAMPILAN SAAT SUDAH LOGIN
        ============================ -->
        <div class="dashboard-card">
            <h1>Selamat Datang, <span><?= $_SESSION["username"] ?></span> 👋</h1>

            <p class="subtext">Senang melihatmu kembali di dashboard!</p>

            <!-- Mini Card Stats Biar Lebih Hidup -->
            <div class="stats">
                <div class="stat-box">
                    <h3>12</h3>
                    <p>Aktivitas</p>
                </div>
                <div class="stat-box">
                    <h3>5</h3>
                    <p>Pesan Baru</p>
                </div>
                <div class="stat-box">
                    <h3>3</h3>
                    <p>Notifikasi</p>
                </div>
            </div>

            <form action="dashboard.php" method="POST">
                <button type="submit" name="logout" class="btn-logout">Logout</button>
            </form>
        </div>

    <?php endif; ?>

</main>

<?php include "layout/footer.html" ?>

</body>
</html>
