$(document).ready(function() {
    $('a[href*=#]').click(function() 
        {  
        if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) 
            {  
            var $target = $(this.hash);  
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');  
            if ($target.length) 
                {  
                var targetOffset = ($target.offset().top)-161; //posiziono il blocco appena sotto l'header 
                $('html,body').animate({scrollTop: targetOffset}, 1500);  
                return false;
                }  
            }  
        }); 
    });