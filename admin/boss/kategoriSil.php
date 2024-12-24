<?php 
include("../../db.php"); 

try {
  
    $sql = "SELECT * FROM kategoriler WHERE parent_id IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Sonuçları çekme
    $kategoriler = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
} catch (PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" sizes="192x192" href="../assets/img/logo/favicon.ico">

    <title>Admin | Eurolab</title>

    <!-- MyStyle -->
    <link rel="stylesheet" href="assets/css/admin.css">
    
    <script src="https://kit.fontawesome.com/be694eddd8.js" crossorigin="anonymous"></script>

</head>

<body>
 
    <div class="admin-panel">
        <button class="menuBtn"><i class="fa-solid fa-chevron-right"></i></button>
        <aside class="sidebar">
            <img src="../../assets/img/logo/beyaz.png" alt="">
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-gear"></i>Site Ayarları</a></li>
                    <li><a href="kategori.php" class="active"><i class="fa-solid fa-layer-group"></i>Kategori</a></li>
                    <li><a href="veriEkle.php" ><i class="fa-solid fa-circle-plus"></i>Veri Ekle</a></li>
                    <li><a href="sertifikaAlani.php"><i class="fa-solid fa-feather-pointed"></i>Sertifika Yarar Alanı</a></li>
                    <li><a href="sertifikaSorgu.php"><i class="fa-solid fa-certificate"></i>Sertifika Sorgu</a></li>
                    <li><a href="../register.php"><i class="fa-solid fa-user-plus"></i>Hesap Oluştur</a></li>
                    
                    <li class="logout"><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Çıkış
                            Yap</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <div class="cententHeader">
                <div class="Rowgap">
                <i class="fa-solid fa-trash-can"></i>
                    <h1>Kategori Sil</h1>
                </div>
                <a  class="submitBtn"  href="kategori.php">Kategori Ekle</a>
            </div>
            <section class="content-area">
                <form action="">
                    <div class="formDiv">

                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Ana Kategori :</h3>
                            </div>
                            <div class="fBox end w-100">
                                <div class="dropdown1">
                                    <input type="text" id="myInput1" placeholder="Ana Kategori Seçiniz" class="dropbtn1"
                                        readonly onclick="toggleDropdown('myDropdown1')">
                                    <div id="myDropdown1" class="dropdown-content1">
                                        <input type="text" placeholder="Ara.." id="myFilter1"
                                            onkeyup="filterFunction('myDropdown1', 'myFilter1')">
                                        <div id="anaKategoriListesi"></div> <!-- Ana Kategoriler Dinamik Yüklenecek -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr">

                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Alt Kategori :</h3>
                            </div>
                            <div class="fBox end w-100">
                                <div class="dropdown1">
                                    <input type="text" id="myInput2" placeholder="Alt Kategori Seçiniz" class="dropbtn1"
                                        readonly onclick="toggleDropdown('myDropdown2')">
                                    <div id="myDropdown2" class="dropdown-content1">
                                        <input type="text" placeholder="Ara.." id="myFilter2"
                                            onkeyup="filterFunction('myDropdown2', 'myFilter2')">
                                        <div id="altKategoriListesi"></div> <!-- Alt Kategoriler Dinamik Yüklenecek -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr">

                        <div class="fRow">
                            <div class="fBox ico">
                                <h3>Detay Kategori :</h3>
                            </div>
                            <div class="fBox end w-100">
                                <div class="dropdown1">
                                    <input type="text" id="myInput3" placeholder="Detay Kategori Seçiniz"
                                        class="dropbtn1" readonly onclick="toggleDropdown('myDropdown3')">
                                    <div id="myDropdown3" class="dropdown-content1">
                                        <input type="text" placeholder="Ara.." id="myFilter3"
                                            onkeyup="filterFunction('myDropdown3', 'myFilter3')">
                                        <div id="detayKategoriListesi"></div>
                                        <!-- Detay Kategoriler Dinamik Yüklenecek -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr">
                        <div class="fRow center w-100">
                            <a class="submitBtn red" onclick="kategorisil();">Kategori Sil</a>
                        </div>
                      
                         

                    </div>
                </form>
            </section>
        </main>
    </div>
  
    <script>
        let idd="";
    // Ana Kategorileri İlk Yükleme
    window.onload = function() {
        fetchCategories(null, 'anaKategoriListesi');
    };

   // Kategori Verilerini Çekme ve Güncelleme Fonksiyonu
   function fetchCategories(parent_id, elementId) {
    const url = 'get_categories.php' + (parent_id ? '?parent_id=' + parent_id : '');
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById(elementId);
            container.innerHTML = ''; // Önceki verileri temizle

            data.forEach(kategori => {
                const a = document.createElement('a');
                a.href = '#';
                a.textContent = kategori.kategori_adi;
                a.dataset.id = kategori.id;
                a.onclick = function() {
                    // Tüm açılan dropdownları kapat
                    const dropdowns = document.getElementsByClassName("dropdown-content1");
                    for (let i = 0; i < dropdowns.length; i++) {
                        const openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }

                    // Seçilen kategori adını input'a yaz
                    document.getElementById('myInput' + (elementId === 'anaKategoriListesi' ? '1' :
                        (elementId === 'altKategoriListesi' ? '2' : '3'))).value = kategori.kategori_adi;

                    // Ana kategori seçilmişse alt kategorileri güncelle
                    if (elementId === 'anaKategoriListesi') {
                        fetchCategories(kategori.id, 'altKategoriListesi');
                        document.getElementById('myInput2').value = '';
                        document.getElementById('myInput3').value = '';
                    }
                    // Alt kategori seçilmişse detay kategorileri güncelle
                    else if (elementId === 'altKategoriListesi') {
                        fetchCategories(kategori.id, 'detayKategoriListesi');
                        document.getElementById('myInput3').value = '';
                    }

                    // Dropdown'u kapat
                    closeDropdown(elementId);

                    // Seçilen kategorinin verisini çek
                    idd=kategori.id;
                  
                };

                container.appendChild(a);
            });
        })
        .catch(error => console.error('Hata:', error));
}
 


