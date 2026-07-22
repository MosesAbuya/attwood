<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# Author:    DuongTVTemPlaza

# Copyright: Copyright (C) 2011-2018 TZ Portfolio.com. All Rights Reserved.

# @License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Website: http://www.tzportfolio.com

# Technical Support:  Forum - https://www.tzportfolio.com/help/forum.html

# Family website: http://www.templaza.com

# Family Support: Forum - https://www.templaza.com/Forums.html

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$item       = $this -> get('Item');
$params     = $this -> params;
if($params -> get('show_about_author', 1) && ($author = $this -> authorAbout)){
    $this -> document -> addStyleSheet(TZ_Portfolio_PlusUri::base(true).'/addons/user/profile/css/style.css',
        array('version' => 'auto', 'relative' => true));

    $avaName    =   '';
    $arrName    =   explode(' ',$author -> name);

    for ($i=0; $i<count($arrName); $i++){
        if ($word = trim($arrName[$i])) {
            $avaName.=$word[0];
        }
    }

    $tmpl           = JFactory::getApplication() -> input -> getString('tmpl');
    $target = '';
    if(isset($tmpl) AND !empty($tmpl)):
        $target = ' target="_blank"';
    endif;
    ?>
    <div class="tpArticleAuthor">
        <h3 class="tpArticleAuthorTitle reset-heading"><?php echo JText::_('ARTICLE_AUTHOR_TITLE'); ?></h3>
        <div class="media">
            <div class="AuthorAvatar pull-left<?php echo (!$author -> avatar)?' tp-avatar-default tpavatar--bg-'.rand(1,5):'';?>">
                <?php if($author -> avatar){?>
                    <img src="<?php echo JUri::root().$author -> avatar;?>" alt="<?php echo $item -> author;?>"/>
                <?php }else{?>
                    <span class="tpSymbol"><?php echo $avaName; ?></span>
                <?php }?>
            </div>
            <div class="tpAuthorContainer">

                <div class="cell-col">
                    <h4 class="media-heading reset-heading" itemprop="name">
                        <a href="<?php echo $item -> author_link;?>" rel="author"<?php echo $target;?>>
                            <?php echo $author -> name;?>
                        </a>
                    </h4>
                    <div class="general_info">
                        <?php if($params -> get('show_gender_user', 1)):?>
                            <?php if($author -> gender):?>
                                <span class="muted tpAuthorInfo AuthorGender">
                                    <i class="tps tp-venus-mars"></i>
                                    <span><?php echo ($author -> gender == 'm')?JText::_('COM_TZ_PORTFOLIO_PLUS_MALE'):JText::_('COM_TZ_PORTFOLIO_PLUS_FEMALE');?></span>
                                </span>
                            <?php endif;?>
                        <?php endif;?>

                        <?php if($params -> get('show_email_user', 1)):?>
                            <?php if($author -> email):?>
                                <span class="muted tpAuthorInfo AuthorEmail">
                                    <i class="tpr tp-envelope"></i>
                                    <span><?php echo $author -> email;?></span>
                                </span>
                            <?php endif;?>
                        <?php endif;?>

                        <?php if($params -> get('show_url_user',1) AND !empty($author -> url)):?>
                            <span class="muted tpAuthorInfo AuthorUrl">
                                <i class="tps tp-globe"></i>
                                <a href="<?php echo $author -> url;?>" target="_blank">
                                    <?php echo $author -> url;?>
                                </a>
                            </span>
                        <?php endif;?>
                    </div>
                    <?php if ($author -> twitter || $author -> facebook || $author -> googleplus || $author -> instagram) : ?>
                        <div class="social_link">
                            <?php if($author -> twitter):?>
                                <span class="muted tpAuthorInfo SocialLink">
                                    <a href="<?php echo $author -> twitter; ?>" title="Twitter"><i class="tpb tp-twitter"></i></a>
                                </span>
                            <?php endif;?>
                            <?php if($author -> facebook):?>
                                <span class="muted tpAuthorInfo SocialLink">
                                    <a href="<?php echo $author -> facebook; ?>" title="Facebook"><i class="tpb tp-facebook-f"></i></a>
                                </span>
                            <?php endif;?>
                            <?php if($author -> googleplus):?>
                                <span class="muted tpAuthorInfo SocialLink">
                                    <a href="<?php echo $author -> googleplus; ?>" title="Google Plus"><i class="tpb tp-google-plus-g"></i></a>
                                </span>
                            <?php endif;?>
                            <?php if($author -> instagram):?>
                                <span class="muted tpAuthorInfo SocialLink">
                                    <a href="<?php echo $author -> instagram; ?>" title="Instagram"><i class="tpb tp-instagram"></i></a>
                                </span>
                            <?php endif;?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <?php if($params -> get('show_description_user', 1)  AND !empty($author -> description)):?>
                <div class="AuthorDescription">
                    <?php echo $author -> description; ?>
                </div>
            <?php endif;?>
        </div>

    </div>

    <?php
}