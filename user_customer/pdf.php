<?php

require '../../toko_tanaman/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

// Mulai penangkapan output
ob_start();

// Sertakan file PHP yang ingin Anda cetak
include 'tabel.php';

// Ambil konten yang dihasilkan oleh eksekusi kode PHP
$content = ob_get_clean();

// Tambahkan konten ke dalam objek MPDF
$mpdf->WriteHTML($content);

// Render dan output PDF
$mpdf->Output('kode_php.pdf', 'D');
