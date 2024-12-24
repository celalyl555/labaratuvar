let currentOffset = 0; // Şu anki kayma miktarı
const maxOffset = 130; // Maksimum kayma
const step = 0.8; // Her scroll'da artış/azalış
let lastScrollY = window.scrollY; // Son scroll pozisyonu

document.addEventListener('scroll', () => {
    const elements = document.querySelectorAll('.missionImg, .missionTxt'); // Tüm ilgili öğeleri seç

    elements.forEach((element) => {
        moveElement(element); // Her bir öğe için hareket fonksiyonunu uygula
    });
});

function moveElement(element) {
    const elementRect = element.getBoundingClientRect(); // Öğenin ekrana göre konumu
    const windowHeight = window.innerHeight; // Pencere yüksekliği

    // Öğenin ekranın yarısına geldiğinde hareket başlasın
    if (elementRect.top < windowHeight / 1 && elementRect.bottom > 0) {
        const currentScrollY = window.scrollY; // Şu anki scroll pozisyonu

        // Aşağı scroll yapıldığında hareket
        if (currentScrollY > lastScrollY && currentOffset < maxOffset) {
            currentOffset = Math.min(maxOffset, currentOffset + step); // Kaymayı artır
        }

        // Yukarı scroll yapıldığında geri hareket
        if (currentScrollY < lastScrollY && currentOffset > 0) {
            currentOffset = Math.max(0, currentOffset - step); // Kaymayı azalt
        }

        element.style.transform = `translateY(${currentOffset}px)`; // Yukarı veya aşağı hareket uygula
        lastScrollY = currentScrollY; // Scroll pozisyonunu güncelle
    }
}


// ===================================================

// up animation

let currentOffset1 = 0; // Şu anki kayma miktarı
const maxOffset1 = 120; // Maksimum kayma
const step1 = 1; // Her scroll'da artış/azalış
let lastScrollY1 = window.scrollY; // Son scroll pozisyonu

document.addEventListener('scroll', () => {
    const img1 = document.querySelector('.historyImg'); // İlk resim öğesini seç
    const img2 = document.querySelector('.historyTxtImg'); // İkinci resim öğesini seç

    if (img1) {
        moveImage(img1);
    }
    if (img2) {
        moveImage(img2);
    }
});

function moveImage(img) {
    const imgRect = img.getBoundingClientRect(); // Resmin ekrana göre konumu
    const windowHeight = window.innerHeight; // Pencere yüksekliği

    // Resim ekranın içinde görünüyorsa
    if (imgRect.top < windowHeight / 1 && imgRect.bottom > 0) {
        const currentScrollY = window.scrollY; // Şu anki scroll pozisyonu

        // Aşağı scroll yapıldığında hareket
        if (currentScrollY > lastScrollY1 && currentOffset1 < maxOffset1) {
            currentOffset1 = Math.min(maxOffset1, currentOffset1 + step1);
        }

        // Yukarı scroll yapıldığında geri hareket
        if (currentScrollY < lastScrollY1 && currentOffset1 > 0) {
            currentOffset1 = Math.max(0, currentOffset1 - step1);
        }

        // Hareketi uygula
        img.style.transform = `translateY(-${currentOffset1}px)`;

        // Scroll pozisyonunu güncelle
        lastScrollY1 = currentScrollY;
    }
}
