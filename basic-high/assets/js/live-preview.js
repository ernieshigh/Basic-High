/** custom scripts for Basic High theme **/

/** add real time functionality to WordPress customizer **/
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'high_site_title', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'high_site_descript', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#site-title a').css('color', newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update site body default color...
	wp.customize( 'high_color1', function( value ) {
		value.bind( function( newval ) {
			$('body, p').css('color', newval );
		} );
	} );
	
	//Update site link color in real time...
	wp.customize( 'high_color2', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
	} );
	
	//Update site headings color in real time...
	wp.customize( 'high_color3', function( value ) {
		value.bind( function( newval ) {
			$('h1, h2, h3, h4, h5, h6').css('color', newval );
		} );
	} );
	
	//Update main navbar in real time...
	wp.customize( 'high_menu_bg', function( value ) {
		value.bind( function( newval ) {
			$('.nav-container').css('background-color', newval );
		} );
	} );
	
	//Update main navbar in real time...
	wp.customize( 'high_menu_links', function( value ) {
		value.bind( function( newval ) {
			$('ul.navbar-nav li a').css('color', newval );
		} );
	} );
	
	
	
	
} )( jQuery );