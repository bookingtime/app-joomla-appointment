<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

namespace Bookingtime\Component\Appointment\Administrator\Helper;
defined('_JEXEC') or die('Restricted Access');


require_once(__DIR__ . '/../../vendor/autoload.php');

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseInterface;
use bookingtime\phpsdkapp\Sdk;
use Joomla\CMS\Language\Text;


class AppointmentHelper
{


   public $sdk = NULL;
   public $user = NULL;
   public $userParams = NULL;
   public $db = NULL;
   public $countries = NULL;
   public $app = NULL;
   public $sectorList = NULL;
   public $organizationTemplateLanguageSuffix = 'EN';

   const MODULE_CONFIG_SHORT = 'MODULE_CONFIG_SHORT';
   const MODULE_ID = '23C4ejWwJt9G78gSYIAmhTrTzs2PoHb2';

   public function __construct() {

      //current user
      $this->app = Factory::getApplication();
      $this->user = $this->app->getIdentity();
      $this->userParams = json_decode($this->user->params);

      //db
      $this->db = Factory::getContainer()->get(DatabaseInterface::class);

      //sdk connection
		$clientId = 'c5dIniVAkJUMQglgIeIOrKaDHiku3aCmBBKHU9uGH1jGm64gGcnYlsWJIseqgNrm';
		$clientSecret = 'hX8gUbPMa1gJZpjruvfYRBnfTR0AmK2WJAC73KnjJN498jDzUkFSYCCbX7swYqga';
		$configArray = [
			'appApiUrl'=>'https://api.bookingtime.com/app/v3/',
			'oauthUrl'=>'https://auth.bookingtime.com/oauth/token',
			'locale'=>$this->getLocale(),
			'timeout'=>15,
			'mock'=>FALSE,
		];
      $this->sdk = new Sdk($clientId,$clientSecret,$configArray);

      //get static sector list
      $this->sectorList = $this->sdk->static_sector_list([]);

      //get countries
      $countryArray = $this->sdk->static_country_list([]);
      $this->countries = $countryArray['recordList'];

		if($this->getLocale() === 'de') {
			$this->organizationTemplateLanguageSuffix = 'DE';
		} else {
			$this->organizationTemplateLanguageSuffix = 'EN';
		}

   }

   /**
    * findAll appointment
    * @return array|
    */
   public function findAll() {
      // get all appointment
      $query = $this->db->getQuery(true)
         ->select('*')
         ->from($this->db->quoteName('#__bookingtime_appointment'))
         ->order($this->db->quoteName('title') . ' ASC');
      $this->db->setQuery($query);
      return $this->db->loadObjectList();
   }

   /**
    * findById appointment
    * @param int id
    * @return array|
    */
   public function findById($id) {
      // get one by id appointment
      $query = $this->db->getQuery(true)
         ->select('*')
         ->from($this->db->quoteName('#__bookingtime_appointment'))
         ->where($this->db->quoteName('id') . ' = ' . (int)$id);
      $this->db->setQuery($query);
      return $this->db->loadObjectList();
   }

	/**
	 * getMaxId
	 * returns max id from table appointment
	 * @return int|false
	 */
	public function getMaxId() {
      $query = $this->db->getQuery(true)
         ->select('*')
         ->from($this->db->quoteName('#__bookingtime_appointment'))
         ->order('id DESC')
         ->setLimit(1);
      $this->db->setQuery($query);

		$res = $this->db->loadObjectList();
		if(isset($res[0])) {
			return (int) $res[0]->id;
		} else {
			return false;
		}
	}

   /**
    * insert
    * @param array insertArray
    * @return bool
    */
   public function insert($insertArray) {
      $query = $this->db->getQuery(true);
      // Insert columns.
      $columns = array('title', 'url');
      // Insert values.
      $values = array($this->db->quote($insertArray['title']), $this->db->quote($insertArray['url']));
      // Prepare the insert query.
      $query
         ->insert($this->db->quoteName('#__bookingtime_appointment'))
         ->columns($this->db->quoteName($columns))
         ->values(implode(',', $values));
      // Set the query using our newly populated query object and execute it.
      $this->db->setQuery($query);
      return $this->db->execute();
   }

