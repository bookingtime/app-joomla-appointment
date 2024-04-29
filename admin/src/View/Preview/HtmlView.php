<?php

namespace Bookingtime\Component\Appointment\Administrator\View\Preview;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
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


    public $bookingtimepageurl = null;

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        $appointmentHelper = new AppointmentHelper();
        $session = Factory::getApplication()->getSession();
        $this->bookingtimepageurl = $appointmentHelper->findById($_GET['preview_bookingtimepageurl']);
        if(!empty($this->bookingtimepageurl) && count($this->bookingtimepageurl) > 0 ) {
            $this->bookingtimepageurl = $this->bookingtimepageurl[0];
        }
        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }

}
