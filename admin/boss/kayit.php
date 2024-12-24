<?php    
include("../../db.php"); 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $icons = $_POST['icon'];
        $basliklar = $_POST['baslik'];
        $metinler = $_POST['metin'];
        $id = $_POST['id'];
        
        // Verileri eklemek için SQL sorgusu
        $stmt = $conn->prepare("INSERT INTO iconarea (parent_id, icon, baslik, metin) VALUES (:id, :icon, :baslik, :metin)");

        foreach ($icons as $index => $icon) {
            $baslik = $basliklar[$index];
            $metin = $metinler[$index];

            // Değerleri doğrudan execute ile geçiriyoruz
            $stmt->execute([
                ':id' => $id,
                ':icon' => $icon,
                ':baslik' => $baslik,
                ':metin' => $metin
            ]);
        }

        // Başarı durumu için bir yanıt döndürme
        echo json_encode(['status' => 'success', 'message' => 'Veriler başarıyla kaydedildi.']);
    }
} catch (PDOException $e) {
    // Hata durumu
    echo json_encode(['status' => 'error', 'message' => 'Hata: ' . $e->getMessage()]);
}
?>
