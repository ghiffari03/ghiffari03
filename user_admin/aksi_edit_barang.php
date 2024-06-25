<?php
include("../koneksi.php");

if(isset($_POST['submit'])){
    // Mengambil data yang dikirimkan dari form
    $id_barang = $_POST['edit_id_barang'];
    $nama_barang = $_POST['edit_nama_barang'];
    $deskripsi_barang = $_POST['edit_deskripsi_barang'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Jika ada file gambar yang diunggah
    if ($_FILES['file']['name']) {
        $nama_file = $_FILES['file']['name'];
        $ukuran_file = $_FILES['file']['size'];
        $tmp_file = $_FILES['file']['tmp_name'];
        $path = "../img/" . $nama_file;

        // Pindahkan file ke direktori yang ditentukan
        if (move_uploaded_file($tmp_file, $path)) {
            // Update data barang ke database
            $sql = "UPDATE barang SET nama_barang='$nama_barang', deskripsi='$deskripsi_barang', harga='$harga', stok='$stok', jenis='$jenis', gambar='$nama_file' WHERE id_barang='$id_barang'";
            if ($koneksi->query($sql) === TRUE) {
                // Jika berhasil diupdate, kembali ke halaman daftar barang dengan pesan berhasil
                header("Location: daftar_barang.php?pesan=edit_berhasil");
            } else {
                // Jika gagal diupdate, kembali ke halaman daftar barang dengan pesan gagal
                header("Location: daftar_barang.php?pesan=edit_gagal");
            }
        } else {
            // Jika gagal memindahkan file, kembali ke halaman daftar barang dengan pesan gagal
            echo "Error updating record: " . $koneksi->error;
        }
    } else {
        // Jika tidak ada file gambar yang diunggah, hanya update data tanpa memperbarui gambar
        $sql = "UPDATE barang SET nama_barang='$nama_barang', deskripsi='$deskripsi_barang', harga='$harga', stok='$stok', jenis='$jenis' WHERE id_barang='$id_barang'";
        if ($koneksi->query($sql) === TRUE) {
            // Jika berhasil diupdate, kembali ke halaman daftar barang dengan pesan berhasil
            header("Location: daftar_barang.php?pesan=edit_berhasil");
        } else {
            // Jika gagal diupdate, kembali ke halaman daftar barang dengan pesan gagal
            header("Location: daftar_barang.php?pesan=edit_gagal");
        }
    }
} else {
    // Jika form tidak disubmit, kembali ke halaman daftar barang
    header("Location: daftar_barang.php");
}
?>