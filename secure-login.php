<?php
include("secure-db.php");
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"] ?? '';
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($action === "register") {
        // Kullanıcı var mı kontrolü
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "⚠️ Bu kullanıcı adı zaten var.";
        } else {
            // Şifreyi hashle
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Kullanıcıyı ekle
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $message = "✅ Kayıt başarılı. Giriş yapabilirsiniz.";
            } else {
                $message = "❌ Kayıt sırasında hata oluştu.";
            }
        }
    } elseif ($action === "login") {
        // Giriş işlemi
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Şifre doğrulama
            if (password_verify($password, $user['password'])) {
                $_SESSION["username"] = $username;
                header("Location: secure-dashboard.php");
                exit;
            } else {
                $message = "❌ Kullanıcı adı veya şifre yanlış.";
            }
        } else {
            $message = "❌ Kullanıcı adı veya şifre yanlış.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap / Kayıt Ol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 100px;
            max-width: 400px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
        .alert {
            margin-top: 15px;
        }
        .form-control {
            background-color: #f9f9f9;
            border: 1px solid #ced4da;
        }
        a {
            color: #007bff;
        }
        a:hover {
            text-decoration: none;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Giriş Yap / Kayıt Ol</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info text-center">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
            </div>
            <button type="submit" name="action" value="login" class="btn btn-primary">Giriş Yap</button>
            <button type="submit" name="action" value="register" class="btn btn-secondary">Kayıt Ol</button>
        </form>

    </div>
</body>
</html>