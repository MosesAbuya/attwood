<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    Sonny

# copyright Copyright (C) 2017 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.tzportfolio.com

# Technical Support:  Forum - http://tzportfolio.com/forum.html

-------------------------------------------------------------------------*/

defined('_JEXEC') or die();

use Joomla\Utilities\ArrayHelper;

if($this -> items):
    $doc    = JFactory::getDocument();
	$tplParams      =   TZ_Portfolio_PlusTemplate::getTemplate(true)->params;
	$use_project_link   =   $tplParams->get('project_link',0);
?>
    <?php foreach($this -> items as $i => $item):
        $this -> item   = $item;
        $params         = $item -> params;

        if($params -> get('tz_column_width',360))
            $tzItemClass    = ' tz_item';
        else
            $tzItemClass    = null;

        if($item -> featured == 1)
            $tzItemFeatureClass    = ' tz_feature_item';
        else
            $tzItemFeatureClass    = null;

        $class  = '';
        if($params -> get('tz_filter_type','tags') == 'tags'){
            if($item -> tags && count($item -> tags)){
                $alias  = ArrayHelper::getColumn($item -> tags, 'alias');
                $class  = implode(' ', $alias);
            }
        }
        elseif($params -> get('tz_filter_type','tags') == 'categories'){
            $class  = $item -> cat_alias;
            if(isset($item -> second_categories) && $item -> second_categories &&  count($item -> second_categories)) {
                foreach($item -> second_categories as $category){
                    $class  .= ' '.$category -> alias.'_'.$category -> id;
                }
            }
        }
        elseif($params -> get('tz_filter_type','tags') == 'letters'){
            $class  = mb_strtolower(mb_substr(trim($item -> title),0,1));
        }

        if ($use_project_link) {
            $project_link   =   $params -> get('project_link','');
            $item->link     =   $project_link ? $project_link : $item->link;
        }
    ?>
<div id="tzelement<?php echo $item -> id;?>"
     data-date="<?php echo strtotime($item -> created); ?>"
     data-title="<?php echo $this->escape($item -> title); ?>"
     data-hits="<?php echo (int) $item -> hits; ?>"
     data-portfolio-item-id="<?php echo $item -> id; ?>"
     class="element <?php echo $class.$tzItemClass.$tzItemFeatureClass;?>"
     itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">

    <div class="tp-item-box-container">
        <div class="tp-thumb">
            <?php
            if(!isset($item -> mediatypes) || (isset($item -> mediatypes) && !in_array($item -> type,$item -> mediatypes))):
                // Start Description and some info
                ?>
                <div class="tpPortfolioDescription">

                    <div class="tpContent">
	                    <?php if($params -> get('show_cat_title',1)): ?>
                            <small><?php echo JText::_('TP_STYLE_MAYA_VIEWMORE'); ?>:</small>
                            <h3 class="TzPortfolioTitle name" itemprop="name">
			                    <?php if($params->get('cat_link_titles',1)) : ?>
                                    <a href="<?php echo $item ->link; ?>"  itemprop="url">
					                    <?php echo $this->escape($item -> title); ?>
                                    </a>
			                    <?php else : ?>
				                    <?php echo $this->escape($item -> title); ?>
			                    <?php endif; ?>
                            </h3>
	                    <?php endif;?>

	                    <?php
	                    //-- Start display some information --//
	                    if ($params->get('show_cat_category',0)
		                    or $params->get('show_cat_hits',0) or $params->get('show_cat_tags',0)
		                    or !empty($item -> event -> beforeDisplayAdditionInfo)
		                    or !empty($item -> event -> afterDisplayAdditionInfo)) :
		                    ?>
                            <div class="tpMeta">
			                    <?php echo $item -> event -> beforeDisplayAdditionInfo;?>
			                    <?php if ($params->get('show_cat_category',0)) : ?>
                                    <div class="tpCategories">
                                        <i class="tp tp-folder-open"></i>
					                    <?php $title = $this->escape($item->category_title);
					                    $url = '<a href="' . $item -> category_link
						                    . '" itemprop="genre">' . $title . '</a>';
					                    $lang_text  = 'COM_TZ_PORTFOLIO_PLUS_CATEGORY';
					                    ?>

					                    <?php if(isset($item -> second_categories) && $item -> second_categories
						                    && count($item -> second_categories)){
						                    $lang_text  = 'COM_TZ_PORTFOLIO_PLUS_CATEGORIES';
						                    foreach($item -> second_categories as $j => $scategory){
							                    if($j <= count($item -> second_categories)) {
								                    $title  .= ', ';
								                    $url    .= ', ';
							                    }
							                    $url    .= '<a href="' . $scategory -> link
								                    . '" itemprop="genre">' . $scategory -> title . '</a>';
							                    $title  .= $this->escape($scategory -> title);
						                    }
					                    }?>

					                    <?php if ($params->get('cat_link_category',1)) : ?>
						                    <?php echo $url; ?>
					                    <?php else : ?>
						                    <?php echo '<span itemprop="genre">' . $title . '</span>'; ?>
					                    <?php endif; ?>
                                    </div>
			                    <?php endif; ?>
			                    <?php
			                    if ($params->get('show_cat_tags', 0)) :
				                    echo $this -> loadTemplate('tags');
			                    endif;
			                    ?>
			                    <?php if ($params->get('show_cat_hits', 0)) : ?>
                                    <div class="TzPortfolioHits">
                                        <i class="tp tp-eye"></i>
					                    <?php echo $item->hits; ?>
                                        <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $item->hits; ?>" />
                                    </div>
			                    <?php endif; ?>

			                    <?php echo $item -> event -> afterDisplayAdditionInfo; ?>

                            </div>
		                    <?php
	                    endif;
	                    //-- End display some information --//
	                    ?>
                    </div>
                    <a class="mayaLink" href="#" data-id="lightbox<?php echo $item -> id; ?>" data-thumb="">
                        <div class="item-lightbox"><i class="fas fa-search"></i></div>
                    </a>
                </div>
            <?php
                // End Description and some info
            endif;?>
            <?php
            // Display media from plugin of group tz_portfolio_plus_mediatype
            echo $this -> loadTemplate('media');
            ?>
        </div>
    </div>
</div>
    <?php endforeach;?>
<?php endif;?>
