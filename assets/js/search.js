document.addEventListener("DOMContentLoaded", function () {
    const searchIco = document.querySelector(".searchico");
    const searchBox = document.querySelector(".searchbox");
    const svgSS = document.querySelector(".svgss");
    const svgS = document.querySelector(".svgs");

    searchIco.addEventListener("click", function () {
        // searchbox görünürlüğünü değiştir
        if (searchBox.style.display === "flex") {
            // active sınıfını hemen kaldır
            searchBox.classList.remove("active");

            // 0.5 saniye sonra display: none yap
            setTimeout(() => {
                searchBox.style.display = "none";
            }, 300);
        } else {
            searchBox.style.display = "flex"; // searchbox'ı göster
            setTimeout(() => {
                searchBox.classList.add("active");
            }, 0);
        }

        // active sınıfını svg simgelerinde değiştir
        svgSS.classList.toggle("active");
        svgS.classList.toggle("active");
    });
});

// ==================================================================

// enter ile search

document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.getElementById("search-button");
    const searchInput = document.getElementById("search-input");

    // Arama işlemi
    function performSearch() {
        const query = searchInput.value.trim();
        if (query) {
            console.log("Arama yapılıyor:", query);
            // Buraya arama işlemini gerçekleştirecek kodu ekleyebilirsiniz
        } else {
            console.log("Arama kutusu boş.");
        }
    }

    // Butona tıklama olayını dinleme
    searchButton.addEventListener("click", performSearch);

    // "Enter" tuşuna basılma olayını dinleme
    searchInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            performSearch();
        }
    });
});
