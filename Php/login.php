<?php 
    include "service/database.php";
    session_start();
    // cek apakah sudah login
    if (isset($_SESSION["is_login"]))  {
        header("location: dashboard.php");
        exit;
    }
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $hash_password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            header("location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Akun Gagal, Silahkan coba lagi!');</script>";
        }

        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include "layout/header.html" ?>

    <main class="auth-container">
        <div class="auth-card">
            <h2 class="auth-title">Masuk ke Akunmu</h2>
            <p class="auth-subtext">Silakan login untuk melanjutkan</p>

            <form action="login.php" method="POST" class="auth-form">
                
                <div class="input-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username"
                        name="username" 
                        placeholder="Masukkan username"
                        required
                    >
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" name="login" class="btn-primary">Login</button>
            </form>

            <p class="auth-footer">
                Belum punya akun?
                <a href="register.php">Daftar sekarang</a>
            </p>
        </div>
    </main>

    <?php include "layout/footer.html" ?>

</body>
</html>