// Dropdown'u kapatma fonksiyonu
function closeDropdown(elementId) {
    document.getElementById(elementId === 'anaKategoriListesi' ? 'myDropdown1' : 
        (elementId === 'altKategoriListesi' ? 'myDropdown2' : 'myDropdown3')).classList.remove("show");
}



    // Dropdown filtreleme
    function filterFunction(dropdownId, filterId) {
        const input = document.getElementById(filterId);
        const filter = input.value.toUpperCase();
        const div = document.getElementById(dropdownId);
        const a = div.getElementsByTagName("a");
        for (let i = 0; i < a.length; i++) {
            const txtValue = a[i].textContent || a[i].innerText;
            a[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }

    // Dropdown dışında tıklandığında dropdown'ı kapatma
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn1') && !event.target.matches('.dropdown1 input')) {
            const dropdowns = document.getElementsByClassName("dropdown-content1");
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };
    </script>
    <script>
    function setupDropdown(dropdownInputId, dropdownContainerId, filterInputId) {
        const dropdownInput = document.getElementById(dropdownInputId);
        const dropdownContainer = document.getElementById(dropdownContainerId);
        const filterInput = document.getElementById(filterInputId);

        // Dropdown'u açıp kapatmak için
        dropdownInput.onclick = function(event) {
            event.stopPropagation(); // Dropdown input'a tıklamayı durdur
            dropdownContainer.classList.toggle("show1");
        };

        // Seçilen değeri input'a yazmak için
        dropdownContainer.querySelectorAll('a').forEach(function(item) {
            item.onclick = function() {
                dropdownInput.value = item.textContent;
                dropdownContainer.classList.remove("show1"); // Dropdown'ı kapat
            };
        });

        // Filtreleme fonksiyonu
        filterInput.onkeyup = function() {
            const filter = filterInput.value.toUpperCase();
            const aTags = dropdownContainer.getElementsByTagName("a");

            for (let i = 0; i < aTags.length; i++) {
                const txtValue = aTags[i].textContent || aTags[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    aTags[i].style.display = "";
                } else {
                    aTags[i].style.display = "none";
                }
            }
        };

        // Dropdown dışına tıklanınca kapatmak için
        document.addEventListener('click', function(event) {
            if (!dropdownContainer.contains(event.target) && !dropdownInput.contains(event.target)) {
                dropdownContainer.classList.remove("show1");
            }
        });
    }

    setupDropdown('myInput1', 'myDropdown1', 'myFilter1');
    setupDropdown('myInput2', 'myDropdown2', 'myFilter2');
    setupDropdown('myInput3', 'myDropdown3', 'myFilter3');
    </script>

    <script>
    // Select the button and sidebar elements
    const menuBtn = document.querySelector('.menuBtn');
    const sidebar = document.querySelector('.sidebar');

    // Add a click event listener to the button
    menuBtn.addEventListener('click', function() {
        // Toggle the 'active' class for the sidebar and the button
        sidebar.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });






    function kategorisil() {
    // Kullanıcıdan silme onayı alın
    if (confirm("Silmek istediğinize emin misiniz?")) {
        // AJAX ile silme işlemi
        const formData = new FormData();
        formData.append('id', idd); // id parametresini gönder
console.log(idd);
        fetch('kategorisildb.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Gelen yanıtı al
        .then(data => {
            alert(data); // Yanıtı ekranda göster
            // Silme başarılıysa sayfayı yeniden yükleyebiliriz
            location.reload(); 
        })
        .catch(error => {
            console.error('Hata:', error);
            alert('Bir hata oluştu, lütfen tekrar deneyin.');
        });
    }
}

    </script>




</body>

</html>