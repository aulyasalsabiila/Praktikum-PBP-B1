<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
// Include file koneksi database
require_once ('../lib/db_login.php');
// Cek apakah parameter id ada di URL
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Siapkan query delete
    $query = "DELETE FROM customers WHERE customerid = ?";
    if ($stmt = $db->prepare($query)) {
        // Bind parameter
        $stmt->bind_param("i", $param_id);
        // Set parameter
        $param_id = trim($_GET["id"]);
        // Eksekusi statement
        if ($stmt->execute()) {
            // Redirect ke halaman view_customer.php
            header("location: view_customer.php");
            exit();
        } else {
            echo "Error: Could not execute the query: " . $stmt->error;
        }
        // Close statement
        $stmt->close();
    }
} else {
    // Jika tidak ada id di URL, redirect ke halaman error
    header("location: error.php");
    exit();
}
// Tutup koneksi
$db->close();
?>