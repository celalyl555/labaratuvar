<?php
include("../../db.php"); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
       
 
        $anaKategori = $_POST['anaKategori'] ?? null;
        $altKategori = $_POST['altKategori'] ?? null;

        // Verilerin boş olup olmadığını kontrol et
        if (!$anaKategori || !$altKategori) {
            echo $anaKategori ."  " .$altKategori ;
            exit;
        }

        // SEO URL'yi oluştur
        function seoUrlOlustur($string) {
            $string = strtolower($string);
            $string = preg_replace('/[^\w\d-]/u', '-', $string);
            $string = preg_replace('/-+/', '-', $string);
            return trim($string, '-');
        }

        $seoUrl = seoUrlOlustur($altKategori);

        // Veritabanına ekle
        $query = "INSERT INTO kategoriler (parent_id, kategori_adi, seo_url) VALUES (:parent_id, :kategori_adi, :seo_url)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':parent_id', $anaKategori, PDO::PARAM_INT);
        $stmt->bindParam(':kategori_adi', $altKategori, PDO::PARAM_STR);
        $stmt->bindParam(':seo_url', $seoUrl, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo 'Alt kategori başarıyla kaydedildi.';
        } else {
            echo 'Bir hata oluştu, lütfen tekrar deneyin.';
        }
    } catch (PDOException $e) {
        echo 'Veritabanı hatası: ' . $e->getMessage();
    }
} else {
    echo 'Geçersiz istek.';
}
