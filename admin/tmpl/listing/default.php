<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Document\Factory;

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

<div id="list">
   <div class="d-flex align-items-center m-3">
      <h4 class="m-0 fw-bold"><?= Text::_('COM_APPOINTMENT_LIST_HEADER'); ?></h4>
      <a class="add_action_link_top ms-auto fw-bold" href="<?php echo Route::_('index.php?option=com_appointment&view=add'); ?>" ><i class="bi bi-plus-lg"></i> <?= Text::_('COM_APPOINTMENT_LIST_ADD'); ?></a>
   </div>
   <?php if($this->bookingtimepageurls) { ?>
   <div class="box border border-3 rounded-3 m-3">
         <?php foreach ($this->bookingtimepageurls as $key => $bookingtimepageurl) { ?>
            <div class="border-bottom p-3 d-flex align-items-center justify-content-between">
               <div>
                  <strong><?= $bookingtimepageurl->title ?></strong>
                  <br />
                  <small><?= $bookingtimepageurl->url ?></small>
               </div>
               <div>
                  <div class="d-flex">
                     <a class="btn btn-secondary d-inline-flex align-items-center me-2" href="<?php echo Route::_('index.php?option=com_appointment&view=preview'); ?>&preview_bookingtimepageurl=<?= $bookingtimepageurl->id ?>"><i class="bi bi-eye-fill me-2"></i> <?= Text::_('COM_APPOINTMENT_LIST_ACTIONS_PREVIEW'); ?></a>
                     <a class="btn btn-primary d-inline-flex align-items-center" href="<?php echo Route::_('index.php?option=com_appointment&view=edit'); ?>&edit_bookingtimepageurl=<?= $bookingtimepageurl->id ?>"><i class="bi bi-pencil-fill me-2"></i> <?= Text::_('COM_APPOINTMENT_LIST_ACTIONS_EDIT'); ?></a>
                  </div>
               </div>
            </div>
         <?php } ?>
   </div>
<?php } else { ?>
   <div class="box border border-3 rounded-3 m-3 text-center p-3">
      <h4 class="m-3 fw-bold"><?= Text::_('COM_APPOINTMENT_LIST_ADD_FIRST_HEADER'); ?></h4>
      <p class="m-3"><?= Text::_('COM_APPOINTMENT_LIST_ADD_FIRST_TEXT'); ?></p>
      <a class="m-3 add_action_link ms-auto fw-bold btn btn-primary" href="<?php echo Route::_('index.php?option=com_appointment&view=add'); ?>" ><i class="bi bi-plus-lg"></i> <?= Text::_('COM_APPOINTMENT_LIST_ADD_FIRST_BUTTON'); ?></a>
   </div>
<?php } ?>
</div>

<?php
$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
