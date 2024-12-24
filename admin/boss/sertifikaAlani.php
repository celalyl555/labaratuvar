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
    <!-- jQuery CDN üzerinden ekleme -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <div class="admin-panel">
        <button class="menuBtn"><i class="fa-solid fa-chevron-right"></i></button>
        <aside class="sidebar">
            <img src="../../assets/img/logo/beyaz.png" alt="">
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-gear"></i>Site Ayarları</a></li>
                    <li><a href="kategori.php"><i class="fa-solid fa-layer-group"></i>Kategori</a></li>
                    <li><a href="veriEkle.php"><i class="fa-solid fa-circle-plus"></i>Veri Ekle</a></li>
                    <li><a href="sertifikaAlani.php" class="active"><i class="fa-solid fa-feather-pointed"></i>Sertifika Yarar Alanı</a></li>
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
                    <i class="fa-solid fa-feather-pointed"></i>
                    <h1>Sertifika Yarar Alanı</h1>
                </div>
                <button id="submitForm" class="submitBtn">Kaydet</button>
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


                    </div>





                    <div class="formDiv">



                        <!-- Buraya Eklenicek -->
                        <div id="eklenecekYer"></div>

                        <div class="fRow center">
                            <button type="button" class="eklebtn" onclick="iconAlaniEkle();">İcon Alanı Ekle</button>
                        </div>

                    </div>

                </form>
            </section>


        </main>
    </div>

    <script>
    function updateIcon() {
        const select = document.getElementById("icons");
        const selectedOption = select.options[select.selectedIndex];
        const iconClass = selectedOption.getAttribute("data-icon");

        const iconElement = document.getElementById("icon");
        iconElement.className = "fa " + iconClass;
    }

    // Sayfa yüklendiğinde varsayılan simgeyi güncelle
    window.onload = updateIcon;
    </script>

    <script>
    let iconAlanSayisi = 1; // Başlangıçta 1. alan mevcut

    function updateIcon(index) {
        const select = document.getElementById(`icons${index}`);
        const selectedOption = select.options[select.selectedIndex];
        const iconClass = selectedOption.getAttribute("data-icon");

        const iconElement = document.getElementById(`icon${index}`);
        iconElement.className = "fa " + iconClass;
    }
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



    <!--     gashjgdfhjgashghd   -->


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
                        idd = kategori.id;
                        fetchCategoryData(idd);
                    };

                    container.appendChild(a);
                });
            })
            .catch(error => console.error('Hata:', error));
    }

    // İcon Alanı Ekleme Fonksiyonu
    function iconAlaniEkle() {
        // Sayfadaki mevcut alan sayısını kontrol et
        const mevcutAlanSayisi = document.querySelectorAll("#eklenecekYer .new-icon-area").length;

        // Eğer mevcut alan sayısı, veri tabanından gelen alan sayısına eşitse sadece bir boş alan ekle
        if (mevcutAlanSayisi === iconAlanSayisi) {
            iconAlanSayisi++; // Alan sayısını arttır

            // Yeni alanın HTML içeriğini oluştur
            const yeniAlanHTML = `
            <div class="fRow">
                <div class="fBox ico">
                    <h2>${iconAlanSayisi}. İcon Alanı</h2>
                </div>
            </div>
            <div class="fRow">
                <div class="fBox ico">
                    <h3>İcon Seçimi :</h3>
                </div>
                <div class="fBox end w-100 nowrap">
                    <div class="ficons" id="iconDisplay${iconAlanSayisi}">
                        <i id="icon${iconAlanSayisi}" class="fa"></i>
                    </div>
                    <select name="icon[]" id="icons${iconAlanSayisi}" onchange="updateIcon(${iconAlanSayisi})">
                        <option value="0" disabled selected>İcon Seçiniz</option>
                        <option value="fa-wrench" data-icon="fa-wrench"><i class="fa fa-wrench" aria-hidden="true"></i> 🔧 Kalite Yönetimi İyileşir </option>
                        <option value="fa-smile" data-icon="fa-smile">😊 Müşteri Memnuniyeti Artar </option>
                        <option value="fa-chart-line" data-icon="fa-chart-line">📈 Verimlilik ve Kârlılık Sağlar </option>
                        <option value="fa-trophy" data-icon="fa-trophy">🏆 Rekabet Avantajı Sunar </option>
                        <option value="fa-rocket" data-icon="fa-rocket">🚀 Çalışan Motivasyonunu Yükseltir </option>
                        <option value="fa-search" data-icon="fa-search">🔍 Riskleri Azaltır </option>
                        <option value="fa-globe" data-icon="fa-globe">🌍 Uluslararası Tanınırlık Kazandırır </option>
                        <option value="fa-lock" data-icon="fa-lock">🔒 Güvenilirlik Artışı </option>
                        <option value="fa-cogs" data-icon="fa-cogs">⚙️ Süreç İyileştirmesi </option>
                        <option value="fa-balance-scale" data-icon="fa-balance-scale">⚖️ Hukuki Uyum Sağlar </option>
                        <option value="fa-leaf" data-icon="fa-leaf">🍃 Gıda Güvenliğini Artırır </option>
                        <option value="fa-money-bill" data-icon="fa-money-bill">💰 Maliyetleri Azaltır </option>
                        <option value="fa-recycle" data-icon="fa-recycle">♻️ Sürdürülebilirlik Sağlar </option>
                        <option value="fa-star" data-icon="fa-star">🌟 Marka Değerini Artırır </option>
                        <option value="fa-bullseye" data-icon="fa-bullseye">🎯 Hedef Kitleyi Belirler</option>
<option value="fa-lightbulb" data-icon="fa-lightbulb">💡 Yenilikçi Çözümler Sunar</option>
<option value="fa-clipboard-list" data-icon="fa-clipboard-list">📋 Standartların Belirlenmesi</option>






                    </select>
                </div>
            </div>
            <hr class="hrGray">
            <div class="fRow">
                <div class="fBox ico">
                    <h3>Başlık Alanı :</h3>
                </div>
                <div class="fBox end w-100">
                    <input type="text" name="baslik[]" id="baslik${iconAlanSayisi}" placeholder="Başlık Yazınız">
                </div>
            </div>
            <hr class="hrGray">
            <div class="fRow">
                <div class="fBox ico">
                    <h3>Metin Alanı :</h3>
                </div>
                <div class="fBox end w-100">
                    <textarea name="metin[]" id="metin${iconAlanSayisi}" placeholder="Metin Yazınız"></textarea>
                </div>
            </div>
            <hr class="hrGray">
        `;

            // Yeni alanı sayfaya ekle
            const yeniDiv = document.createElement("div");
            yeniDiv.classList.add("new-icon-area", "w-100");
            yeniDiv.innerHTML = yeniAlanHTML;

            document.getElementById("eklenecekYer").appendChild(yeniDiv);
        }
    }


    // Seçilen Kategoriden Veri Çekme Fonksiyonu
    function fetchCategoryData(categoryId) {
        fetch(`get_data2.php?id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const eklenecekAlan = document.getElementById("eklenecekYer");

                // Mevcut alanları temizle
                eklenecekAlan.innerHTML = "";
                iconAlanSayisi = 0; // Alan sayısını sıfırla ve veri tabanından gelen veri kadar güncelle

                if (data.icon && data.baslik && data.metin) {
                    data.icon.forEach((icon, index) => {
                        iconAlanSayisi++; // Her dolu alan için sayıyı arttır

                        const baslik = data.baslik[index];
                        const metin = data.metin[index];

                        const formGroup = `
                        <div class="new-icon-area w-100">
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h2>${iconAlanSayisi}. İcon Alanı</h2>
                                </div>
                            </div>
                        
                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>İcon Seçimi :</h3>
                                </div>
                                <div class="fBox end w-100 nowrap">
                                    <div class="ficons" id="iconDisplay${iconAlanSayisi}">
                                        <i id="icon${iconAlanSayisi}" class="fa ${icon}"></i>
                                    </div>
                                    <select name="icon[]" id="icons${iconAlanSayisi}" onchange="updateIcon(${iconAlanSayisi})">
                                        <option value="0" disabled>İcon Seçiniz</option>
                                        <option value="fa-wrench" ${icon === "fa-wrench" ? "selected" : ""}>Kalite Yönetimi İyileşir</option>
                                        <option value="fa-smile" ${icon === "fa-smile" ? "selected" : ""}>Müşteri Memnuniyeti Artar</option>
                                        <option value="fa-chart-line" ${icon === "fa-chart-line" ? "selected" : ""}>Verimlilik ve Kârlılık Sağlar</option>
                                        <option value="fa-trophy" ${icon === "fa-trophy" ? "selected" : ""}>Rekabet Avantajı Sunar</option>
                                        <option value="fa-rocket" ${icon === "fa-rocket" ? "selected" : ""}>Çalışan Motivasyonunu Yükseltir</option>
                                        <option value="fa-search" ${icon === "fa-search" ? "selected" : ""}>Riskleri Azaltır</option>
                                        <option value="fa-globe" ${icon === "fa-globe" ? "selected" : ""}>Uluslararası Tanınırlık Kazandırır</option>  
                                        <option value="fa-lock" ${icon === "fa-lock" ? "selected" : ""}>Güvenilirlik Artışı</option> 
                                        <option value="fa-cogs" ${icon === "fa-cogs" ? "selected" : ""}>Süreç İyileştirmesi</option>   
                                        <option value="fa-balance-scale" ${icon === "fa-balance-scale" ? "selected" : ""}>Hukuki Uyum Sağlar</option>
                                        <option value="fa-leaf" ${icon === "fa-leaf" ? "selected" : ""}>Gıda Güvenliğini Artırır</option>
                                        <option value="fa-money-bill" ${icon === "fa-money-bill" ? "selected" : ""}>Maliyetleri Azaltır</option>
                                        <option value="fa-recycle" ${icon === "fa-recycle" ? "selected" : ""}>Sürdürülebilirlik Sağlar</option>
                                        <option value="fa-star" ${icon === "fa-star" ? "selected" : ""}>Marka Değerini Artırır</option>
                                        <option value="fa-bullseye" ${icon === "fa-bullseye" ? "selected" : ""}>Hedef Kitleyi Belirler</option>
                                        <option value="fa-lightbulb" ${icon === "fa-lightbulb" ? "selected" : ""}>Yenilikçi Çözümler Sunar</option>
                                        <option value="fa-clipboard-list" ${icon === "fa-clipboard-list" ? "selected" : ""}>Standartların Belirlenmesi</option>
                                        
                                        </select> 
                                </div>  
                            </div>

                            <hr class="hrGray">

                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Başlık Alanı :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <input type="text" name="baslik[]" id="baslik${iconAlanSayisi}" value="${baslik}" placeholder="Başlık Yazınız">
                                </div>
                            </div>

                            <hr class="hrGray">

                            <div class="fRow">
                                <div class="fBox ico">
                                    <h3>Metin Alanı :</h3>
                                </div>
                                <div class="fBox end w-100">
                                    <textarea name="metin[]" id="metin${iconAlanSayisi}" placeholder="Metin Yazınız">${metin}</textarea>
                                </div>
                            </div>

                            <hr class="hrGray">
                        </div>
                    `;

                        // HTML içeriğini eklenecek alana ekle
                        eklenecekAlan.insertAdjacentHTML('beforeend', formGroup);
                    });
                } else {
                    console.error("Geçerli veri bulunamadı.");
                }
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
    // Add a click event listener to the button
    menuBtn.addEventListener('click', function() {
        // Toggle the 'active' class for the sidebar and the button
        sidebar.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });









    $(document).ready(function() {
        $('#submitForm').on('click', function() {
            let formData = new FormData();


            // İkon, başlık ve metin alanlarını diziler halinde ekle
            $('select[name="icon[]"]').each(function() {
                formData.append('icon[]', $(this).val());
            });
            $('input[name="baslik[]"]').each(function() {
                formData.append('baslik[]', $(this).val());
            });
            $('textarea[name="metin[]"]').each(function() {
                formData.append('metin[]', $(this).val());
            });

            // ID'yi de formData'ya ekleyin
            formData.append("id", idd);

            // AJAX isteği gönderme
            $.ajax({
                url: 'kayit.php', // PHP dosyanızın yolu
                type: 'POST',
                data: formData,
                processData: false, // Form verilerini standart biçimde işleme
                contentType: false, // İçerik türünü belirtmemek için
                success: function(response) {
                    alert("Veriler kayıt edildi.")
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Hata:', textStatus, errorThrown);
                }
            });
        });
    });
    </script>


</body>

</html>