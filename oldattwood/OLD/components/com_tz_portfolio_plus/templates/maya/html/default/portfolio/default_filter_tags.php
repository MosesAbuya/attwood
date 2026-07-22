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
 defined('_JEXEC') or die();

$tpstyleParams  = TZ_Portfolio_PlusTemplate::getTemplate(true) -> params;
$dropdownStyle  = $tpstyleParams -> get('filter_style') == 'dropdown';
?>
<?php if($this -> itemTags):?>
    <?php foreach($this -> itemTags as $item):?>
        <a href="#<?php echo $item -> alias; ?>"
           class="<?php echo $dropdownStyle?'dropdown-item':'tpFilterItem';?>"
           data-option-value=".<?php echo $item -> alias; ?>">
            <?php echo $item -> title;?>
        </a>
    <?php endforeach;?>
<?php endif;?>