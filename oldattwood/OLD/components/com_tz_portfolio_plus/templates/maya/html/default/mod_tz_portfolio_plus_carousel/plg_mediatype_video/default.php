<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access.
defined('_JEXEC') or die;

?>
<div class="tz_portfolio_plus_video">
    <a href="<?php echo $item -> link;?>">
        <img src="<?php echo $video -> thumbnail;?>"
             alt="<?php echo $item -> title;?>"
             title="<?php echo $item -> title;?>"
             data-origin="<?php echo $video->url; ?>"
             itemprop="thumbnailUrl"/>
    </a>
</div>
