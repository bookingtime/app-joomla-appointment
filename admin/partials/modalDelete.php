<?php
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
?>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold d-flex align-items-center" id="deleteModalLabel">
         <svg class="me-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 19.5H16.5V22.5H13.5V19.5ZM13.5 7.5H16.5V16.5H13.5V7.5ZM14.985 0C6.705 0 0 6.72 0 15C0 23.28 6.705 30 14.985 30C23.28 30 30 23.28 30 15C30 6.72 23.28 0 14.985 0ZM15 27C8.37 27 3 21.63 3 15C3 8.37 8.37 3 15 3C21.63 3 27 8.37 27 15C27 21.63 21.63 27 15 27Z" fill="#D22832"/></svg>
         <?= Text::_('COM_APPOINTMENT_MODAL_DELETE_HEADER'); ?>
         <h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= Text::_('COM_APPOINTMENT_MODAL_DELETE_MESSAGE'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light border" data-bs-dismiss="modal"><?= Text::_('COM_APPOINTMENT_MODAL_DELETE_CANCEL'); ?></button>
        <a class="btn btn-danger rounded-2" href="<?php echo Route::_('index.php?option=com_appointment&view=edit'); ?>&delete_bookingtimepageurl=<?= $this->bookingtimepageurl->id ?>"><i class="bi bi-trash3-fill"></i> <?= Text::_('COM_APPOINTMENT_LINK_DELETE'); ?></a>
      </div>
    </div>
  </div>
</div>
