<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include "layout/header.html" ?>

    <main class="home-container">
        <div class="home-card">
            <h1 class="home-title">Halo! Selamat Datang 👋</h1>
            <p class="home-subtext">
                Silakan login atau register untuk melanjutkan ke halaman berikutnya.
            </p>

            <div class="home-buttons">
                <a href="login.php" class="btn-primary">Login</a>
                <a href="register.php" class="btn-outline">Register</a>
            </div>
        </div>
    </main>

    <?php include "layout/footer.html" ?>

</body>
</html>
