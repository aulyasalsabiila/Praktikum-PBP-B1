<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php 
// TODO 1: Inisialisasi session
session_start(); // Inisialisasi session
// TODO 2: Periksa apakah session dengan key 'email' terdefinisi
if (!isset($_SESSION['email'])) {
    // Jika tidak ada session email, arahkan pengguna ke halaman login
    header('Location: login.php');
    exit;
}
include('../lib/header.php'); 
?>
<br>
<div class="card">
    <div class="card-header">Admin Page</div>
    <div class="card-body">
        <p>Welcome...</p>
        <p>You are logged in as <b><?php echo $_SESSION['email']; ?></b></p>
        <br><br>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>
<?php include('../lib/footer.php'); ?>
