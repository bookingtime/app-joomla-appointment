<?php

namespace Bookingtime\Component\Appointment\Administrator\View\Edit;

defined('_JEXEC') or die;

require_once(__DIR__ . '/../../../vendor/autoload.php');


use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Bookingtime\Component\Appointment\Administrator\Helper\AppointmentHelper;


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

    protected $bookingtimepageurl = null;

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        $appointmentHelper = new AppointmentHelper();
        $session = Factory::getApplication()->getSession();

        //update
        if(isset($_POST['appointment'])) {
            if($appointmentHelper->validateTitle($_POST['appointment']['title']) && $appointmentHelper->validateUrl($_POST['appointment']['url'])) {
                $updateArray = [
                    'title' => htmlentities($_POST['appointment']['title']),
                    'url' => $_POST['appointment']['url'],
                ];
                $appointmentHelper->update($updateArray,(int)$_POST['appointment']['id']);

                //flashmessage
                $messages[] = [
                    'class' => 'success',
                    'title' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_ADD_EDIT_TITLE',$updateArray['title']),
                    'message' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_ADD_EDIT_MESSAGE',$updateArray['url']),
                ];

                //set session
                $session->set('flashmessages',$messages);

            }

            //redirect
            $app = Factory::getApplication();
            $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=listing');
            $app->close();
        }

        //delete
        if(isset($_GET['delete_bookingtimepageurl'])) {

            $bookingtimepageurl = $appointmentHelper->findById($_GET['delete_bookingtimepageurl']);

            //check if row exists
            if(count($bookingtimepageurl)>0) {
                $bookingtimepageurl = $bookingtimepageurl[0];
            } else {
                //flashmessage
                $messages[] = [
                    'class' => 'error',
                    'title' => TEXT::_('COM_APPOINTMENT_FLASHMESSAGE_DELETE_TITLE_ERROR'),
                    'message' => TEXT::_('COM_APPOINTMENT_FLASHMESSAGE_DELETE_MESSAGE_ERROR'),
                ];
                //set session
                $session->set('flashmessages',$messages);
                //redirect
                $app = Factory::getApplication();
                $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=listing');
                $app->close();
            }

            //delete
            $appointmentHelper->delete($_GET['delete_bookingtimepageurl']);
            //flashmessage
            $messages[] = [
                'class' => 'success',
                'title' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_DELETE_TITLE',$bookingtimepageurl->title),
                'message' => TEXT::sprintf('COM_APPOINTMENT_FLASHMESSAGE_DELETE_MESSAGE',$bookingtimepageurl->url),
            ];

            //set session
            $session->set('flashmessages',$messages);

            //redirect
            $app = Factory::getApplication();
            $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=listing');
            $app->close();
        }

        $this->bookingtimepageurl = $appointmentHelper->findById($_GET['edit_bookingtimepageurl']);

        if(!empty($this->bookingtimepageurl) && count($this->bookingtimepageurl) > 0) {
            $this->bookingtimepageurl = $this->bookingtimepageurl[0];
        }

        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }

}
