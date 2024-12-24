document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".has-submenu");

    menuItems.forEach((item) => {
        item.addEventListener("click", function () {
            const submenu = item.querySelector(".submenu");

            // Toggle open class for submenu visibility
            if (submenu.style.display === "block") {
                submenu.style.display = "none";
                item.classList.remove("open");
            } else {
                submenu.style.display = "block";
                item.classList.add("open");
            }
        });
    });
});