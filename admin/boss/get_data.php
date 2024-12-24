<?php
include("../../db.php"); 

header('Content-Type: application/json; charset=utf-8');

try {
    // GET parametresinden id alınıyor
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id !== null && $id > 0) {
        $sql = "SELECT veri, resim_yol FROM kategoriler WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($row); // JSON formatında geri döner
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Veri bulunamadı.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Geçersiz ID.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Veritabanı bağlantı hatası: " . $e->getMessage()]);
}
?>

