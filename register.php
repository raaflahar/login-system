<?php
require "db.php";
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validasi username
    if (empty($username)){
        $errors[] = "Username tidak boleh kosong";
    }

    // Validasi password
    if (empty($password)){
        $errors[] = "Password tidak boleh kosong";
    }

    if (strlen($password) < 6){
        $errors[] = "Password minimal 6 karakter";
    }

    // Validasi konfirmasi password
    if ($password !== $confirm_password){
        $errors[] = "Password dan konfirmasi password tidak sama";
    }

    // Cek username pernah digunakan atau tidak
    $statement = $pdo -> prepare("SELECT * FROM users WHERE username = :username"); // Menyiapkan query SQL dengan mengecek apakah username ada
    $statement -> execute(["username" => $username]);
    if ($statement -> rowCount() > 0){
        $errors[] = "Username sudah digunakan sebelumnya!";
    }

    // Registrasi -> Jika error kosong
    if (empty($errors)){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $pdo -> prepare($sql);
        $statement -> execute(["username" => $username, "password" => $hashed_password]);
        echo "Registrasi berhasil. Silakan <a href='index.php'>Login</a>";
        
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Registrasi</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"/>
</head>
<body>
    <div id="form-container">
        <h1>Registrasi Diri Anda</h1>
        <form action="index.php" method="post">
            <?php if (!empty($errors)):?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            Username
            <br>
            <input type="text" name="username" placeholder="Username" required>
            <br>
            Password
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            Konfirmasi Password
            <br>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <br>
            <button type="submit" name="submit">Submit</button>
            <a href="index.php">Sudah punya akun?</a>
        </form>
    </div>    
</body>
</html>

<?php
    include("footer.html");
?>