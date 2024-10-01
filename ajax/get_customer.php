<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php
require_once('../lib/db_login.php');
$customerid = $_GET['id'];
// Asign a query
$query = " SELECT * FROM customers where customerid=" . $customerid;
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br> />" . $db->error);
}
// Fetch and display the results
while ($row = $result->fetch_object()) {
    echo '<div class="customers-detail">';
    echo '<div class="detail-row"><strong>Name   :</strong> <span>' . $row->name . '</span></div>';
    echo '<div class="detail-row"><strong>Address:</strong> <span>' . $row->address . '</span></div>';
    echo '<div class="detail-row"><strong>Country:</strong> <span>' . $row->city . '</span></div>';  
    echo '<div class="detail-row"><strong>Cust. ID:</strong> <span>' . $row->customerid . '</span></div>';
    echo '</div>';
}
$result->free();
$db->close();
?>
<style>
    .customers-detail {
        display: flex;
        flex-direction: column;
    }

    .detail-row {
        display: flex;
        justify-content: flex-start;
    }

    .detail-row strong {
        width: 70px; 
    }

    .detail-row span {
        flex-grow: 1;
    }
</style>
