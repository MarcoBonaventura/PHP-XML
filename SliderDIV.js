$(window).load(function() {
    jQuery(function ($) {
        $(".more").hide();
        $('.button-read-more').click(function () {
            $(this).closest('.less').addClass('active');
            $(this).closest(".less").prev().stop(true).slideDown("2000");
            });
        $('.button-read-less').click(function () {
            $(this).closest('.less').removeClass('active');
            $(this).closest(".less").prev().stop(true).slideUp("2000");
            });
        });
    });