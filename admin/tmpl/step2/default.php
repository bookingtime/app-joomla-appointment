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

<form name="step2" class="form form_step" id="form_step2" action="<?php echo Route::_('index.php?option=com_appointment&view=step2'); ?>" method="post">
  <fieldset class="fieldset1 border border-3 rounded-3 p-3 mt-5 mx-auto" id="step2">
   <h4 class="mt-3 my-1 fw-bold"><?= Text::_('COM_APPOINTMENT_STEP2_H4_1'); ?></h4>
   <em class="mb-3 d-block"><?= Text::_('COM_APPOINTMENT_REQUIRED_INFO'); ?></em>
   <div class="row">
      <div class="mb-3 col-12">
         <label for="email" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_EMAIL_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_EMAIL_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="email" type="email" name="appointment[email]" required="required" />
      </div>
      <div class="mb-3 col-6">
         <label for="firstname" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_FIRSTNAME_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_FIRSTNAME_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="firstname" type="text" name="appointment[firstname]" required="required">
      </div>
      <div class="mb-3 col-6">
         <label for="lastname" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_LASTNAME_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_LASTNAME_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="lastname" type="text" name="appointment[lastname]" required="required">
      </div>
      <div class="mb-3 col-12">
         <label for="company" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_COMPANY_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_COMPANY_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="company" type="text" name="appointment[company]" required="required">
      </div>
      <div class="mb-3 col-12">
         <label for="address[street]" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_STREET_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_STREET_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="address[street]" type="text" name="appointment[address][street]" value="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_STREET_PLACEHOLDER'); ?>" required="required">
      </div>
      <div class="mb-3 col-6">
         <label for="address[zip]" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_ZIP_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_ZIP_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="address[zip]" type="text" name="appointment[address][zip]" value="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_ZIP_PLACEHOLDER'); ?>" required="required">
      </div>
      <div class="mb-3 col-6">
         <label for="address[city]" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_CITY_LABEL'); ?></label>
         <input placeholder="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_CITY_PLACEHOLDER'); ?>" class="rounded-2 col-12 p-2" id="address[city]" type="text" name="appointment[address][city]" value="<?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_CITY_PLACEHOLDER'); ?>" required="required">
      </div>
      <div class="mb-3 col-12">
         <label for="address[country]" class="form-label col-12"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_ADDRESS_COUNTRY_LABEL'); ?></label>
         <select class="form-select" required="required" name="appointment[address][country]">
            <?php foreach ($this->countries as $country) {  ?>
               <?php if($country['code'] == 'DE') { ?>
                  <option selected="selected" value="<?= $country['code'] ?>"><?= $country['name'] ?></option>
               <?php } else { ?>
                  <option value="<?= $country['code'] ?>"><?= $country['name'] ?></option>
               <?php } ?>
            <?php } ?>
         </select>
      </div>
   </div>
   <div class="mb-3 col-12 form-check d-flex align-items-start">
      <input required="required" class="form-check-input me-2" id="terms" type="checkbox" name="appointment[terms]" value="1">
      <label for="terms" class="form-check-label d-inline">
          <?php if($this->locale == 'de') { ?>
            <?= Text::sprintf('COM_APPOINTMENT_STEP2_FORM_CHECKBOX_TERMS','https://service.bookingtime.com/legal/de/agb/bookingtime_AGB.pdf'); ?>
            <?php } else { ?>
            <?= Text::sprintf('COM_APPOINTMENT_STEP2_FORM_CHECKBOX_TERMS','https://service.bookingtime.com/legal/en/terms/bookingtime_Terms_and_Conditions.pdf'); ?>
         <?php } ?>
      </label>
   </div>
   <div class="mb-3 col-12 form-check d-flex align-items-start">
      <input required="required" class="form-check-input me-2" id="dsgvo" type="checkbox" name="appointment[dsgvo]" value="1">
      <label for="dsgvo" class="form-check-label d-inline">
          <?php if($this->locale == 'de') { ?>
            <?= Text::sprintf('COM_APPOINTMENT_STEP2_FORM_CHECKBOX_DSGVO','https://service.bookingtime.com/legal/de/datenschutz/bookingtime_Datenschutzbestimmungen.pdf'); ?>
         <?php } else { ?>
            <?= Text::sprintf('COM_APPOINTMENT_STEP2_FORM_CHECKBOX_DSGVO','https://service.bookingtime.com/legal/en/privacy/bookingtime_Privacy_Policy.pdf'); ?>
         <?php } ?>
      </label>
   </div>
  </fieldset>
  <fieldset class="fieldset2 border border-3 rounded-3 p-3 mt-0 mx-auto" id="step2bottom">
   <div class="container text-center m-0 p-0">
      <div class="row m-0 p-0">
         <div class="col d-flex justify-content-start m-0 p-0">
            <a class="backButton btn btn-light rounded-2" href="<?php echo Route::_('index.php?option=com_appointment&view=step1'); ?>"><i class="bi bi-arrow-left-short"></i> <?= Text::_('COM_APPOINTMENT_STEP2_LINK_ACTION_STEP1'); ?></a>
         </div>
         <div class="col d-flex justify-content-end m-0 p-0">
            <button class="btn btn-primary rounded-2" type="submit"><?= Text::_('COM_APPOINTMENT_STEP2_FORM_BUTTON_SUBMIT'); ?></button>
         </div>
      </div>
   </div>
  </fieldset>
   <?php $action="step1"; include_once (JPATH_COMPONENT_ADMINISTRATOR.'/partials/modalUnsavedForm.php'); ?>
</form>

<?php
$layout = new FileLayout('joomla.content.footer');
echo $layout->render();
?>
