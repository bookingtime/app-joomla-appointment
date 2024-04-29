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

<div id="edit">
   <div class="d-flex align-items-center m-3">
      <a class="backButton btn btn-light rounded-2 me-2" href="<?php echo Route::_('index.php?option=com_appointment&view=listing'); ?>"><i class="bi bi-arrow-left-short"></i> <?= Text::_('COM_APPOINTMENT_LINK_BACK'); ?></a>
      <h4 class="m-0 fw-bold"><?= Text::_('COM_APPOINTMENT_EDIT_HEADER'); ?></h4>
      <button type="button" class="btn btn-danger rounded-2 ms-auto" data-bs-toggle="modal" data-bs-target="#deleteModal">
      <i class="bi bi-trash3-fill"></i> <?= Text::_('COM_APPOINTMENT_LINK_DELETE'); ?>
      </button>
   </div>
   <form name="edit" class="form form_edit m-3" id="form_edit" action="<?php echo Route::_('index.php?option=com_appointment&view=edit'); ?>" method="post">
<?php
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/fields.php');
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalUnsavedForm.php');
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalDelete.php');
?>
<?php include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalUnsavedForm.php'); ?>
<?php include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalDelete.php'); ?>
   </form>
</div>

<?php
include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/documentation.php');

$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
