<?php   
include("../../db.php");

 

try {
    // Güncellenebilir alanlar için dizi oluştur
    $updateFields = [];
    $updateValues = [];

    // POST edilen ve boş olmayan verileri kontrol ederek diziye ekle
    if (!empty($_POST['footermetin'])) {
        $updateFields[] = "Footertext = :footermetin";
        $updateValues[':footermetin'] = $_POST['footermetin'];
    }
    if (!empty($_POST['adres'])) {
        $updateFields[] = "adres = :adres";
        $updateValues[':adres'] = $_POST['adres'];
    }
    if (!empty($_POST['iletisimnumara'])) {
        $updateFields[] = "iletisim = :iletisimnumara";
        $updateValues[':iletisimnumara'] = $_POST['iletisimnumara'];
    }
    if (!empty($_POST['email'])) {
        $updateFields[] = "email = :email";
        $updateValues[':email'] = $_POST['email'];
    }
    if (!empty($_POST['harita'])) {
        $updateFields[] = "harita = :harita";
        $updateValues[':harita'] = $_POST['harita'];
    }
    if (!empty($_POST['facebook'])) {
        $updateFields[] = "facebook = :facebook";
        $updateValues[':facebook'] = $_POST['facebook'];
    }
    if (!empty($_POST['twitter'])) {
        $updateFields[] = "twitter = :twitter";
        $updateValues[':twitter'] = $_POST['twitter'];
    }
    if (!empty($_POST['linkedin'])) {
        $updateFields[] = "linkedln = :linkedin";
        $updateValues[':linkedin'] = $_POST['linkedin'];
    }
    if (!empty($_POST['host'])) {
        $updateFields[] = "host = :host";
        $updateValues[':host'] = $_POST['host'];
    }
    if (!empty($_POST['port'])) {
        $updateFields[] = "port = :port";
        $updateValues[':port'] = $_POST['port'];
    }
    if (!empty($_POST['kullanici'])) {
        $updateFields[] = "kullaniciadi = :kullanici";
        $updateValues[':kullanici'] = $_POST['kullanici'];
    }
    if (!empty($_POST['password'])) {
        $updateFields[] = "sifre = :password";
        $updateValues[':password'] = $_POST['password'];
    }
    if (!empty($_POST['eposta'])) {
        $updateFields[] = "goneposta = :eposta";
        $updateValues[':eposta'] = $_POST['eposta'];
    }

    // Resim dosyaları için işlem yap
    $uploadsDir =  '../../assets/img/logo/';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    // Logo dosyalarını kontrol edip yükle
    $imageFields = ['imageMain', 'imageWhite', 'imageIcon'];
    $imageNames = ['Analogo', 'Beyazlogo', 'icon'];

    foreach ($imageFields as $index => $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == UPLOAD_ERR_OK) {
            $imagePath = $uploadsDir . basename($_FILES[$field]['name']);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $imagePath)) {
                $updateFields[] = "{$imageNames[$index]} = :{$imageNames[$index]}";
                $updateValues[":{$imageNames[$index]}"] = basename($_FILES[$field]['name']);
            }
        }
    }

    // Dinamik olarak sorguyu hazırlayın ve çalıştırın
    if (count($updateFields) > 0) {
        $sql = "UPDATE settings SET " . implode(", ", $updateFields) . " WHERE id = 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute($updateValues);
        echo "Veriler başarıyla güncellendi!";
    } else {
        echo "Güncellenecek veri bulunamadı.";
    }

} catch (PDOException $e) {
    echo "Veri güncellenirken bir hata oluştu: " . $e->getMessage();
}
?>
