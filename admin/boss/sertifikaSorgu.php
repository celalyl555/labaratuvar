<?php 
include("../../db.php"); 




try {
    

    // Sertifika tablosundan verileri çekme
    $stmt = $conn->prepare("SELECT * FROM sertifika");
    $stmt->execute();
    
    // Verileri al
    $sertifikalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
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
                    <li><a href="sertifikaAlani.php"><i class="fa-solid fa-feather-pointed"></i>Sertifika Yarar
                            Alanı</a></li>
                    <li><a href="sertifikaSorgu.php" class="active"><i class="fa-solid fa-certificate"></i>Sertifika
                            Sorgu</a></li>
                            <li><a href="../register.php"><i class="fa-solid fa-user-plus"></i>Hesap Oluştur</a></li>
                    <li class="logout"><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i>Çıkış
                            Yap</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <div class="cententHeader">
                <div class="Rowgap">
                    <i class="fa-solid fa-certificate"></i>
                    <h1>Sertifika Sorgu Alanı</h1>
                </div>
                <button id="submitForm" class="submitBtn">Kaydet</button>
            </div>
            <section class="content-area">
                <div class="logoAyar">
                    <div class="logoForm">
                        <form id="sertifikaForm" method="post">
                            <div class="logo-container labelFont">
                                <div class="formRows">
                                    <label for="firmUnvan">Firma Ünvanı :</label>
                                    <input type="text" id="firmUnvan" name="firmUnvan" placeholder="Firma Ünvanı"
                                        required="">
                                </div>
                                <div class="formRows">
                                    <label for="adres">Adres :</label>
                                    <input type="text" id="adres" name="adres" placeholder="Adres" required="">
                                </div>
                                <div class="formRows">
                                    <label for="standart">Standart :</label>
                                    <input type="text" id="standart" name="standart" placeholder="Standart" required="">
                                </div>
                                <div class="formRows">
                                    <label for="kapsam">Kapsam :</label>
                                    <input type="text" id="kapsam" name="kapsam" placeholder="Kapsam" required="">
                                </div>
                                <div class="formRows">
                                    <label for="kategori">EAC / Kategori :</label>
                                    <input type="text" id="kategori" name="kategori" placeholder="EAC / Kategori"
                                        required="">
                                </div>
                                <div class="formRows">
                                    <label for="sertifikaNo">Sertifika No :</label>
                                    <input type="text" id="sertifikaNo" name="sertifikaNo" placeholder="Sertifika No"
                                        required="">
                                </div>
                                <div class="formRows">
                                    <label for="akreditasyon">Akreditasyon :</label>
                                    <input type="number" id="akreditasyon" name="akreditasyon"
                                        placeholder="Akreditasyon" required="">
                                </div>
                                <div class="formRows">
                                    <label for="ilkBelgeDate">İlk Belge Tarihi :</label>
                                    <input type="date" id="ilkBelgeDate" name="ilkBelgeDate"
                                        placeholder="İlk Belge Tarihi" required="">
                                </div>
                                <div class="formRows">
                                    <label for="sertifikaDate">Sertifika Tarihi :</label>
                                    <input type="date" id="sertifikaDate" name="sertifikaDate"
                                        placeholder="Sertifika Tarihi" required="">
                                </div>
                                <div class="formRows">
                                    <label for="bitisDate">Bitiş Tarihi :</label>
                                    <input type="date" id="bitisDate" name="bitisDate" placeholder="Bitiş Tarihi"
                                        required="">
                                </div>
                                <div class="formRows">
                                    <label for="gecerlilik">Geçerlilik Durumu :</label>
                                    <select name="gecerlilik" id="gecerlilik" required="">
                                        <option value="" hidden selected>Geçerlilik Durmunu Seçiniz</option>
                                        <option value="Geçerli">Geçerli</option>
                                        <option value="kontrol Aşamasında">kontrol Aşamasında</option>
                                        <option value="Beklemede">Beklemede</option>
                                        <option value="Geçersiz">Geçersiz</option>
                                        <option value="Süresi Dolmuş">Süresi Dolmuş</option>
                                    </select>
                                </div>
                            </div>
                            <div class="kaydetBtn">
                                <button type="submit" class="submit-btn" id="saveBtn">Sertifika Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                $(document).ready(function() {
                    $("#sertifikaForm").submit(function(e) {
                        e.preventDefault(); // Formun normal submit işlemini engeller

                        var formData = $(this).serialize(); // Form verilerini alır

                        $.ajax({
                            url: 'sertifikaSave.php',
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                if (response == 'success') {
                                    alert("Sertifika başarıyla eklendi!");
                                    location.reload();
                                } else {
                                    alert("Bir hata oluştu, lütfen tekrar deneyin.");
                                }
                            },
                            error: function() {
                                alert("Bir hata oluştu, lütfen tekrar deneyin.");
                            }
                        });
                    });
                });
                </script>



                <input class="searchAlan" type="text" id="searchInput" placeholder="Arama yap...">

                <div class="tableoverflow">

                    <div class="table-container">


                        <table>
                            <thead>
                                <tr>
                                    <th>Firma Ünvanı</th>
                                    <th>Adres</th>
                                    <th>Standart</th>
                                    <th>Kapsam</th>
                                    <th>EAC / Kategori</th>
                                    <th>Sertifika No</th>
                                    <th>Akreditasyon</th>
                                    <th>İlk Belge Tarihi</th>
                                    <th>Sertifika Tarihi</th>
                                    <th>Bitiş Tarihi</th>
                                    <th>Geçerlilik Durumu</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sertifikalar as $sertifika): ?>
                                <tr>
                                    <td class="editable" data-field="Firma_unvan">
                                        <?= htmlspecialchars($sertifika['Firma_unvan']); ?></td>
                                    <td class="editable" data-field="Adres">
                                        <?= htmlspecialchars($sertifika['Adres']); ?></td>
                                    <td class="editable" data-field="Standart">
                                        <?= htmlspecialchars($sertifika['Standart']); ?></td>
                                    <td class="editable" data-field="Kapsam">
                                        <?= htmlspecialchars($sertifika['Kapsam']); ?></td>
                                    <td class="editable" data-field="Eac"><?= htmlspecialchars($sertifika['Eac']); ?>
                                    </td>
                                    <td class="editable" data-field="Sertifika_no">
                                        <?= htmlspecialchars($sertifika['Sertifika_no']); ?></td>
                                    <td class="editable" data-field="Akreditasyon">
                                        <?= htmlspecialchars($sertifika['Akreditasyon']); ?></td>
                                    <td class="editable" data-field="First_belge_tar">
                                        <?= htmlspecialchars(formatDate($sertifika['First_belge_tar'])); ?></td>
                                    <td class="editable" data-field="Sertifika_tar">
                                        <?= htmlspecialchars(formatDate($sertifika['Sertifika_tar'])); ?></td>
                                    <td class="editable" data-field="Bitis_tar">
                                        <?= htmlspecialchars(formatDate($sertifika['Bitis_tar'])); ?></td>
                                    <td class="editable" data-field="Durum">
                                        <?= htmlspecialchars($sertifika['Durum']); ?></td>
                                    <td>
                                        <button class="btn btn-edit">Düzenle</button>
                                        <button class="btn btn-save" style="display: none;">Kaydet</button>
                                        <button class="btn btn-delete" data-id="<?= $sertifika['id']; ?>">Sil</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>


                    </div>

                </div>


            </section>
        </main>
    </div>
    <?php function formatDate($date) {
    // Tarihi Y-m-d formatından d/m/Y formatına çevir
    $formattedDate = date("d/m/Y", strtotime($date));
    return $formattedDate;
} ?>
    <script>
    $(document).on('click', '.btn-delete', function() {
        var sertifikaId = $(this).data('id'); // Silinecek sertifikanın ID'si
        var row = $(this).closest('tr'); // Bu satırı al

        // Kullanıcıdan onay al
        if (confirm('Bu sertifikayı silmek istediğinizden emin misiniz?')) {
            // Silme işlemi için AJAX isteği gönder
            $.ajax({
                url: 'sertifikaDelete.php',
                type: 'POST',
                data: {
                    id: sertifikaId
                },
                success: function(response) {
                    if (response == 'success') {
                        row.remove(); // Satırı sil
                    } else {
                        alert('Silme işlemi başarısız.');
                    }
                },
                error: function() {
                    alert('Bir hata oluştu.');
                }
            });
        }
    });



