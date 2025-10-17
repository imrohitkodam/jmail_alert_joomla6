<?php
/**
 * @package     JMailAlerts
 * @subpackage  com_jmailalerts
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2024 Techjoomla. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Do not allow direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');
HTMLHelper::_('behavior.modal', 'a.modal');
?>

<script>
	jQuery(document).ready(function()
	{
		ShowHidemailbox()
	});
	
	function validate_form(){
		// Chek if alert, userid and the email address is entered
		if(document.getElementById('user_id_box').value == '') {
			alert("<?php echo Text::_('COM_JMAILALERTS_SIMULATE_VALIDATION_MSG'); ?>");
			return 0;
		}
		else {
			return 1;
		}
	}

	function submit_this_form(adminForm){
		adminForm.submit();
	}

	function previewMail()
	{
		let simulationLink= "<?php echo Uri::base() . 'index.php?option=com_jmailalerts&task=mailsimulate.simulate&tmpl=component&send_mail_to_box=admin@admin.com&flag=1&user_id_box='; ?>"
		let userid = document.getElementById('user_id_box').value;
		let sdate  = document.getElementById('select_date_box').value;
		let prev  = '1';

		let alertname  = document.getElementById('altypename').value;
		simulationLink = simulationLink + userid + "&prev=" + prev + "&altypename=" + alertname;
		document.getElementById('linkforsimulate').setAttribute('href', simulationLink);
	}

	function ShowHidemailbox() {
		var status;
		status=jQuery('input:radio[name=\"show_mail_to_box\"]:checked').val();

		if (status == 1) {
			
			jQuery('.send_mail_to_box_div').show();
		}
		else {
			
			jQuery('.send_mail_to_box_div').hide();
		}
	}
</script>

<div class="<?php echo JMAILALERTS_WRAPPER_CLASS; ?>" id="jmailalerts-mailsimulate">
	<form action="<?php echo Route::_('index.php?option=com_jmailalerts&view=mailsimulate'); ?>"
		method="POST"
		name="adminForm"
		ENCTYPE="multipart/form-data"
		id="adminForm"
		class="form-horizontal">
		<?php
		if (!empty($this->sidebar))
		{
			?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>

		<div id="j-main-container" class="span10">
			<?php
		}
		else
		{
			?>
		<div id="j-main-container">
			<?php
		}
		?>
			<div class="control-group">
				<div class="control-label">
					<label for="altypename"><?php echo Text::_("COM_JMAILALERTS_SELECT_ATYPE"); ?></label>
				</div>
				<div class="controls"><?php echo $this->alertname; ?></div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<label for="user_id_box"><?php echo Text::_("COM_JMAILALERTS_USER_ID"); ?></label>
				</div>
				<div class="controls">
					<input type="text" width="20" size="20" maxlength="20" value="" name = "user_id_box" id="user_id_box" />
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<label for="send_mail_to_box"><?php echo Text::_("COM_JMAILALERTS_SEND_MAIL_TO_ADMIN"); ?></label>
				</div>
			
				<div class="controls ">
						<label class="radio inline">
							<input type="radio" class="btn-group" name="show_mail_to_box" id="show_mail_to_box1" value="1" onclick="ShowHidemailbox()"/>
							<?php echo Text::_('COM_JMAILALERTS_YES'); ?>
						</label>
						<label class="radio inline">
							<input type="radio" class="btn-group" name="show_mail_to_box" id="show_mail_to_box2" value="0" checked="checked" onclick="ShowHidemailbox()"/>
								<?php echo Text::_('COM_JMAILALERTS_NO'); ?>
						</label>
					</div>
			</div>

			<div class="control-group send_mail_to_box_div">
				<div class="control-label">
					<label for="send_mail_to_box"><?php echo Text::_("COM_JMAILALERTS_SEND_MAIL_TO"); ?></label>
				</div>
				<div class="controls">
					<input type="text" width="20" size="20" maxlength="40" value="" name = "send_mail_to_box" id="send_mail_to_box" />
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo Text::_(''); ?>
					<label for="select_date_box"><?php echo Text::_("COM_JMAILALERTS_SELECT_DATE"); ?></label>
				</div>
				<div class="controls">
					<?php echo HTMLHelper::_(
						'calendar', date(''), 'select_date_box', 'select_date_box',
						'%Y-%m-%d ',
						array('class' => 'inputbox', 'size' => '20', 'maxlength' => '19', 'name' => 'select_date_box', 'id' => 'select_date_box')
					); ?>
				</div>
			</div>

			<div>
				<button type="button" class="btn btn-large btn-success" id="simulate_button"
					onclick=" if(validate_form()) { submit_this_form(this.form); }">
						<?php echo Text::_('COM_JMAILALERTS_SIMULATE'); ?>
				</button>
				&nbsp;&nbsp;&nbsp;
				<a id ="linkforsimulate"
					rel="{handler: 'iframe', size: {x:700, y: 600}}"
					onclick ="previewMail();"
					href= "<?php echo Uri::base(); ?>"
					class='modal'>
				<input id="previewBtn" class="btn btn-large btn-info validate" type="button" value="<?php echo Text::_('COM_JMAILALERTS_PREVIEW'); ?>">
				</a>
			</div>

			<input type="hidden" name="task" value="mailsimulate.simulate" />
		</div>
	</form>
</div>
