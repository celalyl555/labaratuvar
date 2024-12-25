document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".has-submenu");

    menuItems.forEach((item) => {
        item.addEventListener("click", function (e) {
            const submenu = item.querySelector(".submenu");

            // Önceki açılmaları kapatmayı engellemek için tıklamayı iptal et
            e.stopPropagation();

            // Alt menüyü göster/gizle
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
                item.classList.remove("open");
            } else {
                submenu.style.display = "block";
                item.classList.add("open");
            }
        });
    });

    const submenuItems = document.querySelectorAll(".has-submenu-child");

    submenuItems.forEach((item) => {
        item.addEventListener("click", function (e) {
            const submenuChild = item.querySelector(".submenu-child");

            // Önceki açılmaları kapatmayı engellemek için tıklamayı iptal et
            e.stopPropagation();

            // Alt alt menüyü göster/gizle
            if (submenuChild.style.display === "block") {
                submenuChild.style.display = "none";
                item.classList.remove("open");
            } else {
                submenuChild.style.display = "block";
                item.classList.add("open");
            }
        });
    });
});
