/* global amadeusCustomizerObject */
/*
Upsells
*/

jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation link and Upgrade to PRO link */


	if( !jQuery( '.amadeus-upsells' ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section amadeus-upsells" style="padding-bottom: 15px">');
		}

    if( jQuery( '.amadeus-upsells' ).length ) {

  		jQuery('.amadeus-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://docs.themeisle.com/article/270-amadeus-documentation" class="button" target="_blank">{documentation}</a>'.replace('{documentation}', amadeusCustomizerObject.documentation));

  	}

	if ( !jQuery( '.amadeus-upsells' ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
	
	jQuery('.preview-notice').append('<a class="amadeus-upgrade-to-pro-button" href="http://themeisle.com/themes/amadeus-pro/" class="button" target="_blank">{pro}</a>'.replace('{pro}',amadeusCustomizerObject.pro));

	//Locked sections
	jQuery('#accordion-section-amadeus_extra_options').click(function() {
		jQuery('.wp-full-overlay').removeClass('section-open');
		jQuery('accordion-section-amadeus_extra_options').removeClass('open');
		window.location.href = "http://themeisle.com/themes/amadeus-pro/";
	});

});