// Input ve tablo elemanlarını seç
const searchInput = document.getElementById('searchInput');
const table = document.querySelector('table tbody');

// Arama fonksiyonu
searchInput.addEventListener('input', () => {
    const searchText = searchInput.value.toLowerCase();
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let matchFound = false;

        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchText)) {
                matchFound = true;
            }
        });

        // Satırı göster veya gizle
        row.style.display = matchFound ? '' : 'none';
    });
});




    // JavaScript ile düzenleme modu aktif etme
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll('.btn-edit');
        const saveButtons = document.querySelectorAll('.btn-save');
        const deleteButtons = document.querySelectorAll('.btn-delete');

        editButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const cells = row.querySelectorAll('td.editable');

                cells.forEach(cell => {
                    const field = cell.getAttribute('data-field');
                    const value = cell.textContent.trim();

                    if (field === 'First_belge_tar' || field === 'Sertifika_tar' ||
                        field === 'Bitis_tar') {
                        // Date input tipine dönüştür
                        const input = document.createElement('input');
                        input.type = 'date';
                        input.value = value;
                        cell.innerHTML = '';
                        cell.appendChild(input);
                    } else if (field === 'Durum') {
                        // Select input tipine dönüştür
                        const select = document.createElement('select');
                        select.innerHTML = `
                        <option value="" hidden>Geçerlilik Durmunu Seçiniz</option>
                        <option value="Geçerli" ${value === 'Geçerli' ? 'selected' : ''}>Geçerli</option>
                        <option value="kontrol Aşamasında" ${value === 'kontrol Aşamasında' ? 'selected' : ''}>kontrol Aşamasında</option>
                        <option value="Beklemede" ${value === 'Beklemede' ? 'selected' : ''}>Beklemede</option>
                        <option value="Geçersiz" ${value === 'Geçersiz' ? 'selected' : ''}>Geçersiz</option>
                        <option value="Süresi Dolmuş" ${value === 'Süresi Dolmuş' ? 'selected' : ''}>Süresi Dolmuş</option>
                    `;
                        cell.innerHTML = '';
                        cell.appendChild(select);
                    } else {
                        // Text input tipine dönüştür
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.value = value;
                        cell.innerHTML = '';
                        cell.appendChild(input);
                    }
                });

                // Düzenleme ve kaydetme butonlarını göster
                button.style.display = 'none';
                saveButtons[index].style.display = 'inline-block';
            });
        });

        saveButtons.forEach((button, index) => {
            button.addEventListener('click', function() {
                const row = button.closest('tr');
                const cells = row.querySelectorAll('td.editable');
                const updatedData = {};

                cells.forEach(cell => {
                    const field = cell.getAttribute('data-field');
                    const input = cell.querySelector('input, select');
                    updatedData[field] = input ? input.value : cell.textContent.trim();
                });

                // AJAX ile veriyi kaydet
                const id = row.querySelector('.btn-delete').getAttribute('data-id');
                const data = {
                    id: id,
                    updatedData: updatedData
                };

                fetch('sertifikaUpdate.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            // Başarılı ise tabloyu güncelle
                            cells.forEach(cell => {
                                const input = cell.querySelector('input, select');
                                if (input) {
                                    cell.textContent = input.value;
                                }
                            });
                            button.style.display = 'none';
                            editButtons[index].style.display = 'inline-block';
                        } else {
                            alert('Güncelleme başarısız oldu.');
                        }
                    });
            });
        });
    });
    </script>




</body>

</html>