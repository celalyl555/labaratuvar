<?php
// PHP hata raporlamayı açalım ve bellek/zaman sınırlarını artırarak sunucu hatalarının nedenini inceleyelim.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '512M'); // Bellek sınırını artırdık
set_time_limit(600); // İşlem süresini artırdık

// Hataları bir log dosyasına yazmak için
ini_set('log_errors', 1);
ini_set('error_log', 'php_error.log'); // Hata günlük dosyasının adı

 
    include("../../db.php"); 

    $pdo = $conn;
  
 
    try {    
        // Fonksiyon: Belirli bir seviyeden tüm sütunlarıyla başlıkları getir
        function getBasliklar($pdo, $level, $belgelendirmeLimit, $hizmetlerLimit, $testOlcumLimit) {
            $query = "
                SELECT *
                FROM kategoriler
                WHERE parent_id " . ($level === 'ana' ? 'IS NULL' : 'IS NOT NULL') . "
                  AND (kategori_adi LIKE :belgelendirme 
                       OR kategori_adi LIKE :hizmetler 
                       OR kategori_adi LIKE :test_olcum)
            ";
            
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':belgelendirme' => '%belgelendirme%',
                ':hizmetler' => '%hizmet%',
                ':test_olcum' => '%test ölçüm%'
            ]);
            $basliklar = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Grupları doldurmak için başlıkları kategorilere ayır
            $belgelendirme = [];
            $hizmetler = [];
            $testOlcum = [];
    
            foreach ($basliklar as $baslik) {
                if (stripos($baslik['kategori_adi'], 'belgelendirme') !== false && count($belgelendirme) < $belgelendirmeLimit) {
                    $belgelendirme[] = $baslik;
                } elseif (stripos($baslik['kategori_adi'], 'hizmet') !== false && count($hizmetler) < $hizmetlerLimit) {
                    $hizmetler[] = $baslik;
                } elseif (stripos($baslik['kategori_adi'], 'test ölçüm') !== false && count($testOlcum) < $testOlcumLimit) {
                    $testOlcum[] = $baslik;
                }
            }
    
            return [
                'belgelendirme' => $belgelendirme,
                'hizmetler' => $hizmetler,
                'testOlcum' => $testOlcum
            ];
        }
    
        // Öncelikle ana başlıklardan başlıkları al
        $anaBasliklar = getBasliklar($pdo, 'ana', 6, 12, 12);
    
        // Ana başlıklardan yeterince başlık bulunamazsa, 2. seviye başlıklara bak
        if (count($anaBasliklar['belgelendirme']) < 6 || count($anaBasliklar['hizmetler']) < 12 || count($anaBasliklar['testOlcum']) < 12) {
            $eksikBelgelendirme = 6 - count($anaBasliklar['belgelendirme']);
            $eksikHizmetler = 12 - count($anaBasliklar['hizmetler']);
            $eksikTestOlcum = 12 - count($anaBasliklar['testOlcum']);
    
            // 2. seviye başlıklardan eksik olan sayıları tamamla
            $ikinciBasliklar = getBasliklar($pdo, 'ikinci', $eksikBelgelendirme, $eksikHizmetler, $eksikTestOlcum);
    
            // Eksik sayıları 2. seviye başlıklarla tamamla
            $anaBasliklar['belgelendirme'] = array_merge($anaBasliklar['belgelendirme'], $ikinciBasliklar['belgelendirme']);
            $anaBasliklar['hizmetler'] = array_merge($anaBasliklar['hizmetler'], $ikinciBasliklar['hizmetler']);
            $anaBasliklar['testOlcum'] = array_merge($anaBasliklar['testOlcum'], $ikinciBasliklar['testOlcum']);
        }
    
        // Sonuçları ekrana yazdır
        echo "Belgelendirme ile anımsatan başlıklar:<br>";
        foreach ($anaBasliklar['belgelendirme'] as $item) {
            echo "ID: {$item['id']} - Kategori Adı: {$item['seo_url']} - Diğer Bilgiler: " . "<br>";
        }
    
        echo "<br>Hizmet ile anımsatan başlıklar:<br>";
        foreach ($anaBasliklar['hizmetler'] as $item) {
            echo "ID: {$item['id']} - Kategori Adı: {$item['kategori_adi']} - Diğer Bilgiler: " . "<br>";
        }
    
        echo "<br>Test Ölçüm ile anımsatan başlıklar:<br>";
        foreach ($anaBasliklar['testOlcum'] as $item) {
            echo "ID: {$item['id']} - Kategori Adı: {$item['kategori_adi']} - Diğer Bilgiler: "  . "<br>";
        }
    
    } catch (PDOException $e) {
        echo "Veritabanı hatası: " . $e->getMessage();
    }
    