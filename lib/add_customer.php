<?php include('../lib/header.php') ?>
<br>
<div class="card">
<div class="card-header">Add Customer</div>
<div class="card-body">
<?php

// Include file koneksi database
require_once ('../lib/db_login.php');

// Inisialisasi variabel
$name = $address = $city = "";
$name_err = $address_err = $city_err = "";

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi input name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validasi input address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validasi input city
    if (empty(trim($_POST["city"]))) {
        $city_err = "Please enter a city.";
    } else {
        $city = test_input($_POST["city"]);
    }

    // Jika tidak ada error, masukkan data ke database
    if (empty($name_err) && empty($address_err) && empty($city_err)) {
        $query = "INSERT INTO customers (name, address, city) VALUES (?, ?, ?)";
        if ($stmt = $db->prepare($query)) {

            // Bind parameter
            $stmt->bind_param("sss", $name, $address, $city);

            // Eksekusi statement
            if ($stmt->execute()) {

                // Redirect ke halaman view_customer.php setelah data berhasil ditambahkan
                header("Location: view_customer.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error: '. $stmt->error .'</div>';
            }

            // Close statement
            $stmt->close();
        }
    }
}
?>

<!-- Form untuk menambah customer -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
        <span class="text-danger"><?php echo $name_err; ?></span>
    </div>
    <div class="form-group">
        <label>Address</label>
        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" required>
        <span class="text-danger"><?php echo $address_err; ?></span>
    </div>
    <div class="form-group">
        <label>City</label>
        <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" required>
        <span class="text-danger"><?php echo $city_err; ?></span>
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Add Customer">
</form>
</div>
</div>
<?php include('../lib/footer.php') ?>