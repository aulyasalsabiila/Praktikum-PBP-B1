<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
// TODO 1: Inisialisasi session
session_start();
$id = $_GET['id'];
if ($id != "") {
    // jika $_SESSION['cart'] belum ada, maka inisialisasi dengan array kosong
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Tambahkan jumlah jika item sudah ada di cart
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>
<!-- Menampilkan isi shopping cart -->
<?php include('../lib/header.php') ?>
<br>
<div class="card">
<div class="card-header">Shopping Cart</div>
<div class="card-body">
<br>
<table class="table table-striped">
    <tr>
        <th>ISBN</th>
        <th>Author</th>
        <th>Title</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Price * Qty</th>
    </tr>
<?php
// Include our login information
require_once('../lib/db_login.php');
$sum_qty = 0; // Inisialisasi total item di shopping cart
$sum_price = 0; // Inisialisasi total price di shopping cart
if (is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        $query = " SELECT * FROM books WHERE isbn='".$id."'";
        $result = $db->query($query);
        if (!$result) {
            die ("Could not query the database: <br>". $db->error ."<br>Query: ".$query);
        }
        // TODO 2: Tuliskan dan eksekusi query
        while ($row = $result->fetch_object()) {
            echo '<tr>';
            echo '<td>'.$row->isbn.'</td>';
            echo '<td>'.$row->author.'</td>';
            echo '<td>'.$row->title.'</td>';
            echo '<td> $'.$row->price.'</td>';
            echo '<td>'.$qty.'</td>';
            echo '<td> $'.number_format($row->price * $qty, 2).'</td>';
            echo '</tr>';
            $sum_qty += $qty;
            $sum_price += ($row->price * $qty);
        }
    }
    // Tambahkan baris total
    echo '<tr>';
    echo '<td colspan="4" align="right"></td>';
    echo '<td>'.$sum_qty.'</td>';
    echo '<td> $'.number_format($sum_price, 2).'</td>';
    echo '</tr>';
    $result->free();
    $db->close();
} else {
    echo'<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
}
?>
</table>
<!-- Tampilkan total item -->
Total items = <?php echo $sum_qty; ?><br><br>
<a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
<a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br /><br />
</div>
</div>
<?php include('../lib/footer.php') ?>