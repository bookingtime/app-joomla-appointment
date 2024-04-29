<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\FileLayout;

/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');

$layout = new FileLayout('joomla.content.header');
echo $layout->render();
?>

<div id="add">
   <div class="d-flex align-items-center m-3">
      <a class="backButton btn btn-light rounded-2 me-2" href="<?php echo Route::_('index.php?option=com_appointment&view=listing'); ?>"><i class="bi bi-arrow-left-short"></i> <?= Text::_('COM_APPOINTMENT_LINK_BACK'); ?></a>
      <h4 class="m-0 fw-bold"><?= Text::_('COM_APPOINTMENT_EDIT_HEADER'); ?></h4>
   </div>
   <form name="edit" class="form form_edit m-3" id="form_edit" action="<?php echo Route::_('index.php?option=com_appointment&view=add'); ?>" method="post">
<?php
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/fields.php');
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalUnsavedForm.php');
?>
   </form>
</div>

<?php
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/documentation.php');

$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
