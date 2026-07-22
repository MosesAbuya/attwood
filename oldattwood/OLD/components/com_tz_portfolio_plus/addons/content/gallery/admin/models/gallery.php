<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2020 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access
defined('_JEXEC') or die;

use Joomla\Filesystem\File;
use Joomla\Registry\Registry;
use TZ_Portfolio_Plus\Image\TppImageWaterMark;

jimport('joomla.filesytem.file');
JLoader::register('TZ_Portfolio_PlusFrontHelper', JPATH_SITE
    .'/components/com_tz_portfolio_plus/helpers/tz_portfolio_plus.php');

$component_path = JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components';
// Import addon_data model
JLoader::import('com_tz_portfolio_plus.models.addon_data',$component_path);

class TZ_Portfolio_Plus_Addon_GalleryModelGallery extends TZ_Portfolio_PlusModelAddon_Data{

    protected $addon_element    = 'gallery';

    protected function prepareTable($table){
        parent::prepareTable($table);

        $table -> element   = $this -> addon_element;

        if(!empty($table -> extension_id) && !empty($table -> content_id)){
            // Get addon data id
            if($newtable = $this -> getTable()){
                $newtable -> load(array('content_id' => $table -> content_id, 'extension_id' => $table -> extension_id));
                $table -> set('id', $newtable -> get('id'));
            }
        }
    }

    protected function loadFormData()
    {
        $data   = null;
        $_data  = parent::loadFormData();
        if(!empty($_data)){
            $data   = new stdClass();
            $data -> addon  = new stdClass();
            $data -> addon -> {$this -> addon_element}  = $_data -> value;
        }
        return $data;
    }

    public function save($data)
    {
        $gallery        =   $data['value']['gallery_content'];
        $app            =   JFactory::getApplication();
        $input          =   $app -> input;

        // Get params
        $params         =   $this -> getState('params');
        $tmp_folder     =   $gallery['gallery_folder'];
        unset($data['value']['gallery_content']['gallery_folder']);
        $grid_images    =   isset($gallery['gallery_image'])?$gallery['gallery_image']:array();
        $grid_source    =   isset($gallery['gallery_source'])?$gallery['gallery_source']:array();
        unset($data['value']['gallery_content']['gallery_source']);
        $grid_title     =   isset($gallery['gallery_image_title'])?$gallery['gallery_image_title']:array();
        $config         =   JFactory::getConfig();
        $tmp_part       =   $config->get('tmp_path') . '/' .$tmp_folder ;

        $tmp_dest       =   JPATH_ROOT.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'tz_portfolio_plus'.DIRECTORY_SEPARATOR.'gallery';
        $arr_server     =   array();
        $arr_client     =   array();

        if(count($grid_source)){
            for ($i = 0; $i<count($grid_source); $i++) {
                $grid_data              =   new stdClass();
                $grid_data -> image     =   $grid_images[$i];
                $grid_data -> title     =   $grid_title[$i];
                switch ($grid_source[$i]) {
                    case 'server':
                        $arr_server[]   =   $grid_data;
                        break;
                    case 'client':
                        $arr_client[]   =   $grid_data;
                        break;
                }
            }
        }

        if ($params && $image_size = $params->get('gallery_size')) {
            if($image_size && !is_array($image_size) && preg_match_all('/(\{.*?\})/',$image_size,$match)) {
                $image_size = $match[1];
            }
        }

        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.folder');
        if (count($arr_client) && !JFolder::exists($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'])) {
            JFolder::create($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id']);
        }
        if($input -> getCmd('task') == 'save2copy' && $input -> getInt('id')){
            if (JFolder::exists($tmp_dest.DIRECTORY_SEPARATOR. $input -> getInt('id'))) {
                JFolder::copy($input -> getInt('id'), $data['content_id'], $tmp_dest, true);
            }
        }

        // Delete all unnecessary image
        if (JFolder::exists($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'])) {
            $img_server     =   JFolder::files($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'], '.', false, false);
            if (count($img_server)) {
                foreach ($img_server as $img) {
                    $img_flag   =   false;
                    for($i = 0; $i<count($arr_server); $i++) {
                        if ($arr_server[$i] -> image == $img) {
                            $img_flag   =   true;
                            break;
                        }
                    }
                    if (!$img_flag) {
                        JFile::delete($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.$img);

                        //Delete resize file
                        if (isset($image_size) && count($image_size)) {
                            foreach ($image_size as $_size) {
                                $size = json_decode($_size);

                                $resizePath = $tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.'resize' . DIRECTORY_SEPARATOR
                                    . JFile::stripExt($img)
                                    . '_' . $size->image_name_prefix . '.' . JFile::getExt($img);
                                if (JFile::exists($resizePath)) {
                                    JFile::delete($resizePath);
                                }
                            }
                        }
                    }
                }
            }
        }

        // Move upload image from tmp to images folder
        for ($i = 0; $i<count($arr_client); $i++) {
            if (JFile::exists($tmp_part. '/' . $arr_client[$i] -> image)) {
                JFile::move($tmp_part. '/' . $arr_client[$i] -> image, $tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.basename($arr_client[$i] -> image));
            }

            if (!JFolder::exists($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.'resize')) {
                JFolder::create($tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.'resize');
            }

            if (isset($image_size) && count($image_size)) {
                foreach ($image_size as $_size) {
                    $size = json_decode($_size);
                    $tmpresizePath = $tmp_part.DIRECTORY_SEPARATOR.'resize' . DIRECTORY_SEPARATOR
                        . JFile::stripExt($arr_client[$i] -> image)
                        . '_' . $size->image_name_prefix . '.' . JFile::getExt($arr_client[$i] -> image);
                    $resizePath = $tmp_dest.DIRECTORY_SEPARATOR.$data['content_id'].DIRECTORY_SEPARATOR.'resize' . DIRECTORY_SEPARATOR
                        . JFile::stripExt($arr_client[$i] -> image)
                        . '_' . $size->image_name_prefix . '.' . JFile::getExt($arr_client[$i] -> image);
                    if (JFile::exists($tmpresizePath)) {
                        JFile::move($tmpresizePath, $resizePath);
                    }
                }
            }
        }
        if (JFolder::exists($tmp_part)) {
            JFolder::delete($tmp_part);
        }
        return parent::save($data);
    }
}