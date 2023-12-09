<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Quotation
 * @author     Thomas Nguyen <nguyenvuledu@gmail.com>
 * @copyright  2023 Thomas Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Energyquotation\Component\Quotation\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;

/**
 * Properties class.
 *
 * @since  1.0.0
 */
class PropertiesController extends FormController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return  object	The model
	 *
	 * @since   1.0.0
	 */
	public function getModel($name = 'Properties', $prefix = 'Site', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}
}
