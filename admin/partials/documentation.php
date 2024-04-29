<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/**
 * @package     COM_BT_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (c) 2014 bookingtime GmbH. All Rights Reserved.
 * @license     MIT; see LICENSE.txt
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<div id="documentation" class="documentation border border-3 rounded-3 p-3 m-3">
   <h5 class="my-2 fw-bold"><?= Text::_('COM_APPOINTMENT_DOCUMENTATION_H5_1'); ?></h5>

   <div class="card mb-3">
      <div class="row g-0">
         <div class="col-4">
            <a data-lightbox="lightbox" data-title="<?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_1_CARD_TITLE'); ?> - <?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_1_CARD_TEXT'); ?>" href="<?php echo Uri::root(); ?>administrator/components/com_appointment/assets/img/documentation_01.jpg">
               <img class="image-embed-item d-block w-100" src="<?php echo Uri::root(); ?>administrator/components/com_appointment/assets/img/documentation_01.jpg" alt="" width="100%" height="auto">
            </a>
         </div>
         <div class="col-8">
            <div class="card-body">
               <h5 class="card-title"><?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_1_CARD_TITLE'); ?></h5>
               <p class="card-text"><?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_1_CARD_TEXT'); ?></p>
            </div>
         </div>
      </div>
   </div>
   <div class="card mb-3">
      <div class="row g-0">
         <div class="col-4">
            <a data-lightbox="lightbox" data-title="<?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_2_CARD_TITLE'); ?> - <?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_2_CARD_TEXT'); ?>" href="<?php echo Uri::root(); ?>administrator/components/com_appointment/assets/img/documentation_02.jpg">
               <img class="image-embed-item d-block w-100" src="<?php echo Uri::root(); ?>administrator/components/com_appointment/assets/img/documentation_02.jpg" alt="" width="100%" height="auto">
            </a>
         </div>
         <div class="col-8">
            <div class="card-body">
               <h5 class="card-title"><?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_2_CARD_TITLE'); ?></h5>
               <p class="card-text"><?= Text::_('COM_APPOINTMENT_DOCUMENTATION_ITEM_2_CARD_TEXT'); ?></p>
            </div>
         </div>
      </div>
   </div>
</div>
