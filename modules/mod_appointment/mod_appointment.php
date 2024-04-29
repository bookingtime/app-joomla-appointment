<?php
/**
 * @package    MOD_APPOINTMENT
 *
 * @author     bookingtime GmbH <support@bookingtime.com>
 * @copyright  2014 bookingtime GmbH
 * @license    MIT; see LICENSE.txt
 * @link       https://www.bookingtime.com
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
