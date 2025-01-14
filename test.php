<?php 

include("db.php");


$imageDirectory = "images/";

  // SQL sorgusu (örnek: "kategoriler" tablosunda arama yapılıyor)
  $sql = "SELECT * FROM kategoriler WHERE kategori_adi LIKE :searchQuery";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


  if ($rows) {
    echo "Dosyada eksik olan resimler:<br>";

    foreach ($rows as $image) {
        $imagePath = $imageDirectory . $image['resim_yol']; // Tam dosya yolunu oluştur

        // Resim dosya dizininde var mı kontrol et
        if (!file_exists($imagePath)) {
            echo $image['id']."   ".$image['kategori_adi']. " .<br>";
        }
    }
} else {
    echo "Veritabanında hiçbir resim bulunamadı.";
}
 



?>