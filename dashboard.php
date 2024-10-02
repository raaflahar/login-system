<?php
session_start();

// if(!isset($_SESSION["username"])){
//     header("Location: index.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div id="dashboard-container">
        <h1 id="dashboard-h1">Selamat Datang, <?= $_SESSION["username"];?></h1>
        <hr>
        <br>
        <p id="dashboard-p">Terima kasih telah mengunjungi Portofolio saya. Semoga Anda sehat selalu <i class="fas fa-heart" style="font-size: 24px; color: red;"></i></p>
    </div>    
</body>
</html>

<?php
include("footer.html");
?>