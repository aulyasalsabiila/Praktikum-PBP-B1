<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
// TODO 1: Buat sebuah sesi baru
session_start(); // Memulai sesi
// TODO 2: Lakukan koneksi dengan database
require_once('../lib/db_login.php');
// Inisialisasi variabel dengan nilai default
$email = $password = '';
$error_email = $error_password = '';
// Memeriksa apakah user sudah submit form
if (isset($_POST["submit"])) {
    $valid = TRUE; // Flag validasi
    // Memeriksa validasi email
    $email = trim($_POST['email']); // Menggunakan trim untuk menghindari spasi tambahan 
    if ($email == '') {
        $error_email = "Email is required";
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
        $valid = FALSE;
    }
    // Memeriksa validasi password
    $password = trim($_POST['password']); // Gunakan trim pada password juga
    if ($password == '') {
        $error_password = "Password is required";
        $valid = FALSE;
    }
    // Memeriksa validasi
    if ($valid) {
        // Mengecek hashing password menggunakan MD5
        $hashed_password = md5($password); // Hashing password setelah sanitasi
        // Tambahkan debug untuk mencetak password yang di-hash (hanya untuk debugging, hapus di production)
        echo "Password hashed (MD5): " . $hashed_password . "<br>";
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = " SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        // Cetak query untuk debugging (hanya untuk debugging, hapus di production)
        echo "Query: " . $query . "<br>";
        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />". $db->error);
        } else {
            if ($result->num_rows > 0) { // Jika ada hasil, login berhasil
                $_SESSION['email'] = $email; 
                header('Location: view_customer.php'); // Redirect ke halaman admin
                exit;
            } else { // Jika tidak ada hasil, login gagal
                echo '<span class="error">Combination of email and password are not correct.</span>';
            }
        }
        // TODO 5: Tutup koneksi dengan database
        $db->close();
    }
}
?>
<?php include('../lib/header.php') ?>
<br>
<div class="card ">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" size="30" value="<?php echo htmlspecialchars($email); ?>">
                <div class="error" style="color: red; font-size: 12px;">
                    <?php if (isset($error_email)) echo $error_email; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error" style="color: red; font-size: 12px;">
                    <?php if (isset($error_password)) echo $error_password; ?>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('../lib/footer.php') ?>
