<?php

namespace Bookingtime\Component\Appointment\Administrator\View\Add;

defined('_JEXEC') or die;

require_once(__DIR__ . '/../../../vendor/autoload.php');


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

    protected $bookingtimepageurls = null;

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        $appointmentHelper = new AppointmentHelper();
        $session = Factory::getApplication()->getSession();

        if(isset($_POST['appointment'])) {
            if($appointmentHelper->validateTitle($_POST['appointment']['title']) && $appointmentHelper->validateUrl($_POST['appointment']['url'])) {
                $insertArray = [
                    'title' => htmlentities($_POST['appointment']['title']),
                    'url' => $_POST['appointment']['url'],
                ];
                $appointmentHelper->insert($insertArray);

                //flashmessage
                $messages[] = [
                    'class' => 'success',
                    'title' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_ADD_EDIT_TITLE',$insertArray['title']),
                    'message' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_ADD_EDIT_MESSAGE',$insertArray['url']),
                ];

                //set session
                $session->set('flashmessages',$messages);

            }

            //redirect
            $app = Factory::getApplication();
            $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=listing');
            $app->close();
        }

        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }
}
