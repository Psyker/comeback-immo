
jQuery(document).ready(function($) {

    "use strict";

    // Home Slider

    $('#slider').flexslider({
        animation: "slide"
    });

    // Select Box Replacements

    $('select').selectBox({
        mobile: true,
        menuSpeed: 'fast'
    });
	
	// Properties Slider
	
	$('#property-slider').flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#property-carousel"
    });
    $('#property-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 200,
        itemMargin: 24,
        minItems: 1,
        move: 1,
        asNavFor: '#property-slider'
    });

    // Accordions

    $( ".accordion" ).accordion({
        heightStyle: "content",
        collapsible: true
    });

    // Area Range

    $( "#area-range" ).slider({
        range: true,
        min: 0,
        max: 1000,
        values: [ 0, 500 ],
        slide: function( event, ui ) {
            $( "#area-min" ).val( ui.values[ 0 ]);
            $( "#area-max" ).val( ui.values[ 1 ])
        }
    });
    $( "#area-min" ).val( $( "#area-range" ).slider( "values", 0 ));
    $( "#area-max" ).val( $( "#area-range" ).slider( "values", 1 ));

    // Price Range

    $( "#price-range" ).slider({
        range: true,
        min: 0,
        max: 2000000,
        values: [ 0, 500000 ],
        slide: function( event, ui ) {
            $( "#price-min" ).val( ui.values[ 0 ]);
            $( "#price-max" ).val( ui.values[ 1 ])
        }
    });
    $( "#price-min" ).val( $( "#price-range" ).slider( "values", 0 ));
    $( "#price-max" ).val( $( "#price-range" ).slider( "values", 1 ));

    // Checkbox Replacements

    $('input.checkbox').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%'
    });

    // Gallery Grid

    $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: 0
    });

    // Counter

    $(function() {
        var value;
        $('.counter span').appear();
        $(document.body).on('appear', '.counter span', function(e, $affected) {
            $affected.each(function() {
                value = $(this).data('fact');
                $(this).animateNumbers( value, false, 1000, "easeOutBounce" );
            });
        });
    });

    $('.animated').appear();

});