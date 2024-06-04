<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

namespace Bookingtime\Component\Appointment\Administrator\Controller;
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

/**
 * Default Controller of Appointment component
 *
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 */
class DisplayController extends BaseController {
    /**
     * The default view for the display method.
     *
     * @var string
     */
    protected $default_view = 'step1';

    public function display($cachable = false, $urlparams = array()) {
        return parent::display($cachable, $urlparams);
    }

}
