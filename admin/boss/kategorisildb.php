<?php
include("../../db.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Gelen id parametresi
        $idd = $_POST['id'] ?? null;

        // id değeri geçerli mi kontrol et
        if ($idd=="" || empty($idd)) {
            echo 'Geçerli bir kategori seçiniz.';
            
        }else{
            // Silme işlemi
        $query = "DELETE FROM kategoriler WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $idd, PDO::PARAM_INT);

       


        if ($stmt->execute()) {
            echo 'Kategori başarıyla silindi.';
            $query = "DELETE FROM iconarea WHERE parent_id = :idd";
            $stmt2 = $conn->prepare($query);
            $stmt2->bindParam(':idd', $idd, PDO::PARAM_INT);
            $stmt2->execute();
        } else {
            echo 'Bir hata oluştu, silme işlemi gerçekleştirilemedi.';
        }
        }

        
    } catch (PDOException $e) {
        echo 'Veritabanı hatası: ' . $e->getMessage();
    }
} else {
    echo 'Geçersiz istek.';
}
