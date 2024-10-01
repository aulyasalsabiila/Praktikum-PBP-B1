<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
// TODO 1: Inisialisasi session
session_start(); // Memulai session
// TODO 2: Hapus username session
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    session_destroy();
}
// TODO 3: Redirect ke halaman login
header('Location: login.php'); // Redirect ke halaman login
?>