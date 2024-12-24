$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        items: 3,  // Default number of items
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 7000,
        autoplayHoverPause: true,
        center: true,  // Highlight the center item
        onInitialized: function() {
            scaleItems();
        },
        onTranslated: function() {
            scaleItems();
        },
        responsive: {
            0: {
                items: 1,  // Show 1 item for screen widths 0px and above
            },
            731: {
                items: 3,  // Show 3 items for screen widths above 730px
            }
        }
    });

    function scaleItems() {
        $(".owl-item").each(function() {
            $(this).removeClass("center-item left-item right-item");
        });

        var centerItem = $(".owl-item.active.center");
        var leftItem = $(".owl-item.active.prev");
        var rightItem = $(".owl-item.active.next");

        centerItem.addClass("center-item");
        leftItem.addClass("left-item");
        rightItem.addClass("right-item");
    }
});
