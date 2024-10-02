<?php
session_start();
require "db.php";

if(isset($_COOKIE['remember_me'])){
    $_SESSION["username"] = $_COOKIE["remember_me"];
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember_me = isset($_POST["remember_me"]) ? true : false;

    $sql = "SELECT * FROM users WHERE username = :username";
    $statement = $pdo->prepare($sql);
    $statement-> execute(["username" => $username]);
    $user = $statement -> fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password"])){
    $_SESSION["username"] = $username;

    if($remember_me){
        setcookie("remember_me", $username, time() + (86400 * 2), "/");
    }

    header("Location: dashboard.php");
    exit;
}
else {
    echo "Login gagal. Periksa username atau password Anda";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet"/>
</head>
<body>
    <div id="form-container">
        <h1>Daftar Akun</h1>
        <form action="index.php" method="post">
            Username:
            <br>
            <input type="text" name="username" placeholder="Username" required>
            <br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <label id="remember_me">
                <input type="checkbox" name="remember_me">Ingat saya?
            </label>
            <br>
            <button type="submit" name="submit">Login</button>
            <br>
            <br>
            <p>Belum punya akun? <a href="register.php">Registrasi disini</a></p>
        </form>
    </div>
</body>
</html>

<?php
include("footer.html");
?>