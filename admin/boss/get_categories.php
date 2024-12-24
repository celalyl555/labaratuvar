<?php
 include("../../db.php"); 


try {
    

    // GET parametresinden parent_id alınıyor, null ise ana kategoriler çekilecek
    $parent_id = isset($_GET['parent_id']) ? $_GET['parent_id'] : null;

    // Sorguyu parent_id'ye göre ayarla
    if ($parent_id === null) {
        // Ana kategorileri çek
        $sql = "SELECT id, kategori_adi FROM kategoriler WHERE parent_id IS NULL";
    } else {
        // Alt kategorileri veya detay kategorileri çek
        $sql = "SELECT id, kategori_adi FROM kategoriler WHERE parent_id = :parent_id";
    }

    $stmt = $conn->prepare($sql);
    
    // parent_id null değilse parametre olarak bağla
    if ($parent_id !== null) {
        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    $kategoriler = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON olarak döndür
    echo json_encode($kategoriler);

} catch (PDOException $e) {
    echo json_encode(["error" => "Veritabanı bağlantı hatası: " . $e->getMessage()]);
}
