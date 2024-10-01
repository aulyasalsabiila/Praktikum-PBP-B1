<!-- Nama : Aulya Salsabila Khairunnisa
     NIM  : 24060122140163
     Lab  : B1 -->
<?php include('../lib/header.php');?>
<br>
<div class="card">
    <div class="card-header">Search Book Details</div>
    <div class="card-body">
        <!-- TODO: Buat elemen input untuk mencari dgn inputan judul buku-->
        <input type="text" id="book_title" onkeyup="searchBookByTitle()" placeholder="Search Book by Title here" class="form-control">
        <!-- Hint : gunakan onkeyup="searchBookByTitle()" untuk menerapkan live search -->
    </div>
</div><br>
<!-- TODO: Tambahkan elemen untuk menampilkan detail buku yang di cari -->
<div id="book_details"></div>
<?php include('../lib/footer.php');?>
<script src="ajax.js"></script>
