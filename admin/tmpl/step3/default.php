<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\FileLayout;

/**
 * @package     COM_BT_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (c) 2014 bookingtime GmbH. All Rights Reserved.
 * @license     MIT; see LICENSE.txt
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

$layout = new FileLayout('joomla.content.header');
echo $layout->render();
?>
<div id="step3" class="step">
   <div class="box1 border border-3 rounded-3 px-4 py-3 mt-5 mx-auto text-center">
      <i class="bi text-success bi-check-circle-fill"></i>
      <h3 class="text-center fw-bold mt-2 mb-2"><?= Text::_('COM_APPOINTMENT_STEP3_H3_1'); ?></h3>
   </div>
   <div class="box2 border border-3 rounded-3 px-4 py-2 mt-2 mx-auto">
      <h5 class="fw-bold my-3 d-flex align-items-center"><i class="me-3 bi fs-1 bi-calendar2-check text-primary"></i> <?= Text::_('COM_APPOINTMENT_STEP3_H5_1'); ?></h5>
      <p><?= Text::sprintf('COM_APPOINTMENT_STEP3_P_2',$this->email); ?></p>
      <p><?= Text::_('COM_APPOINTMENT_STEP3_P_3'); ?></p>
   </div>
   <div class="box3 border border-3 rounded-3 px-4 py-2 mt-0 mx-auto">
      <h5 class="fw-bold my-3 d-flex align-items-center"><i class="me-3 bi fs-1 bi-eye-fill text-primary"></i> <?= Text::_('COM_APPOINTMENT_STEP3_H5_2'); ?></h5>
      <?php if($this->maxId > 0) { ?>
         <p><?= Text::sprintf('COM_APPOINTMENT_STEP3_P_1',Route::_('index.php?option=com_appointment&view=preview&preview_bookingtimepageurl=' . $this->maxId)); ?></p>
      <?php } else { ?>
         <p><?= Text::sprintf('COM_APPOINTMENT_STEP3_P_1',Route::_('index.php?option=com_appointment&view=listing')); ?>}</p>
      <?php } ?>
   </div>
</div>
<?php
$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
