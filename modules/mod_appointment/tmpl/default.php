<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

defined('_JEXEC') or die;
if(is_object($appointment) && !empty($appointment) ) { ?>
<div class="embed-responsive embed-responsive-16by9 ratio ratio-16x9">
	<iframe
		id="appointment_iframe_<?= $appointment->id; ?>"
		width="100%"
		src="<?= $appointment->url; ?>"
		title="<?= $appointment->title; ?>"
		class="appointment_iframe embed-responsive-item mod-wrapper wrapper"
		frameborder="0"
		allowfullscreen></iframe>
</div>
<?php }

?>
