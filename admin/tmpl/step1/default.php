<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\FileLayout;

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

$layout = new FileLayout('joomla.content.header');
echo $layout->render();
?>
<div class="step" id="step1">
   <div class="box1 border border-3 rounded-3 p-3 mt-5 mx-auto" id="step1">
      <h4 class="text-center m-3 fw-bold"><?= Text::_('COM_APPOINTMENT_STEP1_H4_1'); ?></h4>
      <p class="text-center m-3"><?= Text::_('COM_APPOINTMENT_STEP1_P_1'); ?></p>
      <p class="text-center m-3"><a class="btn btn-primary rounded-2 fw-bold" href="<?php echo Route::_('index.php?option=com_appointment&view=step2'); ?>"><?= Text::_('COM_APPOINTMENT_STEP1_LINK_ACTION_STEP2'); ?></a></p>
  </div>
   <div class="box2 border border-3 rounded-3 p-3 mt-0 mx-auto" id="step1">
      <h4 class="text-center m-3 fw-bold"><?= Text::_('COM_APPOINTMENT_STEP1_H4_2'); ?></h4>
      <p class="text-center"><a class="btn btn-outline-primary rounded-2 fw-bold" href="<?php echo Route::_('index.php?option=com_appointment&view=listing'); ?>"><?= Text::_('COM_APPOINTMENT_STEP1_LINK_ACTION_LIST'); ?></a></p>
  </div>
</div>
<?php
$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
