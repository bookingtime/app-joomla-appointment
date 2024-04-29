<?php
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

if(!isset($action)) {
  $action = 'listing';
}

?>
<!-- Modal -->
<div class="modal fade" id="unsavedFormModal" tabindex="-1" aria-labelledby="unsavedFormModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold d-flex align-items-center" id="unsavedFormModalLabel">
          <svg class="me-2" width="34" height="30" viewBox="0 0 34 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 6.735L28.295 26.25H5.705L17 6.735ZM17 0.75L0.5 29.25H33.5L17 0.75Z" fill="#FAAA0A"/><path d="M18.5 21.75H15.5V24.75H18.5V21.75Z" fill="#FAAA0A"/><path d="M18.5 12.75H15.5V20.25H18.5V12.75Z" fill="#FAAA0A"/></svg>
          <?= Text::_('COM_APPOINTMENT_MODAL_UNSAVEDFORM_HEADER'); ?>
         <h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= Text::_('COM_APPOINTMENT_MODAL_UNSAVEDFORM_MESSAGE'); ?>
      </div>
      <div class="modal-footer">
         <div class="d-flex justify-content-end">
            <a href="<?php echo Route::_('index.php?option=com_appointment&view=' . $action); ?>" class="btn btn-secondary rounded-2 me-3">
               <i class="bi bi-x-lg"></i>
               <?= Text::_('COM_APPOINTMENT_LINK_CANCEL'); ?>
            </a>
            <button id="submit_edit" class="btn btn-success rounded-2" type="submit" name="" value="">
               <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.1667 0.5H2.16667C1.24167 0.5 0.5 1.25 0.5 2.16667V13.8333C0.5 14.75 1.24167 15.5 2.16667 15.5H13.8333C14.75 15.5 15.5 14.75 15.5 13.8333V3.83333L12.1667 0.5ZM8 13.8333C6.61667 13.8333 5.5 12.7167 5.5 11.3333C5.5 9.95 6.61667 8.83333 8 8.83333C9.38333 8.83333 10.5 9.95 10.5 11.3333C10.5 12.7167 9.38333 13.8333 8 13.8333ZM10.5 5.5H2.16667V2.16667H10.5V5.5Z" fill="#ffffff" fill-opacity="0.92"/></svg>
               <?= Text::_('COM_APPOINTMENT_MODAL_UNSAVEDFORM_SUBMIT'); ?>
            </button>
         </div>
      </div>
    </div>
  </div>
</div>
