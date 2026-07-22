<?php
/**
 * @package Module EB Whatsapp Chat for Joomla!
 * @version 2.0: mod_ebwhatsappchat.php Feb 2024
 * @author url: https://www/extnbakers.com
 * @copyright Copyright (C) 2021 extnbakers.com. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html 
**/

   // No direct access
   defined('_JEXEC') or die;

   if (!defined('DS')) {
      define('DS', DIRECTORY_SEPARATOR);
   }

   $document = JFactory::getDocument();
   // Include the syndicate functions only once
   require_once dirname(__FILE__) . '/core/helper.php';

   $whatsapp = ModEbWhatsappChatHelper::getWhatsapp($params);
   $layout = 'default';
   require JModuleHelper::getLayoutPath($module->module, $layout);
?>