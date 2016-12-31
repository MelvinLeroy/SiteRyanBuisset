// In case we forget to take out console statements. IE becomes very unhappy when we forget. Let's not make IE unhappy
if(typeof(console) === 'undefined') {
    var console = {}
    console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
}

jQuery( document ).ready( function( $ ) {
    $('body').removeClass('no_js').addClass('yes_js');

    if ( YIT_Browser.isIE8() ) {
        $('*:last-child').addClass('last-child');
    }

    if( YIT_Browser.isIE10() ) {
        $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
    }

    //placeholder support
    if($.fn.placeholder) {
        $('input[placeholder], textarea[placeholder]').placeholder();
    }

    // simple select style
    var custom_selects = $('.woocommerce-ordering select, .faq-filters select');
    if ( custom_selects.length > 0 ) {
        custom_selects.selectbox({
            effect: 'fade'
        });
    }

    //header fixed
    if( $('body.stretched').hasClass('header-fixed') ) {
        var height = $('#header').height();
        $('#wrapper').css('margin-top', height);

        $(window).on('resize', function(){
            var height = $('#header').height();
            $('#wrapper').css('margin-top', height);
        });
    }


    /*
     //header height
     if( $('#header-cart').length > 0 ) {
     $(window).resize(function(){
     var header = $('#header-container .span10');
     var cart   = $('#header-cart .innerborder');

     cart.height(header.height()-10);
     }).resize();
     }
     */

    //iPad, iPhone hack
    $('.ch-item').bind('hover', function(e){});

    //Form fields shadow
    $( 'form input[type="text"], form textarea' ).focus(function() {
        //Hide label
        $( this ).parent().find( 'label.hide-label' ).hide();
    }).blur(function() {
            //Show label
            if( $( this ).val() == '' )
            { $( this ).parent().find( 'label.hide-label' ).show(); }
        }).each( function() {
            //Show label
            if( $( this ).val() != '' && $( this ).parent().find( 'label.hide-label' ).is( ':visible' ) )
            { $( this ).parent().find( 'label.hide-label' ).hide(); }
        });
    /*
     // remove margin from the slider, if the page is empty
     if ( $('.slider').length != 0 && $.trim( $('#primary *, #page-meta').text() ) == '' ) {
     //$('.slider').attr('style', 'margin-bottom:0 !important;');
     $('#primary').remove();
     }
     */

    //play, zoom on image hover
    var yit_lightbox;
    (yit_lightbox = function(){

        if( jQuery( 'body' ).hasClass( 'isMobile' ) ) {
            jQuery("a.thumb.img, .overlay_img, .section .related_proj, a.ch-info-lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox',
                fixed:true,
                maxWidth: '100%',
                maxHeight: '100%',
                opacity : 0.7
            });

            jQuery(".section .related_lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox2',
                fixed:true,
                maxWidth: '100%',
                maxHeight: '100%',
                opacity : 0.7
            });
        } else {
            jQuery("a.thumb.img, .overlay_img, .section.portfolio .related_proj, a.ch-info-lightbox, a.ch-info-lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox',
                fixed:true,
                maxWidth: '80%',
                maxHeight: '80%',
                opacity : 0.7
            });

            jQuery(".section.portfolio .related_lightbox").colorbox({
                transition:'elastic',
                rel:'lightbox2',
                fixed:true,
                maxWidth: '80%',
                maxHeight: '80%',
                opacity : 0.7
            });
        }

        jQuery("a.thumb.video, .overlay_video, .section.portfolio .related_video, a.ch-info-lightbox-video").colorbox({
            transition:'elastic',
            rel:'lightbox',
            fixed:true,
            maxWidth: '60%',
            maxHeight: '80%',
            innerWidth: '60%',
            innerHeight: '80%',
            opacity : 0.7,
            iframe: true,
            onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
        });
        jQuery(".section.portfolio .lightbox_related_video").colorbox({
            transition:'elastic',
            rel:'lightbox2',
            fixed:true,
            maxWidth: '60%',
            maxHeight: '80%',
            innerWidth: '60%',
            innerHeight: '80%',
            opacity : 0.7,
            iframe: true,
            onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
        });
    })();


    //overlay
    $('.picture_overlay').hover(function(){

        var width = $(this).find('.overlay div').innerWidth();
        var height =  $(this).find('.overlay div').innerHeight();
        var div = $(this).find('.overlay div').css({
            'margin-top' : - height / 2,
            'margin-left' : - width / 2
        });

        if(YIT_Browser.isIE8()) {
            $(this).find('.overlay > div').show();
        }
    }, function(){

        if(YIT_Browser.isIE8()) {
            $(this).find('.overlay > div').hide();
        }
    }).each(function(){
            var width = $(this).find('.overlay div').innerWidth();
            var height =  $(this).find('.overlay div').innerHeight();
            var div = $(this).find('.overlay div').css({
                'margin-top' : - height / 2,
                'margin-left' : - width / 2
            });
        });


    //Sticky Footer
    $( '#primary' ).imagesLoaded( function() {
        if( $( '#footer' ).length > 0 )
        { $( '#footer' ).stickyFooter(); }
        else
        { $( '#copyright' ).stickyFooter(); }
    } );

    // portfolio simply project info fix
    $('.portfolio-simply').each(function(){
        var add_padding;
        var $thisp = $(this);
        (add_padding = function(){
            var project_info_height = $thisp.find('.work-skillsdate').height() + 14;
            $thisp.find('.work-description').css( 'padding-bottom', project_info_height+'px' );
        })();
        $(window).resize(add_padding);
    });

    // replace type="number" in opera
    $('.opera .quantity input.input-text.qty').replaceWith(function() {
        $(this).attr('value')
        return '<input type="text" class="input-text qty text" name="quantity" value="' + $(this).attr('value') + '" />';
    });

    // hide #back-top first
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    // bookmark
    $("a.bookmark").click(function(e) {
        e.preventDefault();

        var url = $(this).attr('href'),
            title = $(this).attr('title');

        if (window.sidebar) { // Mozilla Firefox Bookmark
            window.sidebar.addPanel(title, url,"");
        } else if( window.external ) { // IE Favorite
            window.external.AddFavorite( url, title);
        } else if(window.opera && window.print) { // Opera Hotlist
            return true;
        }
    });

    // teaser fix
    var fix_teaser_height = function(){
        $('.teaser .image p.title').each( function(){
            var title = $(this);
            title.height( title.height() );
        });
    };
    $('.teaser').imagesLoaded( fix_teaser_height );
    $(window).on( 'resize', fix_teaser_height );

    /*
     $('#sidebar-shop-sidebar .widget h3').prepend('<div class="minus" />');
     $('#sidebar-shop-sidebar .widget').on('click', 'h3', function(){
     $(this).parent().find('> *:not(h3)').slideToggle();

     if( $(this).find('div').hasClass('minus') ) {
     $(this).find('div').removeClass('minus').addClass('plus');
     } else {
     $(this).find('div').removeClass('plus').addClass('minus');
     }
     });
     */

    function dropdown_widget_nav() {

        $('.widget.yith-woo-ajax-navigation h3').each(function () {

            var header = $(this);
            var widget = $(this).parent();
            var ul = widget.find('> ul.yith-wcan');

            if (ul.length != 0) {

                header.css('cursor', 'pointer');

                //init widget
                if (!widget.hasClass('closed') && !widget.hasClass('opened')) {
                    widget.addClass('opened');
                }
                if (widget.hasClass('closed')) {
                    ul.hide();
                    header.append('<div class="plus">+</div>');
                }
                if (widget.hasClass('opened')) {
                    header.append('<div class="minus">-</div>');
                }
            }
        });
    }

    $(document).on('yith-wcan-ajax-filtered', dropdown_widget_nav);

});