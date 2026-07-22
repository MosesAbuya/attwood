<?php
/*------------------------------------------------------------------------

# Gallery Addon

# ------------------------------------------------------------------------

# author    Sonny

# copyright Copyright (C) 2021 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.tzportfolio.com

# Technical Support:  Forum - https://www.tzportfolio.com/help/forum.html

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

class PlgTZ_Portfolio_PlusContentGalleryViewArticle extends JViewLegacy{

    protected $item             = null;
    protected $params           = null;
    protected $gallery          = null;
    protected $head             = false;

    public function display($tpl = null){
        $this -> item   = $this -> get('Item');
        $this -> items   = $this -> get('GalleryItems');
        $state          = $this -> get('State');
        $params         = $state -> get('params');
        $this -> params = $params;

        if(isset($this -> items) && $this -> items) {
            foreach ($this->items as $_item) {
                $this->gallery  =   $_item -> value;
                $this->styleInit($_item -> value);
                if(!$this -> head && isset($this->gallery->gallery_content)) {
                    $doc = JFactory::getDocument();
                    $doc -> addStyleSheet('components/com_tz_portfolio_plus/css/all.min.css');
                    $doc -> addStyleSheet('components/com_tz_portfolio_plus/css/jquery.fancybox.min.css');
                    $doc -> addScript('components/com_tz_portfolio_plus/js/jquery.fancybox.min.js');
                    $doc -> addScript(TZ_Portfolio_PlusUri::base(true) . '/addons/content/gallery/js/lightbox.min.js');
                    $doc -> addStyleSheet(TZ_Portfolio_PlusUri::base(true) . '/addons/content/gallery/css/style.css');

                    $width          =   $params->get('mt_gallery_width','400');
                    $height         =   $params->get('mt_gallery_height','250');
                    $gallerytype    =   $params->get('mt_gallery_type','masonry');
                    if ($gallerytype == 'grid') {
                        $doc -> addStyleDeclaration('.tz_portfolio_plus_gallery.grid-container{grid-template-columns: repeat(auto-fill, minmax('.$width.'px, 1fr));}.tz_portfolio_plus_gallery.grid-container .gallery-listing{height:'.$height.'px;}');
                    } elseif ($gallerytype == 'masonry') {
                        $doc->addScript('components/com_tz_portfolio_plus/js/tz_portfolio_plus.min.js');
                        $doc->addScript('components/com_tz_portfolio_plus/js/jquery.isotope.min.js');
                        $doc->addStyleSheet('components/com_tz_portfolio_plus/css/isotope.min.css');
                        $doc->addStyleSheet('components/com_tz_portfolio_plus/css/tzportfolioplus.min.css');
                        $doc->addScriptDeclaration('
							jQuery(function($){
							    $(document).ready(function(){
							        $(".tz_portfolio_plus_gallery.masonry-container").tzPortfolioPlusIsotope({
							            "containerElementSelector"  : ".tz_portfolio_plus_gallery.masonry-container",
							            "params"                    : {
							                "tz_column_width"       : "' . $width . '"
							            },
							            
										"isotope_options"                   : {
										            "core"  : {
										                sortBy : "original-order"
										            }
										}
							        });
							    });
							});
							');
                    } elseif ($gallerytype == 'horizontal_masonry') {
                        $style  =   '.tz_portfolio_plus_gallery.horizontal_masonry-container .gallery-listing{height:'.$height.'px;}';
                        for ($i = 0; $i<count($this->gallery->gallery_content->gallery_image); $i++) {
                            $style      .=   '.tz_portfolio_plus_gallery.horizontal_masonry-container .gallery-listing:nth-child('.($i+1).') {width: '.(rand(150,500)).'px;}';
                        }
                        $doc -> addStyleDeclaration($style);
                    }

                    $lightboxopt    =   $params->get('gallery_lightbox_option',['zoom', 'slideShow', 'fullScreen', 'thumbs', 'close']);
                    if (is_array($lightboxopt)) {
                        for ($i = 0 ; $i< count($lightboxopt); $i++) {
                            $lightboxopt[$i]  =   '"'.$lightboxopt[$i].'"';
                        }
                    }

                    $lightboxopt=   is_array($lightboxopt) ? implode(',', $lightboxopt) : '';

                    $doc -> addScriptDeclaration('var gallery_lightbox_buttons = ['.$lightboxopt.'];');
                    $this -> head   =   true;
                }
            }
        }
        parent::display($tpl);
    }

    protected function styleInit($item) {
        $addon_id = '#tz-portfolio-plus-gallery';
        $title_margin_top = (isset($item->title_margin_top) && $item->title_margin_top) ? $item->title_margin_top : '';
        $title_margin_bottom	= (isset($item->title_margin_bottom) && $item->title_margin_bottom) ? $item->title_margin_bottom : '';
        $title_color	= (isset($item->title_color) && $item->title_color) ? $item->title_color : '';
        //Css start
        $css = '';

        $title_style    =   '';
        if (isset($item->title_font) && $item->title_font) {
            $title_style     .=      TZ_Portfolio_PlusContentHelper::font_style($item->title_font);
        }
        if ($title_margin_top) {
            $title_style    .=  'margin-top:'.$title_margin_top.'px;';
        }
        if ($title_margin_bottom) {
            $title_style    .=  'margin-bottom:'.$title_margin_bottom.'px;';
        }
        if ($title_color) {
            $title_style    .=  'color:'.$title_color.';';
        }

        if($title_style) {
            $css .= $addon_id . ' .tz-gallery-title {';
            $css .= $title_style;
            $css .= '}';
        }

        if(isset($item->title_color_hover) && $item->title_color_hover) {
            $css .= $addon_id . ' .tz-gallery-title{';
            $css .= 'transition:.3s;';
            $css .='}';
            $css .= $addon_id . ':hover .tz-gallery-title {';
            $css .= 'color:'.$item->title_color_hover.';';
            $css .='}';
        };
        $doc = JFactory::getDocument();
        $doc->addStyleDeclaration($css);
    }

}