<?php
/**
 * @package     MOD_APPOINTMENT
 * @subpackage  com_appointment
 *
 * @copyright   Copyright (C) 2014 bookingtime GmbH. All rights reserved.
 * @license     MIT; see LICENSE
 */

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$document = JFactory::getDocument();
$assetsUrl  = JURI::root() . '/administrator/components/com_appointment/assets/';
$document->addStyleSheet($assetsUrl . 'bootstrap/css/bootstrap.min.css');
$document->addStyleSheet($assetsUrl . 'css/bootstrap-icons.css');
$document->addStyleSheet($assetsUrl . 'css/lightbox.min.css');
$document->addStyleSheet($assetsUrl . 'css/com_appointment.css');

$document->addScript($assetsUrl . 'js/jquery-3.6.1.min.js');
$document->addScript($assetsUrl . 'bootstrap/js/bootstrap.bundle.min.js');
$document->addScript($assetsUrl . 'js/lightbox.min.js');
$document->addScript($assetsUrl . 'js/com_appointment.js');
?>
<div class="mod-tx_bookingtime_appointment">
   <header class="header container-fluid">
    <div class="container-xxl">
        <div class="row">
            <div class="col-8 navigation">
              <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="<?php echo JURI::root(); ?>administrator/index.php?option=com_appointment"><img class="image-embed-item" src="<?php echo JURI::root(); ?>administrator/components/com_appointment/assets/img/logo_appointment.png" alt="" width="206" height="36"></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav"></div>
                  </div>
                </div>
              </nav>
          </div>
          <div class="col-4 information d-flex align-items-center justify-content-end">
              <a class="btn btn-primary rounded-3" target="_blank" href="https://app.bookingtime.com/startpage"><i class="bi bi-box-arrow-up-right"></i> <span class="fw-bold"><?= Text::_('COM_APPOINTMENT_HEADER_LINK_EXTERNAL_2'); ?></span></a>
          </div>
        </div>
    </div>
  </header>
  <div class="flashMessages">
<?php
$session = Factory::getApplication()->getSession();
if($session->get('flashmessages') && count($session->get('flashmessages')) > 0) {
  foreach ($session->get('flashmessages') as $key => $flashmessage) { ?>

    <div class="alert alert-<?= $flashmessage['class'] ?>">
      <div class="media d-flex">
          <div class="media-left me-4">
            <span class="fs-1">
              <?php if($flashmessage['class'] == 'success') { ?>
                <i class="text-success bi bi-check-circle-fill"></i>
              <?php } ?>
              <?php if($flashmessage['class'] == 'error') { ?>
                <i class="text-danger bi bi-exclamation-triangle-fill"></i>
              <?php } ?>
              <?php if($flashmessage['class'] == 'info') { ?>
                <i class="text-info bi bi-info-square-fill"></i>
              <?php } ?>
              <?php if($flashmessage['class'] == 'notice') { ?>
                <i class="text-primary bi bi-exclamation-square-fill"></i>
              <?php } ?>
            </span>
          </div>
          <div class="media-body">
            <h4 class="alert-title fw-bold"><?= $flashmessage['title'] ?></h4>
            <p class="alert-message"><?= $flashmessage['message'] ?></p>
          </div>
      </div>
    </div>

  <?php }
}
?>
  </div>