   /**
    * update
    * @param array updateArray
    * @param int   id
    * @return bool
    */
   public function update($updateArray,$id) {
      $query = $this->db->getQuery(true);

      // Fields to update.
      $fields = array(
         $this->db->quoteName('title') . ' = ' . $this->db->quote($updateArray['title']),
         $this->db->quoteName('url') . ' = ' . $this->db->quote($updateArray['url'])
      );

      // Conditions for which records should be updated.
      $conditions = array(
         $this->db->quoteName('id') . ' = ' . $this->db->quote($id)
      );

      $query->update($this->db->quoteName('#__bookingtime_appointment'))->set($fields)->where($conditions);
      $this->db->setQuery($query);
      return $this->db->execute();
   }

   /**
    * delete
    * @param int id
    * @return bool
    */
   public function delete($id) {
      $query = $this->db->getQuery(true);
      $conditions = array(
         $this->db->quoteName('id') . ' = ' . $id
      );
      $query->delete($this->db->quoteName('#__bookingtime_appointment'));
      $query->where($conditions);
      $this->db->setQuery($query);
      return $this->db->execute();
   }


   /**
    * @param string $email
    * @return boolean
    */
   public function validateEmailAddress($email):bool {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return true;
      } else {
         return false;
      }
   }

   /**
    * is_valid_url
    * @param string $url
    * @return boolean
    */
   function is_valid_url($url):bool {
      return preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $url);
   }

	/**
	 * validateTitle
	 * @param string $title
	 *
	 * @return bool
	 */
	public function validateTitle($title):bool {

      $session = Factory::getApplication()->getSession();

		if (trim($title) !== '') {
			return true;
		} else {
			//flashmessage
         $messages[] = [
            'class' => 'error',
				'title' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_VALIDATETITLE_TITLE'),
				'message' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_VALIDATETITLE_MESSAGE'),
         ];

         //set session
         $session->set('flashmessages',$messages);

			return false;
		}
	}

	/**
	 * validateUrl
	 * @param string $url
	 *
	 * @return bool
	 */
	public function validateUrl($url):bool {

      $session = Factory::getApplication()->getSession();

		if (filter_var($url, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			//flashmessage
         $messages[] = [
            'class' => 'error',
				'title' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_VALIDATEURL_TITLE'),
				'message' => Text::_('COM_APPOINTMENT_FLASHMESSAGE_VALIDATEURL_MESSAGE'),
         ];

         //set session
         $session->set('flashmessages',$messages);

			return false;
		}
	}

   /**
    * @param array $dataToValidate
    * @param array $arguments
    */
   public function validateStep2($dataToValidate, $arguments):bool {
      foreach ($dataToValidate as $key) {
         if(is_array($key))  {
            foreach ($key as $addressKey) {
               if (array_key_exists($addressKey, $arguments['address'])) {
                  switch ($addressKey) {
                     case 'street':
                     case 'zip':
                     case 'city':
                     case 'country':
                        if ($arguments['address'][$addressKey] == '') {
                           return false;
                        }
                     break;
                  }
               }
            }
         } else {
            if (array_key_exists($key, $arguments)) {
               switch ($key) {
                  case 'firstname':
                  case 'lastname':
                  case 'company':
                     if ($arguments[$key] == '') {
                        return false;
                     }
                     break;
                  case 'terms':
                  case 'dsgvo':
                     if ($arguments[$key] !== '1') {
                        return false;
                     }
                     break;
                  case 'email':
                     if ($arguments[$key] == '' || !$this->validateEmailAddress($arguments[$key])) {
                        return false;
                     }
                     break;
               }
            } else {
               return false;
            }
         }
      }
      return true;
   }

   /**
    * put data from form in dataArray for customerGroup
    *
    * @param	array		$formArray: data from form
    * @return	array		$contractAccountDataArray: array with all data to create contractAccount
    */
   public function makeContractAccountDataArray($formData): array
   {
      $contractAccountDataArray = [
         'name' => $formData['company'],
         'locale' => $formData['locale'],
         'timeZone' => $formData['phpTimeZone'],
         'admin' => [
            'gender' => 'NOT_SPECIFIED',
            'firstName' => $formData['firstname'],
            'lastName' => $formData['lastname'],
            'email' => $formData['email'],
         ],
         'contactPerson' => [
            'gender' => 'NOT_SPECIFIED',
            'firstName' => $formData['firstname'],
            'lastName' => $formData['lastname'],
            'email' => $formData['email'],
         ],
         'address' => [
            'name' => $formData['company'],
            'street' => $formData['address']['street'],
            'zip' => $formData['address']['zip'],
            'city' => $formData['address']['city'],
            'country' => $formData['address']['country']
         ],
         'invoiceEmail' => $formData['email'],
      ];
      return $contractAccountDataArray;
   }

   /**
    *  put data from form in dataArray for organization
    *
    * @param	array		$formData: data from form
    * @return	array		$parentOrganizationDataArray: array with all data to create parentOrganization
    */
   public function makeParentOrganizationDataArray($formData): array
   {
      $parentOrganizationDataArray = [
         'name' => $formData['contractAccount']['name'],
         'contractAccountId' => $formData['contractAccount']['id'],
         'address' => [
            'name' => $formData['company'],
            'street' => $formData['address']['street'],
            'zip' => $formData['address']['zip'],
            'city' => $formData['address']['city'],
            'country' => $formData['address']['country']
         ],
         'sector' => '01ab',
         'email' => $formData['email'],
         'contactPerson' => [
            'gender' => 'NOT_SPECIFIED',
            'firstName' => $formData['firstname'],
            'lastName' => $formData['lastname'],
            'email' => $formData['email'],
         ],
         'settings' => [
            'locale' => $formData['locale'],
            'timeZone' => $formData['phpTimeZone'],
            'emailReply' => $formData['email'],
         ],
         'admin' => [
            'gender' => 'NOT_SPECIFIED',
            'firstName' => $formData['firstname'],
            'lastName' => $formData['lastname'],
            'email' => $formData['email'],
         ],
         'organizationTemplateList' => [
            'DEFAULT_' . $this->organizationTemplateLanguageSuffix
         ]
      ];
      return $parentOrganizationDataArray;
   }

   /**
    * writeOrganizationResponseToDB
    * @param array $recordList
    * @return bool
    */
   public function writeOrganizationResponseToDB(array $recordList):bool {
      foreach ($recordList as $key => $rec) {
         if($rec['class'] === self::MODULE_CONFIG_SHORT && $rec['moduleId'] === self::MODULE_ID) {
            //create new entry to db
            $insertArray = [
                'title' => $rec['moduleName'],
                'url' => 'https://module.bookingtime.com/booking/organization/'.$rec['organizationId'].'/moduleConfig/' . $rec['id']
            ];
            if($this->insert($insertArray)) {
               return true;
            }
         }
      }
      return false;
   }

	/**
	 * getLocale()
	 * @return string
	 */
	public function getLocale() {
      //user
      if($this->user->getParam('admin_language')) {
         return substr($this->user->getParam('admin_language'),0,2);
      }

      //default
		return 'en';
	}

	/**
	 * getTimezone()
	 * @return string
	 */
	public function getTimezone() {
      //user
      if($this->user->getParam('timezone') && $this->user->getParam('timezone') !== '') {
         return $this->user->getParam('timezone');
      }

      //server
		if(date_default_timezone_get() && date_default_timezone_get() !== '') {
			return date_default_timezone_get();
		}

      //default
		return 'Europe/Berlin';
	}



}
