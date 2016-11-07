<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2008 - 2016 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * Statistic Product view
 *
 * @package     RedSHOP.Backend
 * @subpackage  View
 * @since       2.0.0.2
 */
class RedshopViewStatistic_Product extends RedshopViewAdmin
{
	/**
	 * Display the Statistic Customer view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		global $context;

		$uri      = JFactory::getURI();
		$app      = JFactory::getApplication();
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_REDSHOP_STATISTIC_PRODUCT'));
		$document->addStyleSheet('components/com_redshop/assets/css/daterangepicker.css');
		$document->addScript('components/com_redshop/assets/js/moment.min.js');
		$document->addScript('components/com_redshop/assets/js/daterangepicker.js');

		$this->products        = $this->get('Products');
		$this->filterStartDate = $app->input->getString('filter_start_date', '');
		$this->filterEndDate   = $app->input->getString('filter_end_date', '');
		$this->filterDateLabel = $app->input->getString('filter_date_label', '');

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		$title           = JText::_('COM_REDSHOP_STATISTIC_PRODUCT');
		JFactory::getApplication()->input->set('hidemainmenu', true);
		JToolBarHelper::title(JText::_('COM_REDSHOP_STATISTIC_PRODUCT') . " :: " . $title, 'statistic redshop_statistic48');

		RedshopToolbarHelper::custom(
			'exportProduct',
			'save.png',
			'save_f2.png',
			'COM_REDSHOP_EXPORT_DATA_LBL',
			false
		);
		RedshopToolbarHelper::link(
			'index.php?tmpl=component&option=com_redshop&view=statistic_product',
			'print',
			'COM_REDSHOP_PRINT',
			'_blank'
		);
	}
}
