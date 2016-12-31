/**
 * Responsive javascript
 */

/**
 * jQuery Mobile Menu
 * Turn unordered list menu into dropdown select menu
 * version 1.0(31-OCT-2011)
 *
 * Built on top of the jQuery library
 *   http://jquery.com
 *
 * Documentation
 * 	 http://github.com/mambows/mobilemenu
 */
(function(a){a.fn.mobileMenu=function(e){var b=a.extend({defaultText:"Navigate to...",className:"select-menu",subMenuClass:"sub-menu",subMenuDash:"&ndash;"},e),c=a(this);this.each(function(){c.find("ul").addClass(b.subMenuClass);a("<select />",{"class":b.className}).insertAfter(c);a("<option />",{value:"#",text:b.defaultText}).appendTo("."+b.className);c.find("a").each(function(){var d=a(this),c="&nbsp;"+d.text(),e=d.parents("."+b.subMenuClass).length;d.parents("ul").hasClass(b.subMenuClass)&&(d= Array(e+1).join(b.subMenuDash),c=d+c);a("<option />",{value:this.href,html:c,selected:this.href==window.location.href}).appendTo("."+b.className)});a("."+b.className).change(function(){"#"!==a(this).val()&&(window.location.href=a(this).val())})});return this}})(jQuery);


jQuery(document).ready(function( $ ){

    var mobile_menu_header2 = function() {
        if ( ! $('#header-container').hasClass('header_2') ) return;

        var nav = $('#nav').clone();
        //$('#nav').remove();

        if ( $(window).width() < 768 ) {
            if ( $('.header_skin2 #nav').length > 0 ) {
                nav.removeClass('container').prependTo( $('#header-right-content') );
                $('.header_skin2 #nav').remove();
            }
        } else {
            if ( $('#header-right-content #nav').length > 0 ) {
                nav.addClass('container').prependTo( $('.header_skin2') );
                $('#header-right-content #nav').remove();
            }
        }
    };

    mobile_menu_header2();
    $(window).resize(mobile_menu_header2);

    // menu in responsive, with select
    if( typeof( yit_responsive_menu_type ) != "undefined" && ( yit_responsive_menu_type == "select" || YIT_Browser.isIE8() ) )
	{
		if( $('body').hasClass('responsive') ) {
			$('#nav').after('<div class="menu-select"></div>');
			$('#nav ul:first-child').clone().appendTo('.menu-select');  
			$('.menu-select > ul').attr('id', 'nav-select').after('<div class="arrow-icon"></div>');
					  
			$( '#nav-select' ).hide().mobileMenu({
			    defaultText: yit_responsive_menu_text,
				subMenuDash : '-'
			});
			
			if( $('#header .slider').length <= 0 ) {
				$('.menu-select').addClass('no-slider');
			}
			
			//$( '#nav > ul, #nav .menu > ul' ).hide();
		}
	}
	else
	{
		if( $('body').hasClass('responsive') ) {
			$('#nav').prepend('<div class="menu-responsive group"><div class="navigate-text">' + yit_responsive_menu_text + '</div><div class="menu-arrow"></div></div>');
			$('#nav > ul, #nav > .menu > ul').clone().appendTo('.menu-responsive');
			$('.menu-responsive .sub-menu li a').prepend('- ');
			$('.menu-responsive .sub-menu .sub-menu li a').prepend('- ');
			$('.menu-arrow').on("click", function(event){
				$('.menu-responsive > ul').toggle();
				$(event.target).toggleClass("opened");
			});
		}
	}
	
    //shortcode banner
    $( '.sc-banner a[href=""]' ).click( function( e ) {
        e.preventDefault();
        return false;
    } );

});