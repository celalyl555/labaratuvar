<?php 
include("../../db.php");

try {
    // JSON verisini al
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        // Gelen veriler
        $id = $data['id'];
        $firmUnvan = $data['updatedData']['Firma_unvan'];
        $adres = $data['updatedData']['Adres'];
        $standart = $data['updatedData']['Standart'];
        $kapsam = $data['updatedData']['Kapsam'];
        $kategori = $data['updatedData']['Eac'];
        $sertifikaNo = $data['updatedData']['Sertifika_no'];
        $akreditasyon = $data['updatedData']['Akreditasyon'];
        $ilkBelgeDate = $data['updatedData']['First_belge_tar'];
        $sertifikaDate = $data['updatedData']['Sertifika_tar'];
        $bitisDate = $data['updatedData']['Bitis_tar'];
        $gecerlilik = $data['updatedData']['Durum'];

        // Update sorgusu
        $stmt = $conn->prepare("UPDATE sertifika 
                                SET Firma_unvan = :firmUnvan, Adres = :adres, Standart = :standart, Kapsam = :kapsam, 
                                    Eac = :kategori, Sertifika_no = :sertifikaNo, Akreditasyon = :akreditasyon, 
                                    First_belge_tar = :ilkBelgeDate, Sertifika_tar = :sertifikaDate, Bitis_tar = :bitisDate, 
                                    Durum = :gecerlilik 
                                WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firmUnvan', $firmUnvan);
        $stmt->bindParam(':adres', $adres);
        $stmt->bindParam(':standart', $standart);
        $stmt->bindParam(':kapsam', $kapsam);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':sertifikaNo', $sertifikaNo);
        $stmt->bindParam(':akreditasyon', $akreditasyon);
        $stmt->bindParam(':ilkBelgeDate', $ilkBelgeDate);
        $stmt->bindParam(':sertifikaDate', $sertifikaDate);
        $stmt->bindParam(':bitisDate', $bitisDate);
        $stmt->bindParam(':gecerlilik', $gecerlilik);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID is missing']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
