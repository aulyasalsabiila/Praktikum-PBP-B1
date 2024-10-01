<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
// TODO : Koneksi ke basis data
require_once('../lib/db_login.php');
// Cek koneksi
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
//TODO : Mendapatkan judul buku
$book_title = isset($_GET['title']) ? $_GET['title'] : '';
//TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
$query = "SELECT * FROM books WHERE title LIKE '%" . $db->real_escape_string($book_title) . "%'";
$result = $db->query($query);
//TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    echo "Error: " . $db->error;
    exit;
}
// Tampilkan jumlah hasil pencarian
$count = $result->num_rows;
echo "<div class='alert alert-info'>Ditemukan <strong>$count</strong> hasil pencarian.</div>";
//TODO : Tampilkan data customer dengan perulangan while
while($row = $result->fetch_object()){
    echo "<div class='card mb-2'>"; 
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($row->title) . "</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>Author: " . htmlspecialchars($row->author) . "</h6>";
    echo "<p class='card-text'>ISBN: " . htmlspecialchars($row->isbn) . "</p>";
    echo "<p class='card-text'>Price: $" . htmlspecialchars($row->price) . "</p>";
    echo "</div>";
    echo "</div>";
}
//TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();
?>