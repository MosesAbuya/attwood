<?php
/**
 * @package   Astroid Framework
 * @author    TemPlaza https://www.templaza.com
 * @copyright Copyright (C) 2023 TemPlaza.
 * @license   GNU/GPLv2 and later
 */
// no direct access
defined('_JEXEC') or die;

class tz_interiartInstallerScript {

	/**
	 *
	 * Function to run before installing the component
	 */
	public function preflight($type, $parent) {

	}

	/**
	 *
	 * Function to run when installing the component
	 * @return void
	 */
	public function install($parent) {
		$this->removeUnnecessary();
	}

	/**
	 *
	 * Function to run when un-installing the component
	 * @return void
	 */
	public function uninstall($parent) {

	}

	/**
	 *
	 * Function to run when updating the component
	 * @return void
	 */
	function update($parent) {
		$this->removeUnnecessary();
	}

	/**
	 *
	 * Function to update database schema
	 */
	public function updateDatabaseSchema($update) {

	}

	public function removeUnnecessary() {
		$removefile  =   array(
			'astroid/options/article.xml',
			'astroid/options/basic.xml',
			'astroid/options/custom.xml',
			'astroid/options/footer.xml',
			'astroid/options/header.xml',
			'astroid/options/layout.xml',
			'astroid/options/social.xml',
			'astroid/options/theming.xml',
			'astroid/options/typography.xml',
			'astroid/options/colors.xml',
			'astroid/options/dashboard.xml',
			'astroid/options/extensions.xml',
			'html/frontend/footer.php',
			'html/com_easydiscuss/post/default.php',
			'html/com_easydiscuss/post/default.reply.item.php',
			'html/com_easydiscuss/posts/item.php',
		);
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/clients')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/clients');
        }
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/feature_section')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/feature_section');
        }
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/social_follow')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/social_follow');
        }
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/testimonialcarousel')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/testimonialcarousel');
        }
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/tinyslider')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/tinyslider');
        }
        if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/video_button')) {
            JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/sppagebuilder/addons/video_button');
        }
		if (JFolder::exists(JPATH_ROOT.'/templates/tz_interiart/frontend')) {
		    JFolder::delete(JPATH_ROOT.'/templates/tz_interiart/frontend');
        }
		foreach ($removefile as $file) {
			if (JFile::exists(JPATH_ROOT.'/templates/tz_interiart/'.$file)) {
				JFile::delete(JPATH_ROOT.'/templates/tz_interiart/'.$file);
			}
		}
	}

	/**
	 *
	 * Function to run after installing the component
	 */
	public function postflight($type, $parent) {

	}

}