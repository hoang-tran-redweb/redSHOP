<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2008 - 2019 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * View Tax Rates
 *
 * @package     RedSHOP.Backend
 * @subpackage  View
 * @since       2.0.0.6
 */
class RedshopViewTax_Rates extends RedshopViewList
{
    /**
     * Column for render published state.
     *
     * @var    array
     * @since  2.0.6
     */
    protected $stateColumns = array();

    /**
     * Method for render 'Published' column
     *
     * @param   array   $config  Row config.
     * @param   int     $index   Row index.
     * @param   object  $row     Row data.
     *
     * @return  string
     *
     * @since   2.0.6
     */
    public function onRenderColumn($config, $index, $row)
    {
	    $taxShopperGroup = JFactory::getApplication()->input->post->get('shopper_group', array(), 'array');
	    $model  = $this->getModel('tax_rates');

	    if (!empty($taxShopperGroup)) {
		    $shoppTax = $taxShopperGroup;
	    } else {
		    $shoppTax = $model::getShopperTax($row->id);
	    }

	    $shoppTax = implode("<br/>", $shoppTax);

	    switch ($config['dataCol']) {
		    case 'tax_group_id':
			    return '<a href="index.php?option=com_redshop&task=tax_group.edit&id=' . $row->id . '">'
				    . $row->tax_group_name . '</a>';

		    case 'shopper_group':
			    return $shoppTax;

		    case 'tax_country':
			    return $row->country_name;

		    case 'tax_state':
			    return $row->state_name;

		    case 'tax_rate':
			    return number_format(
                        $row->tax_rate * 100,
					    2,
					    Redshop::getConfig()->get('PRICE_SEPERATOR'),
					    Redshop::getConfig()->get('THOUSAND_SEPERATOR')
				    ) . ' %';

		    default:
			    return parent::onRenderColumn($config, $index, $row);
	    }
    }
}
