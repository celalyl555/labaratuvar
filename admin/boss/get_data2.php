<?php
include("../../db.php");

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Veriyi çekmek için SQL sorgusu
        $stmt = $conn->prepare("SELECT icon, baslik, metin FROM iconarea WHERE parent_id = :id");
        $stmt->execute([':id' => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Sonuçları ayrı ayrı diziler halinde yapılandırma
        $icons = [];
        $basliklar = [];
        $metinler = [];

        foreach ($results as $row) {
            $icons[] = $row['icon'];
            $basliklar[] = $row['baslik'];
            $metinler[] = $row['metin'];
        }

        // JSON formatında yanıt döndürme
        echo json_encode([
            'status' => 'success',
            'icon' => $icons,
            'baslik' => $basliklar,
            'metin' => $metinler
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Geçersiz istek.']);
    }
} catch (PDOException $e) {
    // Hata durumunda yanıt döndürme
    echo json_encode(['status' => 'error', 'message' => 'Hata: ' . $e->getMessage()]);
}
?>
