<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php 
// TODO 1: Inisialisasi data session
session_start();
// TODO 2: Hapus session
// Jika hanya ingin menghapus session terkait keranjang belanja
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
// TODO 3: Redirect ke halaman view_books.php
header('Location: view_books.php');
?>