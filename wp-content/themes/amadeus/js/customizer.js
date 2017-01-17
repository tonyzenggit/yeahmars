/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	//Logo size
	wp.customize('logo_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-logo').css('max-width', newval + 'px' );
			$('.custom-logo').css('max-width', newval + 'px' );
		} );
	});



	//Social background
	wp.customize('social_bg',function( value ) {
		value.bind( function( newval ) {
			$('.social-navigation').css('background-color', newval );
		} );
	});
	//Branding background
	wp.customize('branding_bg',function( value ) {
		value.bind( function( newval ) {
			$('.branding-wrapper').css('background-color', newval );
		} );
	});
	//Menu background
	wp.customize('menu_bg',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation').css('background-color', newval );
		} );
	});
	//Menu color
	wp.customize('menu_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation a').attr('style', 'color:' + newval + '!important;' );
			$('.main-navigation ul ul a').css('color', '#fff' );
		} );
	});


	//Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').attr('style', 'color:' + newval + '!important;' );

		} );
	});
	//Site desc
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});
	// Body text color
	wp.customize('body_text_color',function( value ) {
		value.bind( function( newval ) {
			$('body, .widget a').css('color', newval );
		} );
	});
	// Entry titles
	wp.customize('entry_titles',function( value ) {
		value.bind( function( newval ) {
			$('.entry-title, .entry-title a').attr('style', 'color:' + newval + '!important;' );
		} );
	});
	// Entry meta
	wp.customize('entry_meta',function( value ) {
		value.bind( function( newval ) {
			$('.entry-meta, .entry-meta a, .entry-footer, .entry-footer a').attr('style', 'color:' + newval + '!important;' );
		} );
	});	
	// Footer bg
	wp.customize('footer_bg',function( value ) {
		value.bind( function( newval ) {
			$('.site-footer, .footer-widget-area').css('background-color', newval );
		} );
	});	
	// Font sizes
	wp.customize('site_title_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-title').css('font-size', newval + 'px' );
		} );
	});	
	wp.customize('site_desc_size',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('font-size', newval + 'px' );
		} );
	});				
	wp.customize('h1_size',function( value ) {
		value.bind( function( newval ) {
			$('h1').not('.site-title, .slide-title').css('font-size', newval + 'px' );
		} );
	});	
    wp.customize('h2_size',function( value ) {
        value.bind( function( newval ) {
            $('h2').not('.site-description').css('font-size', newval + 'px' );
        } );
    });	
    wp.customize('h3_size',function( value ) {
        value.bind( function( newval ) {
            $('h3').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h4_size',function( value ) {
        value.bind( function( newval ) {
            $('h4').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h5_size',function( value ) {
        value.bind( function( newval ) {
            $('h5').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('h6_size',function( value ) {
        value.bind( function( newval ) {
            $('h6').css('font-size', newval + 'px' );
        } );
    });
    wp.customize('body_size',function( value ) {
        value.bind( function( newval ) {
            $('body').css('font-size', newval + 'px' );
        } );
    });

	
} )( jQuery );
