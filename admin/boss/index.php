
<?php

session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

include("../../db.php");
$sql = "SELECT * FROM settings WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => 1]);

// Veriyi çek
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" sizes="192x192" href="../../assets/img/logo/favicon.ico">

    <title>Admin | Eurolab</title>
    
    <!-- MyStyle -->
    <link rel="stylesheet" href="assets/css/admin.css">

    <script src="https://kit.fontawesome.com/be694eddd8.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    
    <div class="admin-panel">
        <button class="menuBtn"><i class="fa-solid fa-chevron-right"></i></button>
        <aside class="sidebar">
            <!-- <img src="../../assets/img/logo/beyaz.png" alt=""> -->
            <nav>
                <ul>
                    <li><a href="index.php" class="active"><i class="fa-solid fa-gear"></i>Site Ayarları</a></li>
                    <li><a href="kategori.php"><i class="fa-solid fa-layer-group"></i>Kategori</a></li>
                    <li><a href="veriEkle.php"><i class="fa-solid fa-circle-plus"></i>Veri Ekle</a></li>
                    <li><a href="sertifikaAlani.php"><i class="fa-solid fa-feather-pointed"></i>Sertifika Yarar Alanı</a></li>
                    <li><a href="sertifikaSorgu.php"><i class="fa-solid fa-certificate"></i>Sertifika Sorgu</a></li>
                    <li><a href="../register.php"><i class="fa-solid fa-user-plus"></i>Hesap Oluştur</a></li>
                    <li class="logout"><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Çıkış Yap</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <div class="cententHeader">
                <div class="Rowgap">
                    <i class="fa-solid fa-gear"></i>
                    <h1>Site Ayarları</h1>
                </div>
                <button id="submitForm" class="submitBtn">Kaydet</button>
            </div>
            <section class="content-area">
                <form action="">
                    <div class="formDiv">
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Logo Ayarı :<br><span>(Ana Logo)</span></h3>
                                <img src="../../assets/img/logo/<?php echo $row["Analogo"] ?>" alt="">
                            </div>
                            <div class="fBox end">
                                <input type="file" accept="image/*" name="imageMain" id="imageMain">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="fRow">
                            <div class="fBox beyaz">
                                <h3>Logo Ayarı :<br><span>(Beyaz Logo)</span></h3>
                                <img src="../../assets/img/logo/<?php echo $row["Beyazlogo"] ?>" alt="">
                            </div>
                            <div class="fBox end">
                                <input type="file" accept="image/*" name="imageWhite" id="imageWhite">
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>İcon Logo Ayarı :<br><span>(Title Logo)</span></h3>
                                <img src="../../assets/img/logo/<?php echo $row["icon"] ?>" alt="">
                            </div>
                            <div class="fBox end">
                                <input type="file" accept="image/*" name="imageIcon" id="icon">
                            </div>
                        </div>
                        <hr class="hr">

                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Footer Metni :<br><span>(Footer içerisinde yazan Hakkında Metni.)</span></h3>
                            </div>
                            <div class="fBox end">
                                <textarea name="footermetin" id="footermetin"  placeholder="Footer Metni"><?php echo $row["Footertext"] ?></textarea>
                            </div>
                        </div>
                        <hr class="hr">
                        
                        <div class="fRow">
                            <div class="fBox">
                                <h2>Link Ayarları :</h2>
                            </div>
                        </div>
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Adres :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="adres" value="<?php echo $row["adres"] ?>" name="adres" placeholder="Adres">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>İletişim Numarası :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="iletisimnumara" value="<?php echo $row["iletisim"] ?>" name="iletisimnumara" placeholder="İletişim Numarası">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>E-Posta :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="email" id="email" value="<?php echo $row["email"] ?>" name="email" placeholder="E-Posta">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Harita :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="harita" value="<?php echo $row["harita"] ?>" name="harita" placeholder="Harita">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Facebook Linki :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="facebook" value="<?php echo $row["facebook"] ?>" name="facebook" placeholder="Facebook Linki">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Twitter Linki :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="twitter" value="<?php echo $row["twitter"] ?>" name="twitter" placeholder="Twitter Linki">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>LinkedIn Linki :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="linkedin" name="linkedin" value="<?php echo $row["linkedln"] ?>" placeholder="LinkedIn Linki">
                            </div>
                        </div>

                        <hr class="hr">

                        <div class="fRow">
                            <div class="fBox">
                                <h2>SMTP Ayarı :</h2>
                            </div>
                        </div>
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Host :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="host" value="<?php echo $row["host"] ?>" name="host" placeholder="Host">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Port :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="port" value="<?php echo $row["port"] ?>" name="port" placeholder="Port">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Kullanıcı Adı :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="kullanici" value="<?php echo $row["kullaniciadi"] ?>" name="kullanici" placeholder="Kullanıcı Adı">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Şifre :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="text" id="password" value="<?php echo $row["sifre"] ?>" name="password" placeholder="Şifre">
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="fRow">
                            <div class="fBox">
                                <h3>Gönderici E-Postası :</h3>
                            </div>
                            <div class="fBox end">
                                <input type="email" id="eposta" value="<?php echo $row["goneposta"] ?>" name="eposta" placeholder="Gönderici E-Posta">
                            </div>
                        </div>
                        <hr class="hr">

                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
        // Select the button and sidebar elements
        const menuBtn = document.querySelector('.menuBtn');
        const sidebar = document.querySelector('.sidebar');

        // Add a click event listener to the button
        menuBtn.addEventListener('click', function () {
            // Toggle the 'active' class for the sidebar and the button
            sidebar.classList.toggle('active');
            menuBtn.classList.toggle('active');
        });
    </script>

<script>
$(document).ready(function() {
    $("#submitForm").on("click", function(e) {
        e.preventDefault(); // Sayfanın yenilenmesini engeller
        var formData = new FormData($("form")[0]);

        $.ajax({
            url: "save.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert("Veriler başarıyla kaydedildi!");
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Hata:", error);
            }
        });
    });
});
</script>






</body>
</html>