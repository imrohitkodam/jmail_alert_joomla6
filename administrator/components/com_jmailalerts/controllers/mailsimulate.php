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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Table\Table;

/**
 * Mail simulate controller class.
 *
 * @package     JMailAlerts
 * @subpackage  com_jmailalerts
 * @since       2.6.1
 */
class JmailalertsControllerMailsimulate extends FormController
{
	/**
	 * Calls the model method to return email address
	 *
	 * @return  void
	 */
	public function simulate()
	{
		// Check for request forgeries
		// Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));

		$input = Factory::getApplication()->input;
		$model = $this->getModel();
		$app = Factory::getApplication();

		// Code to Verify if the given target user ID is registered on the site. Then, check whether the user is subscribed to the Jamil alert. Based on the results, display an appropriate message and display the preview.

		$targetUserId       = $input->get('user_id_box', '', 'INT');
		$preview            = $input->get('prev', '', 'INT');
		$destinationEmailId = ($input->get('send_mail_to_box', '', 'STRING'))? $input->get('send_mail_to_box', '', 'STRING'):Factory::getUser($targetUserId)->get('email');
		Table::addIncludePath(JPATH_ROOT . '/administrator/components/com_jmailalerts/tables');
		$subscriberTable = Table::getInstance('subscriber', 'JmailalertsTable');
		$subscriberTable->load(array('user_id' => $targetUserId, 'state' => 1));
		$messageType = 'success';

		if (Factory::getUser($targetUserId)->guest)
		{
			$msg = 'User Id '. $targetUserId . ' ' .Text::_('COM_JMAILALERTS_USERID_NOT_AVAIL');
		}
		else if (Factory::getUser($targetUserId)->block)
		{
			$msg = 'User Id '. $targetUserId . ' ' .Text::_('COM_JMAILALERTS_USERID_NOT_ENABLED');
		}
		else if (!$subscriberTable->id)
		{
			$msg = 'User Id '. $targetUserId . ' ' .Text::_('COM_JMAILALERTS_USERID_NOT_SUBSCRIBED');
		}
		
		$targetUserId = $input->get('user_id_box', '', 'INT');

		if ($targetUserId == '')
		{
			$msg = Text::_('COM_JMAILALERTS_ENTR_ID');

			$this->setRedirect('index.php?option=com_jmailalerts&view=mailsimulate', $msg);
		}
		else
		{
			$val = $model->simulate();

			if ($val == 1)
			{   
				// Show message with user email id

				$msg = Text::_('COM_JMAILALERTS_MAIL_SENT').$destinationEmailId ;
			}
			elseif ($val == 2)
			{
				$msg = Text::_('COM_JMAILALERTS_NO_MAIL_SENT');
			}
			elseif ($val == 3)
			{
				$msg = Text::_('COM_JMAILALERTS_NO_MAIL_SENT');
			}
			else
			{
				$msg = Text::_('COM_JMAILALERTS_ERROR_SENDING_EMAIL');
				$messageType = 'error';
			}
		}

		if ($preview)
		{
			$app->enqueueMessage($msg);
			
			return false;
		}

		$this->setRedirect('index.php?option=com_jmailalerts&view=mailsimulate', $msg, $messageType);
	}
}
