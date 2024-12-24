<?php
include("../../db.php");

try {
    

    // Verileri almak
    $firmUnvan = $_POST['firmUnvan'];
    $adres = $_POST['adres'];
    $standart = $_POST['standart'];
    $kapsam = $_POST['kapsam'];
    $kategori = $_POST['kategori'];
    $sertifikaNo = $_POST['sertifikaNo'];
    $akreditasyon = $_POST['akreditasyon'];
    $ilkBelgeDate = $_POST['ilkBelgeDate'];
    $sertifikaDate = $_POST['sertifikaDate'];
    $bitisDate = $_POST['bitisDate'];
    $gecerlilik = $_POST['gecerlilik'];

    // Veritabanına kayıt işlemi
    $stmt = $conn->prepare("INSERT INTO sertifika (Firma_unvan, Adres, Standart, Kapsam, Eac, Sertifika_no, Akreditasyon, First_belge_tar, Sertifika_tar, Bitis_tar, Durum) 
                            VALUES (:firmUnvan, :adres, :standart, :kapsam, :kategori, :sertifikaNo, :akreditasyon, :ilkBelgeDate, :sertifikaDate, :bitisDate, :gecerlilik)");

    // Parametreleri bağlama
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

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
