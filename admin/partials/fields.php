<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;

/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<fieldset class="fieldset1 border border-3 rounded-3 p-3 mt-3" id="edit_fieldset1">
   <div class="hidden">
      <input type="hidden" name="appointment[id]" value="<?= $this->bookingtimepageurl->id ?>" />
   </div>
   <div class="mb-3">
      <label for="title" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_TITLE_LABEL'); ?></label>
      <input placeholder="<?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_TITLE_PLACEHOLDER'); ?>" class="rounded-2 p-2 w-100" id="title" type="text" name="appointment[title]" value="<?= isset($this->bookingtimepageurl) ? $this->bookingtimepageurl->title : ''  ?>" />
      <label for="title" class="form-label col-12 text-muted"><?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_TITLE_LABEL_BOTTOM'); ?></label>
   </div>
   <div class="mb-3">
      <label for="url" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_URL_LABEL'); ?></label>
      <input placeholder="<?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_URL_PLACEHOLDER'); ?>" class="rounded-2 p-2 w-100" id="url" type="url" name="appointment[url]" required="required" value="<?= isset($this->bookingtimepageurl) ?  $this->bookingtimepageurl->url : '' ?>" />
      <label for="url" class="form-label col-12 text-muted"><?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_URL_LABEL_BOTTOM'); ?></label>
   </div>
</fieldset>
<fieldset class="fieldset2 border border-3 rounded-3 p-3 mt-0 mx-auto" id="edit_fieldset2">
   <div class="d-flex justify-content-end">
      <a href="<?php echo Route::_('index.php?option=com_appointment&view=listing'); ?>" class="btn btn-secondary rounded-2 me-3">
         <i class="bi bi-x-lg"></i>
         <?= Text::_('COM_APPOINTMENT_LINK_DISCARD'); ?>
      </a>
      <button class="btn btn-success rounded-2" type="submit" name="" value="">
         <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.1667 0.5H2.16667C1.24167 0.5 0.5 1.25 0.5 2.16667V13.8333C0.5 14.75 1.24167 15.5 2.16667 15.5H13.8333C14.75 15.5 15.5 14.75 15.5 13.8333V3.83333L12.1667 0.5ZM8 13.8333C6.61667 13.8333 5.5 12.7167 5.5 11.3333C5.5 9.95 6.61667 8.83333 8 8.83333C9.38333 8.83333 10.5 9.95 10.5 11.3333C10.5 12.7167 9.38333 13.8333 8 13.8333ZM10.5 5.5H2.16667V2.16667H10.5V5.5Z" fill="#ffffff" fill-opacity="0.92"/></svg>
         <?= Text::_('COM_APPOINTMENT_ADD_EDIT_FORM_BUTTON_SUBMIT'); ?>
      </button>
   </div>
</fieldset>
