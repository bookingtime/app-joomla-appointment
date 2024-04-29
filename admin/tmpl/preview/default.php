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
<div id="preview">
   <div class="d-flex align-items-center m-3">
      <a class="btn btn-light rounded-2 me-2" href="<?php echo Route::_('index.php?option=com_appointment&view=listing'); ?>"><i class="bi bi-arrow-left-short"></i> <?= Text::_('COM_APPOINTMENT_LINK_BACK'); ?></a>
      <h4 class="m-0 fw-bold"><?= Text::_('COM_APPOINTMENT_PREVIEW_HEADER'); ?></h4>
   </div>

<?php if($this->bookingtimepageurl) { ?>
   <div class="box border border-3 rounded-3 m-3">
      <div class="border-bottom">
         <h5 class="p-3 m-0"><?= $this->bookingtimepageurl->title ?></h5>
      </div>
      <div class="ratio ratio-16x9 my-3">
         <iframe src="<?= $this->bookingtimepageurl->url ?>" title="<?= $this->bookingtimepageurl->title ?>" class="embed-responsive-item iframe_<?= $this->bookingtimepageurl->id ?>" allowfullscreen></iframe>
      </div>
      <div class="border-top">

      </div>
   </div>
<?php } else { ?>
   <div class="box border border-3 rounded-3 p-3 m-3">
      <h5 class="text-center text-danger"><?= Text::_('COM_APPOINTMENT_PREVIEW_H5_2'); ?></h5>
   </div>
<?php } ?>
</div>
<?php
$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
