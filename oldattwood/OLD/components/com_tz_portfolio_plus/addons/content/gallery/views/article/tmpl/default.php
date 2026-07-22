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

$params = $this->params;
if ($params->get('mt_gallery_show',1)) {
    if (isset($this->gallery) && $gallery = $this->gallery) {
        if (isset($gallery->gallery_content->gallery_image) && count($gallery->gallery_content->gallery_image)) {
            $item   =   $this->item;
            $gallerytype    =   $params->get('mt_gallery_type','masonry');
            $titleposition  =   $params->get('mt_grid_image_title_position','under_image');
            //Title
            $title = (isset($gallery->title) && $gallery->title) ? $gallery->title : '';
            $heading_selector = (isset($gallery->title_element) && $gallery->title_element) ? $gallery->title_element : 'h3';

            //Custom Class
            $custom_class = (isset($gallery->custom_class) && trim($gallery->custom_class)) ? $gallery->custom_class : '';

            echo '<div id="tz-portfolio-plus-gallery" class="'.$custom_class.'">';
            if($title) {
                echo '<'.$heading_selector.' class="tz-addon-title tz-gallery-title">';
                echo $title;
                echo '</'.$heading_selector.'>';
            }
            echo '<div class="tz_portfolio_plus_gallery '.$gallerytype.'-container">';
            for ($i = 0; $i<count($gallery->gallery_content->gallery_image); $i++) {
                $image      =   $gallery->gallery_content->gallery_image[$i];
                jimport('joomla.filesystem.file');
                $image_size =   $params->get('mt_gallery_size','o');
                if ($image_size != 'o') {
                    $thumb  =   'images/tz_portfolio_plus/gallery/'.$item->id.'/resize/'
                        . JFile::stripExt($image)
                        . '_' . $image_size . '.' . JFile::getExt($image);
                } else {
                    $thumb  =   'images/tz_portfolio_plus/gallery/'.$item -> id.'/'.$image;
                }

                ?>
                <div class="gallery-listing element" data-date data-hits data-title>
                    <div class="gallery-inner">
                        <div class="gallery-image">
                            <a class="gallery-title" data-thumb="<?php echo JUri::root().$thumb; ?>" data-id="grid<?php echo $i; ?>" href="<?php echo 'images/tz_portfolio_plus/gallery/'.$item -> id.'/'.$image; ?>">
                                <?php if (isset($gallery->gallery_content->gallery_image_title) && $gallery->gallery_content->gallery_image_title[$i] && $titleposition == 'on_overlay') : ?>
                                    <h5 class="image-caption on_overlay"><?php echo $gallery->gallery_content->gallery_image_title[$i]; ?></h5>
                                <?php endif; ?>
                                <i class="tps tp-search"></i>
                            </a>
                            <img src="<?php echo $thumb; ?>" />
                        </div>
                        <?php if (isset($gallery->gallery_content->gallery_image_title) && $gallery->gallery_content->gallery_image_title[$i] && $titleposition == 'under_image') : ?>
                            <h5 class="image-caption under_image"><?php echo $gallery->gallery_content->gallery_image_title[$i]; ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            echo '</div>';
        }
    }
}
