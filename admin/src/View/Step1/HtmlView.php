<?php

namespace Bookingtime\Component\Appointment\Administrator\View\Step1;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Bookingtime\Component\Appointment\Administrator\Helper\AppointmentHelper;


/**
 * @package     COM_BT_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (c) 2014 bookingtime GmbH. All Rights Reserved.
 * @license     MIT; see LICENSE.txt
 */

/**
 * Main "Appointment" Admin View
 */
class HtmlView extends BaseHtmlView {

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {
        $appointmentHelper = new AppointmentHelper();
        $bookingtimeurls = $appointmentHelper->findAll();
        if(count($bookingtimeurls) > 0) {
            $app = Factory::getApplication();
            $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=listing');
            $app->close();
        }

        $session = Factory::getApplication()->getSession();
        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }

}
