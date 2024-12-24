const menuButton = document.getElementById("menuButton");
const menuOverlay = document.getElementById("menuOverlay");
const closeButton = document.getElementById("closeButton");
const menuContent = document.querySelector(".menu-content");

// Menü açma
menuButton.addEventListener("click", () => {
    menuOverlay.classList.add("active");
    setTimeout(() => {
        menuOverlay.classList.add("active1");
    }, 100);
});

// Menü kapatma
closeButton.addEventListener("click", () => {
    menuOverlay.classList.remove("active1");
    setTimeout(() => {
        menuOverlay.classList.remove("active");
    }, 100);
});

// menu-content üzerinde tıklamaları durdur
menuContent.addEventListener("click", (event) => {
    event.stopPropagation(); // Tıklama olayını üst seviyeye (menu-overlay) iletmez
});

// Menü overlay'e tıklayınca kapatma
menuOverlay.addEventListener("click", () => {
    menuOverlay.classList.remove("active1");
    setTimeout(() => {
        menuOverlay.classList.remove("active");
    }, 100);
});

// ================================================

// accordion manu sidenav

document.querySelectorAll('.accordion-btn').forEach((button) => {
    button.addEventListener('click', function () {
        // Diğer alt menüleri kapat
        const parentSubmenu = this.nextElementSibling;
        const isOpen = parentSubmenu.style.display === 'flex';

        document.querySelectorAll('.a-submenu').forEach((submenu) => {
            submenu.style.display = 'none';
        });

        // Tıklanan menüyü aç veya kapat
        parentSubmenu.style.display = isOpen ? 'none' : 'flex';

        // Tüm .accordion-btn'lardan active sınıfını kaldır
        document.querySelectorAll('.accordion-btn').forEach((btn) => {
            btn.classList.remove('active');
        });

        // Sadece tıklanan .accordion-btn'a active sınıfını ekle
        if (!isOpen) {
            this.classList.add('active');
        }
    });
});