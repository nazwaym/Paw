<?php 
    include "service/database.php";
    session_start();

    if (isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
        exit;
    }

    if (isset($_POST["register"])) {
        $nama_lengkap = $_POST["nama_lengkap"];
        $username     = $_POST["username"];
        $password     = $_POST["password"];

        $hash_password = hash('sha256', $password);

        try {
            $sql = "INSERT INTO users (nama_lengkap, username, password) 
                    VALUES ('$nama_lengkap', '$username', '$hash_password')";
            
            if ($db->query($sql)) {
                echo "<script>alert('User Baru berhasil ditambahkan!');</script>";
            } else {
                echo "<script>alert('User Baru GAGAL, Silahkan Coba lagi!');</script>";
            }
        } catch(mysqli_sql_exception $e) {
            echo "<script>alert('User sudah ada, silakan ganti username lain!');</script>";
        }

        $db->close();
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "layout/header.html"; ?>

<main class="auth-container">
    <div class="auth-card">
        <h2 class="auth-title">Buat Akun Baru</h2>
        <p class="auth-subtext">Isi data di bawah untuk membuat akun</p>

        <form action="register.php" method="POST" class="auth-form">
            
            <div class="input-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="nama_lengkap"
                    name="nama_lengkap" 
                    placeholder="Masukkan Nama Lengkap" 
                    required
                >
            </div>

            <div class="input-group">
                <label for="username">Username</label>
                <input 
                    type="text" 
                    id="username"
                    name="username" 
                    placeholder="Masukkan Username"
                    required
                >
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    placeholder="Masukkan Password"
                    required
                >
            </div>

            <button type="submit" name="register" class="btn-primary">Register</button>
        </form>

        <p class="auth-footer">
            Sudah punya akun?
            <a href="login.php">Login sekarang</a>
        </p>
    </div>
</main>

<?php include "layout/footer.html"; ?>

</body>
</html>
