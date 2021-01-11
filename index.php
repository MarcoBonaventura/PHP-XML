<!DOCTYPE html>

<?php 
    session_start(); 
    //session_regenerate_id(TRUE);
?>

<html lang="it">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="esercizio di stile con PHP, MySQL e CSS" content="" />
    <meta name="keywords" content="" />
    <meta name="Marco bonaventura" content="" />

    <link rel="stylesheet" href="styles/style.css" media="screen" />
    <link rel="stylesheet" href="styles/printer.css" media="print" />
    <link rel="stylesheet" href="styles/phone_landscape.css" media="screen and (max-device-width: 480px) and (orientation: landscape)" />
    <link rel="stylesheet" href="styles/phone_portrait.css" media="screen and (max-device-width: 480px) and (orientation: portrait)" />
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

    <script type="text/javascript" src="./jquery-1.11.3.js"></script>
    <script type="text/javascript" src="./jquery.min.js"></script>
    
    <script type="text/javascript" src="./ScrollVert.js"></script>
    <script src="./alertify/lib/alertify.min.js"></script>

    <script type="text/javascript" src="spin.js"></script>

    <script type='text/javascript'>//<![CDATA[ 
        
    var spinner;
    
    function InitSpinner() {
            var target = document.getElementById("container");
            spinner = new Spinner(opts).spin(target);
        };
        
        var opts = {
            lines: 13 // The number of lines to draw
            , length: 29 // The length of each line
            , width: 12 // The line thickness
            , radius: 56 // The radius of the inner circle
            , scale: 1 // Scales overall size of the spinner
            , corners: 1 // Corner roundness (0..1)
            , color: '#000' // #rgb or #rrggbb or array of colors
            , opacity: 0.35 // Opacity of the lines
            , rotate: 0 // The rotation offset
            , direction: 1 // 1: clockwise, -1: counterclockwise
            , speed: 0.8 // Rounds per second
            , trail: 60 // Afterglow percentage
            , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
            , zIndex: 2e9 // The z-index (defaults to 2000000000)
            , className: 'spinner' // The CSS class to assign to the spinner
            , top: '50%' // Top position relative to parent
            , left: '50%' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'absolute' // Element positioning
        };
            
            
            
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
            
                
        
            jQuery(function ($) {
                $(".more-EDIT").hide();
                $('.button-read-more-EDIT').click(function () {
                $(this).closest('.less-EDIT').addClass('active');
                $(this).closest(".less-EDIT").prev().stop(true).slideDown("2000");
                });
            $('.button-read-less-EDIT').click(function () {
            $(this).closest('.less-EDIT').removeClass('active');
            $(this).closest(".less-EDIT").prev().stop(true).slideUp("2000");
            });
        });
        
        $('#dvLoading').fadeOut(1000);
        
        });//]]>  
    </script>

    <!-- Include the heartcode canvasloader js file -->
        <script src="heartcode-canvasloader-min-0.9.1.js"></script>
        
        
        


    <style type="text/css">	@import "./menu/menu.css";</style>

    <style type="text/css">
        #dvLoading 
        { 
            background:#000 url(images/Preloader_21.gif) no-repeat center center; 
            height: 100%; 
            width: 100%; 
            position: fixed; 
            z-index: 1000; 
            left:0; 
            top: 0; 
            margin: 0 auto;
            opacity: 0.8;
        } 
    </style>

    <title>Libri Job 2.0</title>

</head>
    <body>
        <div id="dvLoading"></div>
  
        <header>

            <?php include('./includes/header.php'); ?>

            <?php include('./includes/nav.php'); ?>

        </header>

        <div id="wrapper">

            

            <section>

                <?php include('./about.php'); ?>

            </section>
            
            
        </div> <!-- End #wrapper -->

        

        <footer>
            
            <?php include('./includes/footer.php'); ?>

        </footer>

    </body>
</html>

