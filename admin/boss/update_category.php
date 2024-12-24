<?php
include("../../db.php"); // Veritabanı bağlantısı

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST verilerini al
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $veri = isset($_POST['veri']) ? $_POST['veri'] : '';

    // Resim yükleme klasörü
    $uploadDir = "../../images/";

    // Giriş doğrulama
    if ($id > 0 && !empty($veri)) {
        try {
            $resimAdi = null; // Varsayılan olarak resim adı boş

            // Eski resmi kontrol et ve sil
            $sql = "SELECT resim_yol FROM kategoriler WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && !empty($row['resim_yol'])) {
                $eskiResim = $uploadDir . $row['resim_yol'];
                if (file_exists($eskiResim)) {
                    unlink($eskiResim); // Eski dosyayı sil
                }
            }

            // Resim kontrolü
            if (isset($_FILES['gorsel']) && $_FILES['gorsel']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['gorsel']['tmp_name'];
                $originalFileName = $_FILES['gorsel']['name'];
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $sanitizedFileName = preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($originalFileName, PATHINFO_FILENAME));
                $resimAdi = $sanitizedFileName . '.' . $fileExtension;

                // Aynı isimde bir dosya var mı kontrol et
                $fullPath = $uploadDir . $resimAdi;
                $counter = 1;
                while (file_exists($fullPath)) {
                    $resimAdi = $sanitizedFileName . '_' . $counter . '.' . $fileExtension;
                    $fullPath = $uploadDir . $resimAdi;
                    $counter++;
                }

                // Dosyayı belirtilen klasöre kaydet
                if (move_uploaded_file($fileTmpPath, $fullPath)) {
                    echo "Görsel başarıyla yüklendi: $resimAdi\n";
                } else {
                    echo "Görsel yükleme başarısız.\n";
                    $resimAdi = null; // Resim kaydedilemediyse null yap
                }
            }

            // Veritabanı güncellemesi
            $sql = "UPDATE kategoriler SET veri = :veri, resim_yol = :resim_yol WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':veri', $veri);
            $stmt->bindParam(':id', $id);

            // Resim varsa resim yolunu, yoksa NULL gönder
            $stmt->bindParam(':resim_yol', $resimAdi);
            $stmt->execute();

            echo "Başarıyla güncellendi.";
        } catch (PDOException $e) {
            echo "Hata: " . $e->getMessage();
        }
    } else {
        echo "Geçersiz giriş.";
    }
} else {
    echo "Geçersiz istek.";
}
?>
