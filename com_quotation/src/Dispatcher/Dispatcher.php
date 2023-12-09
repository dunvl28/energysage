<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Quotation
 * @author     Thomas Nguyen <nguyenvuledu@gmail.com>
 * @copyright  2023 Thomas Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Energyquotation\Component\Quotation\Site\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Language\Text;

/**
 * ComponentDispatcher class for Com_Quotation
 *
 * @since  1.0.0
 */
class Dispatcher extends ComponentDispatcher
{
	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function dispatch()
	{
		parent::dispatch();
	}
}
