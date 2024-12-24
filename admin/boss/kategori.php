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
    <style>
    /* Checkbox container styling */
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .checkbox {
        position: relative;
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        user-select: none;
    }

    .checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        position: relative;
        height: 20px;
        width: 20px;
        background-color: #f0f0f0;
        border: 2px solid #ccc;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin-right: 10px;
    }

    .checkbox input:checked~.checkmark {
        background-color: #007bff;
        border-color: #007bff;
        transform: scale(1.1);
    }

    .checkmark::after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .checkbox input:checked~.checkmark::after {
        display: block;
    }
    </style>
    <div class="admin-panel">
        <button class="menuBtn"><i class="fa-solid fa-chevron-right"></i></button>
        <aside class="sidebar">
            <img src="../../assets/img/logo/beyaz.png" alt="">
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-gear"></i>Site Ayarları</a></li>
                    <li><a href="kategori.php" class="active"><i class="fa-solid fa-layer-group"></i>Kategori</a></li>
                    <li><a href="veriEkle.php"><i class="fa-solid fa-circle-plus"></i>Veri Ekle</a></li>
                    <li><a href="sertifikaAlani.php"><i class="fa-solid fa-feather-pointed"></i>Sertifika Yarar
                            Alanı</a></li>
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
                    <i class="fa-solid fa-layer-group"></i>
                    <h1>Kategori Ekleme</h1>
                </div>
                <a  href="kategoriSil.php" class="submitBtn sil">Kategori Sil</a>

            </div>
            <section class="content-area">

                <div class="formDiv">
                    <form action="" method="post">
                        <div class="formDiv">

                            <!-- Ana Kategori -->
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Baş Kategori Seçiniz :</h3>
                                </div>
                                <div class="fBox w-100">
                                    <div class="checkbox-group">
                                        <label class="checkbox">
                                            <input type="checkbox" name="anaKategori" value="1" onclick="onlyOne(this)">
                                            <span class="checkmark"></span>
                                            Belgelendirme
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="anaKategori" value="2" onclick="onlyOne(this)">
                                            <span class="checkmark"></span>
                                            Hizmetler
                                        </label>
                                        <label class="checkbox">
                                            <input type="checkbox" name="anaKategori" value="3" onclick="onlyOne(this)">
                                            <span class="checkmark"></span>
                                            Testler
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Ana Kategori -->
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Ana Kategori :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <input type="text" name="anaKategori" id="anaKategori"
                                        placeholder="Ana Kategori Yazınız.">
                                </div>
                            </div>
                            <div class="fRow">
                                <div class="fBox end w-100">
                                    <button type="submit" name="kaydetAnaKategori" id="submitBtn1"
                                        class="submitBtn">Kaydet</button>
                                </div>
                            </div>
                            <hr class="hr">

                        </div>
                    </form>
                    <!-- Alt Kategori -->
                    <form action="" method="POST" id="kategoriForm">
                        <div class="formDiv">
                            <!-- Ana Kategori Seçimi -->
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Ana Kategori :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <select name="anaKategori" id="anaKategori33" class="form-select w-100">
                                        <option value="" disabled selected>Ana Kategori Seçiniz</option>
                                        <?php foreach ($kategoriler as $kategori): ?>
                                        <option value="<?php echo htmlspecialchars($kategori['id']); ?>">
                                            <?php echo htmlspecialchars($kategori['kategori_adi']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Alt Kategori -->
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Alt Kategori :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <input type="text" name="altKategori" id="altKategori"
                                        placeholder="Alt Kategori Yazınız.">
                                </div>
                            </div>
                            <div class="fRow">
                                <div class="fBox end w-100">
                                    <button type="submit" name="kaydetAltKategori" class="submitBtn">Kaydet</button>
                                </div>
                            </div>
                        </div>

                    </form>

                    <hr class="hr">

                    <form id="detayKategoriForm">
                        
                        <div class="formDiv">
                            <!-- Ana Kategori -->
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

                            <!-- Alt Kategori -->
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

                            <!-- Detay Kategori -->
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Detay Kategori :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <input type="text" name="detayKategori" id="detayKategori"
                                        placeholder="Detay Kategori Yazınız.">
                                </div>
                            </div>

                            <!-- Kaydet Butonu -->
                            <div class="fRow">
                                <div class="fBox end w-100">
                                    <button type="submit" class="submitBtn">Kaydet</button>
                                </div>
                            </div>
                            
                        </div>
                    </form>

                </div>

            </section>

        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    document.querySelector('#submitBtn1').addEventListener('click', function(event) {
        event.preventDefault(); // Formun otomatik gönderilmesini engelle

        // Seçili checkbox'ı bul
        const selectedCheckbox = document.querySelector('input[name="anaKategori"]:checked');
        const checkboxValue = selectedCheckbox ? selectedCheckbox.value : null;

        // Input değerini al
        const inputValue = document.getElementById('anaKategori').value;

        if (checkboxValue && inputValue) {
            // AJAX isteği
            $.ajax({
                url: 'anakategoriAdd.php', // PHP dosyasının yolu
                type: 'POST',
                data: {
                    class_id: checkboxValue,
                    kategori_adi: inputValue
                },
                success: function(response) {
                    console.log("Sunucu Yanıtı:", response);
                    alert("Kategori başarıyla eklendi!");
                },
                error: function(xhr, status, error) {
                    console.error("Hata:", error);
                    alert("Bir hata oluştu!");
                }
            });
        } else {
            alert("Lütfen tüm alanları doldurun.");
        }
    });



    document.getElementById('kategoriForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Formun varsayılan submit olayını engelle

        // Seçilen değerleri al
        const anaKategori = document.getElementById('anaKategori33').value;
        const altKategori = document.getElementById('altKategori').value;

        // Form verilerini oluştur
        const formData = new FormData();
        formData.append('anaKategori', anaKategori);
        formData.append('altKategori', altKategori);

        // AJAX isteği gönder
        fetch('kategoriAdd.php', {
                method: 'POST',
                body: formData,
            })
            .then((response) => response.text()) // Geri dönen metni al
            .then((data) => {
                alert(data); // Geri dönüş mesajını göster
            })
            .catch((error) => {
                console.error('Hata:', error);
                alert('Bir hata oluştu, lütfen tekrar deneyin.');
            });
    });
    </script>






    <script>
    let idd;
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
                                (elementId === 'altKategoriListesi' ? '2' : '3'))).value = kategori
                            .kategori_adi;

                        // Ana kategori seçilmişse alt kategorileri güncelle
                        if (elementId === 'anaKategoriListesi') {
                            fetchCategories(kategori.id, 'altKategoriListesi');
                            document.getElementById('myInput2').value = '';

                        }





                        // Seçilen kategorinin verisini çek
                        idd = kategori.id;
                        console.log(idd);
                    };

                    container.appendChild(a);
                });
            })
            .catch(error => console.error('Hata:', error));
    }




 
function onlyOne(checkbox) {
    const checkboxes = document.querySelectorAll('input[name="anaKategori"]');
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false;
    });
}
 


    document.getElementById('detayKategoriForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Formun varsayılan submit olayını engelle

        // Form verilerini al

        const detayKategori = document.getElementById('detayKategori').value;

        // Varsayılan ID değeri


        // Form verilerini kontrol et
        if (!anaKategori || !altKategori || !detayKategori) {
            alert('Lütfen tüm alanları doldurun.');
            return;
        }

        // FormData nesnesi oluştur
        const formData = new FormData();

        formData.append('detayKategori', detayKategori);
        formData.append('id', idd);

        // AJAX isteği gönder
        fetch('altkategoriadd.php', {
                method: 'POST',
                body: formData,
            })
            .then((response) => response.text()) // Geri dönen metni al
            .then((data) => {
                alert(data); // Geri dönüş mesajını göster
            })
            .catch((error) => {
                console.error('Hata:', error);
                alert('Bir hata oluştu, lütfen tekrar deneyin.');
            });
    });
    </script>




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
    </script>






</body>

</html>