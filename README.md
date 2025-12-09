# WAManager – API WhatsApp Gateway

**WhatsApp:** (+62) 83-8001-80555  
**Website:** https://wa.raditek.co.id  
**Dokumentasi Lengkap:** https://wa.raditek.co.id/dashboard/docs  

---

## 🚀 Cara Penggunaan API WAManager

API ini mendukung pengiriman:

- **Text Message**
- **Media Message** (image, audio, video)
- **Document Message** (pdf, xls, xlsx, doc, docx)

---

## 🔧 Inisialisasi

```php
$WAManager = new WAManager(
    "YOUR_API_SECRET",
    "WHATSAPP_ACCOUNT_UNIQUE_ID"
);

1️⃣ **Mengirim Pesan TEXT**
$WAManager->sendText("+6281234567890", "Hello dunia!");

2️⃣ © 2025 WAManager – Raditek Indonesia
**A. Menggunakan URL**
$WAManager->sendMedia(
    "+6281234567890",
    "Ini gambarnya",
    "url",
    "https://domain.com/foto.jpg",
    "image"
);
**B. Menggunakan File Lokal (Upload)**
$WAManager->sendMedia(
    "+6281234567890",
    "Foto terlampir",
    "file",
    "uploads/foto.jpg",
    "image"
);

3️⃣ **Mengirim Pesan DOKUMEN (pdf / xls / xlsx / doc / docx)**
**A. Menggunakan URL**
$WAManager->sendDocument(
    "+6281234567890",
    "Dokumen terlampir",
    "url",
    "https://domain.com/laporan.pdf",
    "laporan.pdf",
    "pdf"
);
**B. Menggunakan File Lokal (Upload)**
$WAManager->sendDocument(
    "+6281234567890",
    "Dokumen ada di file",
    "file",
    "files/laporan.xlsx",
    "laporan.xlsx",
    "xlsx"
);

📌 **Catatan Tambahan**
- API otomatis memvalidasi nomor WhatsApp sebelum pengiriman.
- Mendukung format nomor internasional E.164 (+628xxxx).
- Mendukung upload file dan URL media.
- Semua request dikirim melalui endpoint https://wa.raditek.co.id/api/

📚 **Dokumentasi Resmi**
Dokumentasi lengkap tersedia di:
👉 https://wa.raditek.co.id/dashboard/docs

🎯 **Keunggulan WAManager**
- Stabil dan cepat
- Validasi nomor otomatis
- Pengiriman media & dokumen besar
- Integrasi mudah ke sistem toko, PPOB, ERP, bot, dan aplikasi bisnis

💬 **Bantuan & Support**
Jika membutuhkan bantuan integrasi atau debugging API:
📞 WhatsApp: (+62) 83-8001-80555

**© 2025 WAManager – RADITEK GROUP**
