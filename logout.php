<?php
session_start();
session_destroy();

// Hapus cookie "Remember Me"
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/"); // Menghapus cookie
}

header("Location: index.php");
exit;
?>