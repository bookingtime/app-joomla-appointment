<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Appointment\Module\Appointment\Site\Helper\AppointmentHelper;

$appointmentHelper = new AppointmentHelper();

$appointment  = NULL;
$id = (int)$params->get('appointment');
if($id > 0 && is_int($id)) {
   $appointment = $appointmentHelper->getAppointmentByUid($id);
}


require ModuleHelper::getLayoutPath('mod_appointment', $params->get('layout', 'default'));
