document.addEventListener('click', function (event) {
  const allDivs = document.querySelectorAll('.content-div');
  const allButtons = document.querySelectorAll('.navA');
  const headerImg1 = document.querySelector('.header-img');
  const clickedElement = event.target;

  // Eğer bir div dışında bir yere tıklandıysa, tüm div'leri kapat ve black sınıfını sil
  let isInsideDiv = false;
  allDivs.forEach((div) => {
    if (div.contains(clickedElement) || div.previousElementSibling.contains(clickedElement)) {
      isInsideDiv = true;
    } else {
      div.classList.add('hidden');
      div.classList.remove('visible');
      headerImg1.classList.remove('transparent-bg');
    }
  });

  if (!isInsideDiv) {
    allDivs.forEach((div) => {
      div.classList.add('hidden');
      div.classList.remove('visible');
      headerImg1.classList.remove('transparent-bg');
    });
    allButtons.forEach((button) => {
      button.classList.remove('black'); // black sınıfını kaldır
    });
  }
});

function toggleDiv(event, divId) {
  event.stopPropagation(); // Tıklama olayını belgeye iletme
  const targetDiv = document.getElementById(divId);
  const isVisible = targetDiv.classList.contains('visible');
  const allButtons = document.querySelectorAll('.navA');
  const headerImg1 = document.querySelector('.header-img');

  // Tüm div'leri gizle ve black sınıfını kaldır
  document.querySelectorAll('.content-div').forEach(div => {
    div.classList.add('hidden');
    div.classList.remove('visible');
    headerImg1.classList.remove('transparent-bg');
  });

  allButtons.forEach((button) => {
    button.classList.remove('black'); // black sınıfını kaldır
    headerImg1.classList.remove('transparent-bg');
  });

  // Tıklanan div'i aç/kapat ve black sınıfını ekle
  if (!isVisible) {
    targetDiv.classList.remove('hidden');
    targetDiv.classList.add('visible');
    headerImg1.classList.add('transparent-bg');
    allButtons.forEach((button) => {
      button.classList.add('black'); // black sınıfını ekle
    });
  }
}



let lastScrollTop = 0; // Son kaydırma pozisyonu
const topHeader = document.querySelector('.top-header');
const bottomHeader = document.querySelector('.header');
const bgHeader = document.querySelector('.bgheader');
const headerImg = document.querySelector('.header-img');

window.addEventListener('scroll', function() {
    if (window.innerWidth > 960) { // 960px'ten büyükse çalışsın
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > 100) {
            if (currentScroll > lastScrollTop) {
                // Scroll down
                topHeader.style.display = 'none';
                bottomHeader.style.height = '65px';
            } else {
                // Scroll up
                topHeader.style.display = 'flex';
                bottomHeader.style.height = '115px';
            }
            
            // 100px'i geçtiğinde active sınıfını ekle
            bgHeader.classList.add('active');
            headerImg.classList.add('active');
        } else {
            // Eğer scroll 100px'ten azsa top-header hep görünür
            topHeader.style.display = 'flex';
            bottomHeader.style.height = '115px';

            // 100px'in altındaysa active sınıfını kaldır
            bgHeader.classList.remove('active');
            headerImg.classList.remove('active');
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Yine en üstteysen sıfırla
    }
});