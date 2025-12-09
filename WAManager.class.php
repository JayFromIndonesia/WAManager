<?php

class WAManager {

    private $secret;
    private $account;
    private $baseUrl = "https://wa.raditek.co.id/api";

    public function __construct($secret, $account)
    {
        $this->secret  = $secret;
        $this->account = $account;
    }

    /**
     * ===========================
     * VALIDATE NUMBER (GET)
     * ===========================
     */
    private function validateNumber($phone)
    {
        $url = $this->baseUrl . "/validate/whatsapp?secret={$this->secret}&unique={$this->account}&phone={$phone}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response  = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return ($http_code === 200);
    }


    /**
     * ===========================
     * SEND TEXT MESSAGE
     * ===========================
     */
    public function sendText($phone, $message)
    {
        if (!$this->validateNumber($phone)) {
            return ["success" => false, "error" => "Nomor tidak valid"];
        }

        $url = $this->baseUrl . "/send/whatsapp";
        $data = [
            "secret"    => $this->secret,
            "account"   => $this->account,
            "recipient" => $phone,
            "type"      => "text",
            "message"   => $message
        ];

        return $this->curlSend($url, $data);
    }


    /**
     * ===========================
     * SEND MEDIA (image / audio / video)
     * ===========================
     * $source = "url" atau "file"
     * $file   = URL atau path file
     * $mediaType = image|audio|video
     */
    public function sendMedia($phone, $message, $source, $file, $mediaType)
    {
        if (!$this->validateNumber($phone)) {
            return ["success" => false, "error" => "Nomor tidak valid"];
        }

        $url = $this->baseUrl . "/send/whatsapp";

        $data = [
            "secret"     => $this->secret,
            "account"    => $this->account,
            "recipient"  => $phone,
            "type"       => "media",
            "media_type" => $mediaType,
            "message"    => $message
        ];

        if ($source === "url") {
            $data["media_url"] = $file;
        } else {
            // upload file binary
            $data["media_file"] = curl_file_create($file);
        }

        return $this->curlSend($url, $data);
    }


    /**
     * ===========================
     * SEND DOCUMENT (pdf/xls/doc)
     * ===========================
     * $source = "url" atau "file"
     * $file   = URL atau path file
     */
    public function sendDocument($phone, $message, $source, $file, $docName, $docType)
    {
        if (!$this->validateNumber($phone)) {
            return ["success" => false, "error" => "Nomor tidak valid"];
        }

        $url = $this->baseUrl . "/send/whatsapp";

        $data = [
            "secret"        => $this->secret,
            "account"       => $this->account,
            "recipient"     => $phone,
            "type"          => "document",
            "document_type" => $docType,
            "message"       => $message
        ];

        if ($source === "url") {
            $data["document_url"]  = $file;
            $data["document_name"] = $docName;
        } else {
            $data["document_file"] = curl_file_create($file);
        }

        return $this->curlSend($url, $data);
    }


    /**
     * ===========================
     * INTERNAL CURL METHOD
     * ===========================
     */
    private function curlSend($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response  = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            return ["success" => true, "response" => $response];
        }

        return ["success" => false, "http_code" => $http_code, "response" => $response];
    }

}


/* 
|--------------------------------------------------------------------------
| CARA PENGGUNAAN API WAManager
| Whatsapp: (+62) 83-8001-80555
| Website: https://wa.raditek.co.id
|--------------------------------------------------------------------------
|
| Contoh penggunaan fitur pengiriman pesan:
| - Text Message
| - Media Message (image, audio, video)
| - Document Message (pdf, xls, xlsx, doc, docx)
|
| $WAManager = new WAManager(
|     "YOUR_API_SECRET",
|     "WHATSAPP_ACCOUNT_UNIQUE_ID"
| );
|
*/



/* --------------------------------------------------------------------------
| 1) KIRIM PESAN TEXT
|---------------------------------------------------------------------------
*/
// $WAManager->sendText("6281234567890", "Hello dunia!");



/* --------------------------------------------------------------------------
| 2) KIRIM PESAN MEDIA (image / video / audio)
|---------------------------------------------------------------------------
|
| A. Menggunakan URL langsung:
| $WAManager->sendMedia(
|     "6281234567890",
|     "Ini gambarnya",
|     "url",
|     "https://domain.com/foto.jpg",
|     "image"
| );
|
| B. Menggunakan file lokal (upload):
| $WAManager->sendMedia(
|     "6281234567890",
|     "Foto terlampir",
|     "file",
|     "uploads/foto.jpg",
|     "image"
| );
|
*/



/* --------------------------------------------------------------------------
| 3) KIRIM PESAN DOKUMEN (pdf / xls / xlsx / doc / docx)
|---------------------------------------------------------------------------
|
| A. Menggunakan URL:
| $WAManager->sendDocument(
|     "6281234567890",
|     "Dokumen terlampir",
|     "url",
|     "https://domain.com/laporan.pdf",
|     "laporan.pdf",
|     "pdf"
| );
|
| B. Menggunakan file lokal (upload):
| $WAManager->sendDocument(
|     "6281234567890",
|     "Dokumen ada di file",
|     "file",
|     "files/laporan.xlsx",
|     "laporan.xlsx",
|     "xlsx"
| );
|
*/

