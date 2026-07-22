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
<div class="tz_audio" itemprop="audio" itemscope itemtype="http://schema.org/AudioObject">
    <a href="<?php echo $this -> item -> link; ?>">
        <img src="<?php echo $audio -> thumbnail; ?>"
             title="<?php echo ($audio -> caption) ? ($audio -> caption) : ($this->item->title); ?>"
             alt="<?php echo ($audio -> caption) ? ($audio -> caption) : ($this->item->title); ?>"
             data-origin="<?php echo $audio -> url;?>"
             data-type="iframe"
             itemprop="thumbnailUrl"/>
    </a>
</div>
