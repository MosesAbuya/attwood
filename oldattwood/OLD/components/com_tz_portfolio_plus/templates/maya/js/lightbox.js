var lightboxopen    =   false;
var maya_lightbox  =   function () {
    if(jQuery('.tplMaya').length > 0) {
        jQuery('.tplMaya .mayaLink').on('click', function(event) {
            event.preventDefault();
            var image       = [];
            var $pic        = jQuery('.tplMaya');
            var $clickid    = jQuery(this).attr('data-id');
            var $index      = 0;
            var getItems = function() {
                var items = [],
                    $el = '';
                $el = $pic.find('.tp-item-box-container');
                $el.each(function() {
                    var img     =   jQuery(this).find('.tpArticleMedia img'),
                        thumb   =   img.attr('src'),
                        origin  =   thumb;
                    console.log(thumb);
                    if ((typeof img.attr('data-origin') !== 'undefined') && (img.attr('data-origin') !== '')) {
                        origin  =   img.attr('data-origin');
                    }
                    jQuery(this).find('a.mayaLink').each(function () {
                        var $dataid     =   jQuery(this).attr('data-id');
                        if (typeof $dataid !== 'undefined' && $dataid !== null) {
                            if (img.attr('data-type') === 'iframe') {
                                var item = {
                                    src     : origin,
                                    type    : 'iframe',
                                    opts    : {
                                        thumb   : thumb
                                    }
                                };
                            } else {
                                var item = {
                                    src     : origin,
                                    opts    : {
                                        thumb   : thumb
                                    }
                                };
                            }
                            items.push(item);
                            if ($clickid === $dataid) $index = items.length-1;
                            return false;
                        }
                    });
                });

                return items;
            };

            if (lightboxopen === false) {
                var items       = getItems();
                if (jQuery(window).width()<768) {
                    var instance    = jQuery.fancybox.open(items, {
                        loop : true,
                        thumbs : {
                            autoStart : false
                        },
                        beforeShow: function( instance, slide ) {
                            lightboxopen = true;
                        },
                        afterClose: function( instance, slide ) {
                            lightboxopen = false;
                        },
                        afterShow: function (instance, slide) {
                            instance.update();
                        }
                    }, $index);
                } else {
                    var instance    = jQuery.fancybox.open(items, {
                        loop : true,
                        thumbs : {
                            autoStart : true
                        },
                        beforeShow: function( instance, slide ) {
                            lightboxopen = true;
                        },
                        afterClose: function( instance, slide ) {
                            lightboxopen = false;
                        },
                        afterShow: function (instance, slide) {
                            instance.update();
                        }
                    }, $index);
                }
            }
        });
    }
};