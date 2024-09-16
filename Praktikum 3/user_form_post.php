<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 300px;
            padding: 20px;
            background-color: #E7F0DC;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        .buttons {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
        }
        button[type="reset"] {
            background-color: #729762;
            color: white;
        }
        button[type="submit"] {
            background-color: #729762;
            color: white;
        }
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Form Input Siswa</h2>
        <form id="formSiswa" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="nis">NIS:</label>
                <input type="text" id="nis" name="nis" minlength="10" maxlength="10" pattern="\d{10}" title="NIS harus berupa 10 angka" required>
                <div id="nis-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
                <div id="nama-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <label for="pria"><input type="radio" id="pria" name="jenis_kelamin" value="Pria" required> Pria</label>
                <label for="wanita"><input type="radio" id="wanita" name="jenis_kelamin" value="Wanita" required> Wanita</label>
                <div id="jenis_kelamin-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <select id="kelas" name="kelas" onchange="toggleEkstrakurikuler()" required>
                    <option value="">Pilih Kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
                <div id="kelas-error" class="error-message"></div>
            </div>

            <div class="form-group" id="ekstrakurikuler" style="display: none;">
                <label>Ekstrakurikuler:</label>
                <label for="pramuka"><input type="checkbox" id="pramuka" name="ekstrakurikuler" value="Pramuka"> Pramuka</label>
                <label for="senitari"><input type="checkbox" id="senitari" name="ekstrakurikuler" value="Seni Tari"> Seni Tari</label>
                <label for="sinematografi"><input type="checkbox" id="sinematografi" name="ekstrakurikuler" value="Sinematografi"> Sinematografi</label>
                <label for="basket"><input type="checkbox" id="basket" name="ekstrakurikuler" value="Basket"> Basket</label>
                <div id="ekstrakurikuler-error" class="error-message"></div>
            </div>

            <div class="buttons">
                <button type="submit">Submit</button>
                <button type="reset" onclick="resetForm()">Reset</button>
            </div>
        </form>
    </div>

    <script>
        function toggleEkstrakurikuler() {
            const kelas = document.getElementById("kelas").value;
            const ekstrakurikuler = document.getElementById("ekstrakurikuler");

            // Tampilkan pilihan ekstrakurikuler untuk kelas X dan XI
            if (kelas === "X" || kelas === "XI") {
                ekstrakurikuler.style.display = "block";
            } else {
                ekstrakurikuler.style.display = "none";
                // Reset checkbox saat tidak tampil
                document.querySelectorAll('input[name="ekstrakurikuler"]').forEach(checkbox => {
                    checkbox.checked = false;
                });
                document.getElementById('ekstrakurikuler-error').innerHTML = "";
            }
        }

        function validateForm() {
            // Reset pesan kesalahan
            document.querySelectorAll('.error-message').forEach(e => e.innerHTML = '');

            const nis = document.getElementById("nis").value;
            const kelas = document.getElementById("kelas").value;
            const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            const checkboxes = document.querySelectorAll('input[name="ekstrakurikuler"]:checked');

            let valid = true;

            // Validasi NIS hanya angka dan harus 10 digit
            if (!/^\d{10}$/.test(nis)) {
                document.getElementById('nis-error').innerHTML = "NIS harus terdiri dari 10 angka.";
                valid = false;
            }

            // Validasi nama
            if (document.getElementById("nama").value.trim() === "") {
                document.getElementById('nama-error').innerHTML = "Nama tidak boleh kosong.";
                valid = false;
            }

            // Validasi jenis kelamin
            if (!jenisKelamin) {
                document.getElementById('jenis_kelamin-error').innerHTML = "Jenis kelamin harus dipilih.";
                valid = false;
            }

            // Validasi ekstrakurikuler untuk kelas X atau XI
            if (kelas === "X" || kelas === "XI") {
                if (checkboxes.length < 1 || checkboxes.length > 3) {
                    document.getElementById('ekstrakurikuler-error').innerHTML = "Pilih minimal 1 dan maksimal 3 kegiatan ekstrakurikuler.";
                    valid = false;
                }
            }

            return valid;
        }

        function resetForm() {
            // Bersihkan semua pesan kesalahan
            document.querySelectorAll('.error-message').forEach(e => e.innerHTML = '');
            document.getElementById("ekstrakurikuler").style.display = "none";
        }
    </script>

</body>
</html>