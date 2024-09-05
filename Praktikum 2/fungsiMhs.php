<?php
// Fungsi untuk menghitung rata-rata nilai
function hitung_rata($array) {
    return array_sum($array) / count($array);
}

// Fungsi untuk memformat angka
function format_angka($angka) {
    if ($angka == floor($angka)) {
        return number_format($angka, 0);
    } else {
        return rtrim(rtrim(number_format($angka, 12), '0'), '.');
    }
}

// Fungsi untuk menampilkan data mahasiswa
function print_mhs($array_mhs) {
    echo "<table border='2'>
            <tr>
                <th> Nama    </th>
                <th> Nilai 1 </th>
                <th> Nilai 2 </th>
                <th> Nilai 3 </th>
                <th> Rata-rata </th>
            </tr>";
    
    foreach ($array_mhs as $nama => $nilai) {
        $rata = hitung_rata($nilai);
        $rata_formatted = format_angka($rata);
        
        echo "<tr>
                <td>$nama</td>
                <td>{$nilai[0]}</td>
                <td>{$nilai[1]}</td>
                <td>{$nilai[2]}</td>
                <td>$rata_formatted</td>
              </tr>";
    }
    
    echo "</table>";
}

// Array mahasiswa
$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi' => array(98, 65, 74),
    'Nina' => array(67, 56, 84)
);

// Memanggil fungsi untuk menampilkan data mahasiswa
print_mhs($array_mhs);
?>