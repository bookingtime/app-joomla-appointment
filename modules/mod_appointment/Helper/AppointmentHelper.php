<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

namespace Appointment\Module\Appointment\Site\Helper;

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseInterface;

defined('_JEXEC') or die;

/**
 * Helper for mod_appointment
 *
 * @since  4.0
 */
class AppointmentHelper
{


	protected $db;

	public function __construct()
	{
		//db
		$this->db = Factory::getContainer()->get(DatabaseInterface::class);
	}

	/**
	 * getAppointmentByUid
	 * Retrieve one appointment from db
	 *
	 * @param int $uid
	 *
	 * @return  array
	 */
	public function getAppointmentByUid($uid) {
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName(['id','title','url']))
			->from($this->db->quoteName('#__bookingtime_appointment'))
			->order($this->db->quoteName('title') . ' ASC');
		$this->db->setQuery($query);
		return $this->db->loadObject();
	}

	/**
	 * getAllAppointment
	 * Retrieve all appointment from db
	 *
	 * @return  array
	 */
	public function getAllAppointment() {
		$query = $this->db->getQuery(true)
			->select($this->db->quoteName(['id','title','url']))
			->from($this->db->quoteName('#__bookingtime_appointment'))
			->order($this->db->quoteName('title') . ' ASC');
		$this->db->setQuery($query);
		return $this->db->loadObjectList();
	}
}
