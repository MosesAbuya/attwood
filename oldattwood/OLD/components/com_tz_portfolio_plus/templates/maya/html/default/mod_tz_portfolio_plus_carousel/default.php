<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Carousel Module

# ------------------------------------------------------------------------

# Author:    DuongTVTemPlaza

# Copyright: Copyright (C) 2011-2018 tzportfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - http://tzportfolio.com/forum

# Family website: http://www.templaza.com

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;
$tzTemplate = TZ_Portfolio_PlusTemplate::getTemplateById($params -> get('template_id'));
$tplParams = $tzTemplate->params;
$use_project_link   =   $tplParams->get('project_link',0);
$doc = JFactory::getDocument();
$doc -> addStyleSheet(JUri::root(true).'/components/com_tz_portfolio_plus/css/jquery.fancybox.min.css');
$doc -> addScript(JUri::root(true).'/components/com_tz_portfolio_plus/js/jquery.fancybox.min.js');
$doc -> addScript(JUri::base(true).'/components/com_tz_portfolio_plus/templates/maya/js/lightbox.js');
$doc->addScriptDeclaration('
(function($){
            "use strict";
            $(document).ready(function(){ 
                maya_lightbox();
            });
            
        })(jQuery);
');
$paddingCustom  =   $tplParams->get('padding','');
if ($paddingCustom) {
    $doc -> addStyleDeclaration('.tplMaya .tp-item-box-container {padding: '.$paddingCustom.';}.tplMaya#module__' . $module->id . ' {margin-left: -'.$paddingCustom.';margin-right: -'.$paddingCustom.';}');
}
$grayscale  =   $tplParams->get('grayscale',100);
if ($grayscale) {
    $doc -> addStyleDeclaration('.tplMaya .tpArticleMedia img {-webkit-filter: grayscale('.$grayscale.'%);-moz-filter: grayscale('.$grayscale.'%);-o-filter: grayscale('.$grayscale.'%);filter: grayscale('.$grayscale.'%);}');
}
if($list){
?>
<div id="module__<?php echo $module -> id;?>" class="tplMaya tpp-module-carousel tpp-module__carousel<?php echo $moduleclass_sfx;?>">
    <div class="owl-carousel owl-theme">
        <?php foreach($list as $i => $item){
	        if ($use_project_link) {
		        $itemparams         =   new JRegistry();
		        $itemparams         =   $itemparams->loadString($item -> attribs);
		        $project_link       =   $itemparams -> get('project_link','');
		        $item->link         =   $project_link ? $project_link : $item->link;
	        }
            ?>
            <div class="tp-item-box-container">
                <div class="tp-thumb">
			        <?php
			        if(!isset($item -> mediatypes) || (isset($item -> mediatypes) && !in_array($item -> type,$item -> mediatypes))):
				        // Start Description and some info
				        ?>
                        <div class="tpPortfolioDescription">
                            <div class="tpContent">
	                            <?php if($item -> params -> get('show_title',1)): ?>
                                    <h3 class="TzPortfolioTitle name" itemprop="name">
			                            <?php if($item -> params->get('cat_link_titles',1)) : ?>
                                            <a href="<?php echo $item ->link; ?>"  itemprop="url">
					                            <?php echo $item -> title; ?>
                                            </a>
			                            <?php else : ?>
				                            <?php echo $item -> title; ?>
			                            <?php endif; ?>
                                    </h3>
	                            <?php endif;?>

	                            <?php
	                            //-- Start display some information --//
	                            if ($item -> params->get('show_author',0) or $item -> params->get('show_category',0)
		                            or $item -> params->get('show_created_date',0)
		                            or $item -> params->get('show_hit',0) or $item -> params->get('show_tag',0)
		                            or !empty($item -> event -> beforeDisplayAdditionInfo)
		                            or !empty($item -> event -> afterDisplayAdditionInfo)) :
		                            ?>
                                    <div class="tpMeta">
			                            <?php if (isset($item->event->beforeDisplayAdditionInfo)) {
				                            echo $item->event->beforeDisplayAdditionInfo;
			                            }?>
			                            <?php if ($item -> params->get('show_category',0)) : ?>
                                            <div class="tpCategories">
					                            <?php
					                            if (isset($categories[$item->content_id]) && $categories[$item->content_id]) {
						                            if (count($categories[$item->content_id]))
							                            echo '<i class="tp tp-folder-open"></i>';
						                            foreach ($categories[$item->content_id] as $c => $category) {
							                            echo '<a itemprop="genre" href="' . $category->link . '">' . $category->title . '</a>';
							                            if ($c != count($categories[$item->content_id]) - 1) {
								                            echo ', ';
							                            }
						                            }
					                            }
					                            ?>
                                            </div>
			                            <?php endif; ?>
			                            <?php
			                            if ($item -> params->get('show_tag', 0)) :
				                            if (isset($tags[$item->content_id])) {
					                            echo '<div class="tz_tag"><i class="tps tp-tag" aria-hidden="true"></i> ';
					                            foreach ($tags[$item->content_id] as $t => $tag) {
						                            echo '<a href="' . $tag->link . '">' . $tag->title . '</a>';
						                            if ($t != count($tags[$item->content_id]) - 1) {
							                            echo ', ';
						                            }
					                            }
					                            echo '</div>';
				                            }
			                            endif;
			                            ?>
			                            <?php
			                            if ($item -> params->get('show_hit', 1)) {
				                            ?>
                                            <div class="TzPortfolioHits">
                                                <i class="tp tp-eye"></i>
					                            <?php echo $item->hits; ?>
                                                <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $item->hits; ?>" />
                                            </div>
				                            <?php
			                            } ?>

			                            <?php if(isset($item -> event -> afterDisplayAdditionInfo)){
				                            echo $item -> event -> afterDisplayAdditionInfo;
			                            } ?>

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
			        if(isset($item->event->onContentDisplayMediaType)){
				        ?>
                        <div class="tpArticleMedia">
					        <?php echo $item->event->onContentDisplayMediaType;?>
                        </div>
				        <?php
			        }
			        ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if($params -> get('show_view_all', 0)){?>
        <div class="tpp-portfolio__action text-center">
            <a href="<?php echo $params -> get('view_all_link');?>"<?php echo ($target = $params -> get('view_all_target'))?' target="'
                .$target.'"':'';?> class="btn btn-primary btn-view-all"><?php
                echo $params -> get('view_all_text', 'View All Portfolios');?></a>
        </div>
    <?php } ?>
</div>
<?php
}