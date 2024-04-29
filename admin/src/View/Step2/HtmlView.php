<?php

namespace Bookingtime\Component\Appointment\Administrator\View\Step2;

defined('_JEXEC') or die;

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

    protected $email = null;
    protected $locale = null;

    protected $sectorList = null;
    protected $countries = null;

    /**
     * Display the main "Appointment" view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {
        $appointmentHelper = new AppointmentHelper();
        $session = Factory::getApplication()->getSession();

        $this->countries = $appointmentHelper->countries;
        $this->locale = $appointmentHelper->getLocale();

       //validate step2
        $dataToValidate = [
            'email',
            'firstname',
            'lastname',
            'company',
            'terms',
            'dsgvo',
            'address' => [
                'street',
                'zip',
                'city',
                'country'
            ]
        ];

        if(isset($_POST['appointment']) && $appointmentHelper->validateStep2($dataToValidate,$_POST['appointment'])) {
            //create validated data array
            foreach ($dataToValidate as $key) {
                if(is_array($key))  {
                    foreach ($key as $addressKey) {
                        $validatedData['address'][$addressKey] = $_POST['appointment']['address'][$addressKey];
                    }
                } else {
                    $validatedData[$key] = $_POST['appointment'][$key];
                }
            }

            //data from form
            $data = [
                'email',
                'firstname',
                'lastname',
                'company',
                'address' => [
                    'street',
                    'zip',
                    'city',
                    'country'
                ]
            ];

            $formData = [];
            foreach ($data as $key) {
                if(is_array($key))  {
                foreach ($key as $addressKey) {
                    $formData['address'][$addressKey] = $_POST['appointment']['address'][$addressKey];
                }
                } else {
                $formData[$key] = $_POST['appointment'][$key];
                }
            }

            //set locale
            $formData['locale'] =  substr($appointmentHelper->getLocale(),0,2);

            //set phpTimeZone
            $formData['phpTimeZone'] = $appointmentHelper->getTimezone();

            //create contractAccount
            try {
                $contractAccount=$appointmentHelper->sdk->contractAccount_add([],$appointmentHelper->makeContractAccountDataArray($formData));

            } catch(RequestException $e) {

                //flashmessage
                $messages[] = [
                    'class' => 'error',
                    'title' => Text::sprintf('COM_APPOINTMENT_FLASHMESSAGE_STEP3_ERROR_CONTRACTACCOUNT_TITLE', $e->getCode()),
                    'message' => Text::sprintf('COM_APPOINTMENT_FLASHMESSAGE_STEP3_ERROR_RESPONSE_MESSAGE', $e->getMessage()),
                ];

                //set session
                $session->set('flashmessages',$messages);

                //redirect
                $app = Factory::getApplication();
                $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=step1');
                $app->close();
            }

            //create organization
            try {
                $formData['contractAccount'] = $contractAccount;
                $organizantion = $appointmentHelper->sdk->organization_add([],$appointmentHelper->makeParentOrganizationDataArray($formData));
            } catch(RequestException $e) {

                //flashmessage
                $messages[] = [
                    'class' => 'error',
                    'title' => Text::sprintf('COM_APPOINTMENT_FLASHMESSAGE_STEP3_ERROR_ORGANIZATION_TITLE', $e->getCode()),
                    'message' => Text::sprintf('COM_APPOINTMENT_FLASHMESSAGE_STEP3_ERROR_RESPONSE_MESSAGE', $e->getMessage()),
                ];

                //set session
                $session->set('flashmessages',$messages);

                //redirect
                $app = Factory::getApplication();
                $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=step1');
                $app->close();
            }


            //write to db
            if($appointmentHelper->writeOrganizationResponseToDB($organizantion['recordList'])) {
                //flashmessage
                $messages[] = [
                    'class' => 'success',
                    'title' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_STEP3_TITLE'),
                    'message' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_STEP3_MESSAGE'),
                ];

                //set session & email
                $session->set('flashmessages',$messages);
                $session->set('email',$formData['email']);

                //redirect
                $app = Factory::getApplication();
                $app->redirect(\JURI::root() . 'administrator/index.php?option=com_appointment&view=step3');
                $app->close();

            } else {
                //flashmessage
                $messages[] = [
                    'class' => 'error',
                    'title' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_STEP3_TITLE_ERROR'),
                    'message' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_STEP3_MESSAGE_ERROR'),
                ];
            }
            //set session
            $session->set('flashmessages',$messages);

        }

        parent::display($tpl);
        $session->set('flashmessages',NULL);
    }

}
