<?php 
include_once 'koneksi.php';

// Ambil data dari form
$nama_bulan = htmlspecialchars(trim($_POST['nama_bulan']));
$tahun = htmlspecialchars(trim($_POST['tahun']));
$pembayaran_perminggu = htmlspecialchars(trim($_POST['pembayaran_perminggu']));

// SQL Injection
$nama_bulan = escape($nama_bulan);
$tahun = escape($tahun);
$pembayaran_perminggu = escape($pembayaran_perminggu);

// Menambahkan record bulan baru
$insert = mysqli_query($koneksi, "INSERT INTO bulan_pembayaran VALUES(NULL, '$nama_bulan', '$tahun', '$pembayaran_perminggu')");

// Ambil ID bulan yg telah ditambah
$id = mysqli_insert_id($koneksi);

// Ambil ID siswa
$query = mysqli_query($koneksi, "SELECT id_siswa FROM siswa");

// Looping
while($data = mysqli_fetch_array($query)):

    $id_siswa = $data['id_siswa'];
    
    $query2 = mysqli_query($koneksi, "INSERT INTO uang_kas VALUES(NULL, '$id_siswa', '$id', '0', '0', '0', '0', 'Belum lunas')");

    if ( $query2 ) {
        echo "<script>
	            alert('Bulan baru berhasil ditambahkan');
	            document.location.href = 'uang_kas.php';
	        </script>";
    } else {
        echo "<script>
            	alert('Bulan baru gagal ditambahkan!');
            	document.location.href = 'uang_kas.php';
        	</script>";
    }

endwhile;


?>