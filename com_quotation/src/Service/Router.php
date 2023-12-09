<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Quotation
 * @author     Thomas Nguyen <nguyenvuledu@gmail.com>
 * @copyright  2023 Thomas Nguyen
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Energyquotation\Component\Quotation\Site\Service;

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Factory;
use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Categories\CategoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Menu\AbstractMenu;

/**
 * Class QuotationRouter
 *
 */
class Router extends RouterView
{
	private $noIDs;
	/**
	 * The category factory
	 *
	 * @var    CategoryFactoryInterface
	 *
	 * @since  1.0.0
	 */
	private $categoryFactory;

	/**
	 * The category cache
	 *
	 * @var    array
	 *
	 * @since  1.0.0
	 */
	private $categoryCache = [];

	public function __construct(SiteApplication $app, AbstractMenu $menu, CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
	{
		$params = Factory::getApplication()->getParams('com_quotation');
		$this->noIDs = (bool) $params->get('sef_ids');
		$this->categoryFactory = $categoryFactory;
		
		
			$properties = new RouterViewConfiguration('properties');
			$this->registerView($properties);
			$ccProperty = new RouterViewConfiguration('property');
			$ccProperty->setKey('id')->setParent($properties);
			$this->registerView($ccProperty);
			$propertyform = new RouterViewConfiguration('propertyform');
			$propertyform->setKey('id');
			$this->registerView($propertyform);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));
	}


	
		/**
		 * Method to get the segment(s) for an property
		 *
		 * @param   string  $id     ID of the property to retrieve the segments for
		 * @param   array   $query  The request that is built right now
		 *
		 * @return  array|string  The segments of this item
		 */
		public function getPropertySegment($id, $query)
		{
			return array((int) $id => $id);
		}
			/**
			 * Method to get the segment(s) for an propertyform
			 *
			 * @param   string  $id     ID of the propertyform to retrieve the segments for
			 * @param   array   $query  The request that is built right now
			 *
			 * @return  array|string  The segments of this item
			 */
			public function getPropertyformSegment($id, $query)
			{
				return $this->getPropertySegment($id, $query);
			}

	
		/**
		 * Method to get the segment(s) for an property
		 *
		 * @param   string  $segment  Segment of the property to retrieve the ID for
		 * @param   array   $query    The request that is parsed right now
		 *
		 * @return  mixed   The id of this item or false
		 */
		public function getPropertyId($segment, $query)
		{
			return (int) $segment;
		}
			/**
			 * Method to get the segment(s) for an propertyform
			 *
			 * @param   string  $segment  Segment of the propertyform to retrieve the ID for
			 * @param   array   $query    The request that is parsed right now
			 *
			 * @return  mixed   The id of this item or false
			 */
			public function getPropertyformId($segment, $query)
			{
				return $this->getPropertyId($segment, $query);
			}

	/**
	 * Method to get categories from cache
	 *
	 * @param   array  $options   The options for retrieving categories
	 *
	 * @return  CategoryInterface  The object containing categories
	 *
	 * @since   1.0.0
	 */
	private function getCategories(array $options = []): CategoryInterface
	{
		$key = serialize($options);

		if (!isset($this->categoryCache[$key]))
		{
			$this->categoryCache[$key] = $this->categoryFactory->createCategory($options);
		}

		return $this->categoryCache[$key];
	}
}
