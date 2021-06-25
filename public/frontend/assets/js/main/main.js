/* --------------------------------------------
 MAIN FUNCTION
-------------------------------------------- */
$(document).ready(function() {
    
	/* --------------------------------------------------------
	 ANIMATED PAGE ON REVEALED
	----------------------------------------------------------- */
	$(function($) {
		"use strict";
		$('.animated').appear(function() {
			var elem = $(this);
			var animation = elem.data('animation');
			if ( !elem.hasClass('visible') ) {
				var animationDelay = elem.data('animation-delay');
				if ( animationDelay ) {
				
					setTimeout(function(){
					 elem.addClass( animation + " visible" );
					}, animationDelay);
					
				} else {
					elem.addClass( animation + " visible" );
				}
			}
		});
	});
    

    /* --------------------------------------------
	 CLOSE COLLAPSE MENU ON MOBILE VIEW EXCEPT DROPDOWN
	-------------------------------------------- */
	$(function () {
        "use strict"; 
        $('.navbar-collapse ul li a:not(.dropdown-toggle)').on('click',function (event) { 
            $('.navbar-toggle:visible').click(); 
        }); 
    });
    
    /* --------------------------------------------
	 STICKY SETTING
	-------------------------------------------- */
	$(function () {
        "use strict"; 
        if( $(".navbar-sticky").length > 0){
            $(".navbar-sticky").sticky({ topSpacing: 0 });
            $(".navbar-sticky").css('z-index','100');
            $(".navbar-sticky").addClass('bg-light');
            $(".navbar-sticky").addClass("top-nav-collapse");
        };
    });
    
    
    /* --------------------------------------------------------
	 ANIMATED SCROLL PAGE WITH ACTIVE MENU - BOOTSTRAP SROLLSPY
	----------------------------------------------------------- */
    $(function(){
        "use strict";
        $(".navbar-op ul li a, .navbar-op a.navbar-brand, .intro-direction a, a.go-to-top").on('click', function(event) {    
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function(){
                window.location.hash = hash;
            });
        });
    });
    

    /* --------------------------------------------------------
	 NAVBAR FIXED TOP ON SCROLL
	----------------------------------------------------------- */
    $(function(){
        "use strict"; 
        if( $(".navbar-standart").length > 0 ){
            $(".navbar-pasific").addClass("top-nav-collapse");
        } else {
            $(window).scroll(function() {
                if ($(".navbar").offset().top > 10)  {
                    $(".navbar-pasific").addClass("top-nav-collapse");

                } else {
                    $(".navbar-pasific").removeClass("top-nav-collapse");
                }
            });
        };
    });
    
    /* --------------------------------------------------------
	 NAVBAR-INVERSE FIXED TOP ON SCROLL
	----------------------------------------------------------- */
    $(function(){
        "use strict"; 
        if( $(".navbar-pasific-inverse").length > 0 ){
            $(window).scroll(function() {
                if ($(".navbar").offset().top > 10)  {
                    $(".navbar-pasific").addClass("top-nav-collapse-inverse");

                } else {
                    $(".navbar-pasific").removeClass("top-nav-collapse-inverse");
                }
            });
        };
    });
    
    
    /* --------------------------------------------------------
	 GO TO TOP SCROLL
	----------------------------------------------------------- */
    $(function(){
        "use strict";
        if( $("a.go-to-top").length > 0 ){
            $("a.go-to-top").fadeOut();
            $(window).scroll(function() {
                if ($(".navbar").offset().top > 1200)  {
                    $("a.go-to-top").fadeIn();
                } else {
                    $("a.go-to-top").fadeOut();
                }
            });
        };
    });
    
    
    /* --------------------------------------------------------
	 BOOTSTRAP TOGGLE TOOLTIP
	----------------------------------------------------------- */
    $(function(){
        "use strict";
        $('[data-toggle="tooltip"]').tooltip();
    });


    /* --------------------------------------------------------
	 PAGE LOADER
	----------------------------------------------------------- */
    $(function() {
		"use strict";		
        $("body").imagesLoaded(function(){
            $(".loader-item").delay(700).fadeOut();
            $("#pageloader").delay(800).fadeOut("slow");
        });
	});

    
    
}(jQuery));
