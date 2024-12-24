const slides = document.querySelectorAll('.main-slide');
const overlays = document.querySelectorAll('.clr02');
const nextButton = document.getElementById('next');
const prevButton = document.getElementById('prev');
let currentIndex = 0;
const slideInterval = 6000; // 3 saniyede bir slayt geçişi
let slideTimer; // Oto-slide zamanlayıcısı

// Geçerli slaytı gösteren fonksiyon
function showSlide(index) {
  // Tüm overlay'leri başlat
  overlays.forEach((overlay, i) => {
    let delay;
    switch (i) {
      case 0:
        delay = 0; // İlk overlay için 0s gecikme
        break;
      case 1:
        delay = 0.2; // İkinci overlay için 0.2s gecikme
        break;
      case 2:
        delay = 0.5; // Üçüncü overlay için 0.5s gecikme
        break;
      case 3:
        delay = 0.8; // Dördüncü overlay için 0.8s gecikme
        break;
      case 4:
        delay = 1; // Beşinci overlay için 1s gecikme
        break;
      default:
        delay = 0; // Varsayılan davranış
    }
    overlay.style.display = 'block';
    overlay.style.animation = `color-swipe1 2s forwards ${delay}s`;
  });

  // Animasyon tamamlandığında slaytı güncelle
  overlays[overlays.length - 1].addEventListener(
    'animationend',
    () => {
      overlays.forEach((overlay) => {
        overlay.style.display = 'none'; // Overlay'leri gizle
      });
      // Slayt değişimini animasyon bitiminde yap
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
      });

      // Butonları tekrar aktif hale getir
      nextButton.disabled = false;
      prevButton.disabled = false;
    },
    { once: true }
  );

  // Animasyonun ortasında slaytı değiştir
  setTimeout(() => {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
    });
  }, 1000); // Animasyonun 1. saniyesinde slayt değişir
}

// İleri düğmesine tıklama
nextButton.addEventListener('click', () => {
  // Oto-slide zamanlayıcısını sıfırla
  clearInterval(slideTimer);

  // Butonu devre dışı bırak
  nextButton.disabled = true;
  prevButton.disabled = true;

  // Slaytı değiştir
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);

  // Zamanlayıcıyı yeniden başlat
  slideTimer = setInterval(() => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  }, slideInterval);
});

// Geri düğmesine tıklama
prevButton.addEventListener('click', () => {
  // Oto-slide zamanlayıcısını sıfırla
  clearInterval(slideTimer);

  // Butonu devre dışı bırak
  nextButton.disabled = true;
  prevButton.disabled = true;

  // Slaytı değiştir
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  showSlide(currentIndex);

  // Zamanlayıcıyı yeniden başlat
  slideTimer = setInterval(() => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  }, slideInterval);
});

// Sayfa yüklendiğinde ilk slaytı göster
showSlide(currentIndex);

// Oto-slide için setInterval ekle
slideTimer = setInterval(() => {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}, slideInterval); // 3 saniyede bir slayt geçişi
