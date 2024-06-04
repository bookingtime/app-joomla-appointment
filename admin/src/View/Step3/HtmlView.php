<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

namespace Bookingtime\Component\Appointment\Administrator\View\Step3;

defined('_JEXEC') or die;

require_once(__DIR__ . '/../../../vendor/autoload.php');


use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Bookingtime\Component\Appointment\Administrator\Helper\AppointmentHelper;
use \bookingtime\phpsdkapp\Sdk\Exception\RequestException;

/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

/**
 * Main "Appointment" Admin View
 */
class HtmlView extends BaseHtmlView {

    protected $email = null;
    protected $maxId = null;

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        $appointmentHelper = new AppointmentHelper();
        $session = Factory::getApplication()->getSession();

        $this->maxId = $appointmentHelper->getMaxId();

        $this->email = $session->get('email');
        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }
}
