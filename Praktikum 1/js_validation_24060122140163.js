function generateCaptcha() {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    let captcha = '';
    for (let i = 0; i < 5; i++) {
        captcha += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    document.getElementById('captcha').value = captcha;
}

function updateSubKategori() {
    const kategori = document.getElementById('kategori').value;
    const subKategori = document.getElementById('subKategori');
    subKategori.innerHTML = '<option value="">Pilih Sub Kategori</option>';
    
    
    if (kategori === 'Baju') {
        ['Baju Pria', 'Baju Wanita', 'Baju Anak'].forEach(sub => {
            subKategori.innerHTML += `<option value="${sub}">${sub}</option>`;
        });
    } else if (kategori === 'Elektronik') {
        ['Mesin Cuci', 'Kulkas', 'AC'].forEach(sub => {
            subKategori.innerHTML += `<option value="${sub}">${sub}</option>`;
        });
    } else if (kategori === 'Alat Tulis') {
        ['Kertas', 'Map', 'Pulpen'].forEach(sub => {
            subKategori.innerHTML += `<option value="${sub}">${sub}</option>`;
        });
    }
}

function toggleHargaGrosir() {
    const grosir = document.getElementById('grosir').value;
    const hargaGrosirContainer = document.getElementById('hargaGrosirContainer');
    hargaGrosirContainer.style.display = grosir === 'Ya' ? 'block' : 'none';
    document.getElementById('hargaGrosir').required = grosir === 'Ya';
}

document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let isValid = true;
    let errorMessage = '';

    // Validasi Nama Produk
    const namaProduk = document.getElementById('namaProduk');
    if (namaProduk.value.length < 5 || namaProduk.value.length > 30) {
        isValid = false;
        errorMessage += 'Nama produk harus antara 5-30 karakter.\n';
    }

    // Validasi Deskripsi Produk
    const deskripsiProduk = document.getElementById('deskripsiProduk');
    if (deskripsiProduk.value.length < 5 || deskripsiProduk.value.length > 100) {
        isValid = false;
        errorMessage += 'Deskripsi produk harus antara 5-100 karakter.\n';
    }

    // Validasi Kategori dan Sub Kategori
    const kategori = document.getElementById('kategori');
    const subKategori = document.getElementById('subKategori');
    if (kategori.value === '' || subKategori.value === '') {
        isValid = false;
        errorMessage += 'Kategori dan Sub Kategori harus dipilih.\n';
    }

    // Validasi Harga Satuan
    const hargaSatuan = document.getElementById('hargaSatuan');
    if (isNaN(hargaSatuan.value) || hargaSatuan.value === '') {
        isValid = false;
        errorMessage += 'Harga satuan harus berupa angka.\n';
    }

    // Validasi Harga Grosir
    const grosir = document.getElementById('grosir');
    const hargaGrosir = document.getElementById('hargaGrosir');
    if (grosir.value === 'Ya' && (isNaN(hargaGrosir.value) || hargaGrosir.value === '')) {
        isValid = false;
        errorMessage += 'Harga grosir harus diisi jika pilihan Grosir adalah Ya.\n';
    }

    // Validasi Jasa Kirim
    const jasaKirim = document.querySelectorAll('input[name="jasaKirim"]:checked');
    if (jasaKirim.length < 3) {
        isValid = false;
        errorMessage += 'Pilih minimal 3 jasa kirim.\n';
    }

    // Validasi Captcha
    const captcha = document.getElementById('captcha').value;
    const captchaInput = document.getElementById('captchaInput').value;
    if (captcha !== captchaInput) {
        isValid = false;
        errorMessage += 'Captcha tidak sesuai.\n';
    }

    if (!isValid) {
        alert(errorMessage);
    } else {
        alert('Form berhasil disubmit!');
        this.reset();
        generateCaptcha();
    }
});