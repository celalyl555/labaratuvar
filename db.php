<?php
// Veritabanı bağlantı bilgileri
$host = '185.92.2.129'; // Veritabanı sunucusu
$dbname = 'eurolab3'; // Veritabanı adı
$username = 'roott'; // Veritabanı kullanıcı adı
$password = 'S2Ukh3jTsd_4mHug'; // Veritabanı şifresi

try {
    // PDO ile veritabanına bağlanma
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // PDO hata modu ayarını etkinleştir
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    // Hata durumunda hata mesajını yazdır
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
