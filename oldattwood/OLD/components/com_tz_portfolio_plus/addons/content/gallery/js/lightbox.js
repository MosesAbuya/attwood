jQuery(function($){
    var lightboxopen = false;
    $('.tz_portfolio_plus_gallery .gallery-title').on('click', function(event) {
        event.preventDefault();
        var $pic        = $('.tz_portfolio_plus_gallery');
        var $clickid    = $(this).attr('data-id');
        var $index      = 0;

        var getItems = function() {
            var items = [];
            $pic.find('.gallery-listing').each(function() {
                var thumb       =   $(this).find('.gallery-title').attr('data-thumb'),
                    $href       =   $(this).find('.gallery-title').attr('href'),
                    $dataid     =   $(this).find('.gallery-title').attr('data-id'),
                    $caption    =   $(this).find('.image-caption').text();
                if ($dataid !== 'undefined' && $dataid !== null) {
                    var item = {
                        src     : $href,
                        opts    : {
                            caption : $caption,
                            thumb   : thumb
                        }
                    };
                    items.push(item);
                    if ($clickid === $dataid) $index = items.length-1;
                }
            });
            return items;
        };

        if (lightboxopen === false) {
            var items       = getItems();
            if ($(window).width()<768) {
                var instance    = $.fancybox.open(items, {
                    loop : true,
                    thumbs : {
                        autoStart : false
                    },
                    buttons: gallery_lightbox_buttons,
                    beforeShow: function( instance, slide ) {
                        lightboxopen = true;
                    },
                    afterClose: function( instance, slide ) {
                        lightboxopen = false;
                    }
                }, $index);
            } else {
                var instance    = $.fancybox.open(items, {
                    loop : true,
                    thumbs : {
                        autoStart : true
                    },
                    buttons: gallery_lightbox_buttons,
                    beforeShow: function( instance, slide ) {
                        lightboxopen = true;
                    },
                    afterClose: function( instance, slide ) {
                        lightboxopen = false;
                    }
                }, $index);
            }
        }
    });
});