<?php
include("../../db.php"); // Veritabanı bağlantısını dahil edin

try {
    if (isset($_POST['class_id']) && isset($_POST['kategori_adi'])) {
        $classId = $_POST['class_id'];
        $kategoriAdi = $_POST['kategori_adi'];

        // SEO URL oluşturma
        function createSeoUrl($string) {
            $string = trim($string); // Boşlukları temizle
            $string = mb_strtolower($string, 'UTF-8'); // Küçük harfe çevir
            $string = preg_replace('/[^a-z0-9\s-]/u', '', $string); // Geçersiz karakterleri kaldır
            $string = preg_replace('/[\s-]+/', ' ', $string); // Fazla boşlukları tek boşluğa indir
            $string = preg_replace('/\s+/', '-', $string); // Boşlukları tire ile değiştir
            return $string;
        }

        $seoUrl = createSeoUrl($kategoriAdi);

        // Veritabanına veri ekleme sorgusu
        $stmt = $conn->prepare("INSERT INTO kategoriler (class_id, kategori_adi, seo_url) VALUES (:class_id, :kategori_adi, :se_url)");
        $stmt->bindParam(':class_id', $classId);
        $stmt->bindParam(':kategori_adi', $kategoriAdi);
        $stmt->bindParam(':se_url', $seoUrl);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Kategori başarıyla eklendi.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Veritabanına eklenirken bir hata oluştu.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Geçersiz giriş.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Hata: ' . $e->getMessage()]);
}
?>
