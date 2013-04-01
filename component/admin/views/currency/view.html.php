<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class currencyViewcurrency extends JView
{
	public function display($tpl = null)
	{
		$context = 'currency_id';

		$document = JFactory::getDocument();
		$app      = JFactory::getApplication();

		jimport('joomla.html.pagination');

		$document->setTitle(JText::_('COM_REDSHOP_CURRENCY'));

		JToolBarHelper::title(JText::_('COM_REDSHOP_CURRENCY_MANAGEMENT'), 'redshop_currencies_48');
		JToolbarHelper::addNewX();
		JToolbarHelper::EditListX();
		JToolbarHelper::deleteList();
		$uri = JFactory::getURI();

		$filter_order     = $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'currency_id');
		$filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '');

		$lists['order'] = $filter_order;
		$lists['order_Dir'] = $filter_order_Dir;

		$fields = $this->get('Data');
		$total = $this->get('Total');
		$pagination = $this->get('Pagination');

		$this->assignRef('user', JFactory::getUser());
		$this->assignRef('pagination', $pagination);
		$this->assignRef('fields', $fields);
		$this->assignRef('lists', $lists);
		$this->assignRef('request_url', $uri->toString());

		parent::display($tpl);
	}
}
