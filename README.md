
/* 
|--------------------------------------------------------------------------
| CARA PENGGUNAAN API WAManager
| Whatsapp: (+62) 83-8001-80555
| Website: https://wa.raditek.co.id
| Untuk cara penggunaan selengkapnya bisa cek di tautan berikut:
| https://wa.raditek.co.id/dashboard/docs
|--------------------------------------------------------------------------
*/

/*
Contoh penggunaan fitur pengiriman pesan:
- Text Message
- Media Message (image, audio, video)
- Document Message (pdf, xls, xlsx, doc, docx)
*/

$WAManager = new WAManager(
    "YOUR_API_SECRET",
    "WHATSAPP_ACCOUNT_UNIQUE_ID"
);




/* 
|--------------------------------------------------------------------------
| 1) KIRIM PESAN TEXT
|---------------------------------------------------------------------------
*/
$WAManager->sendText("+6281234567890", "Hello dunia!");




/* 
|--------------------------------------------------------------------------
| 2) KIRIM PESAN MEDIA (image / video / audio)
|---------------------------------------------------------------------------
*/

/*
| A. Menggunakan URL langsung:
*/
$WAManager->sendMedia(
    "+6281234567890",
    "Ini gambarnya",
    "url",
    "https://domain.com/foto.jpg",
    "image"
);

/*
| B. Menggunakan file lokal (upload):
*/
$WAManager->sendMedia(
    "+6281234567890",
    "Foto terlampir",
    "file",
    "uploads/foto.jpg",
    "image"
);




/* --------------------------------------------------------------------------
| 3) KIRIM PESAN DOKUMEN (pdf / xls / xlsx / doc / docx)
|---------------------------------------------------------------------------
*/

/*
| A. Menggunakan URL:
*/
$WAManager->sendDocument(
    "+6281234567890",
    "Dokumen terlampir",
    "url",
    "https://domain.com/laporan.pdf",
    "laporan.pdf",
    "pdf"
);

/*
| B. Menggunakan file lokal (upload):
*/
$WAManager->sendDocument(
    "+6281234567890",
    "Dokumen ada di file",
    "file",
    "files/laporan.xlsx",
    "laporan.xlsx",
    "xlsx"
);
