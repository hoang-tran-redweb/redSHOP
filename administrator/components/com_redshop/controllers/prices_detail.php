<?php
/**
 * @package     redSHOP
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'core' . DS . 'controller.php';

class RedshopControllerPrices_detail extends RedshopCoreController
{
    public function __construct($default = array())
    {
        parent::__construct($default);
        $this->registerTask('add', 'edit');

        // Set the redirection.
        $product_id             = $this->input->get('product_id');
        $this->redirectViewName = 'prices&product_id=' . $product_id;
    }

    public function save($apply = 0)
    {
        $post                 = $this->input->getArray($_POST);
        $option               = $this->input->get('option');
        $product_id           = $this->input->get('product_id');
        $price_quantity_start = $this->input->get('price_quantity_start');
        $price_quantity_end   = $this->input->get('price_quantity_end');

        $post['product_currency'] = CURRENCY_CODE;
        $post['cdate']            = time(); //date("Y-m-d");

        $cid               = $this->input->post->get('cid', array(0), 'array');
        $post ['price_id'] = $cid [0];

        $post['discount_start_date'] = strtotime($post ['discount_start_date']);

        if ($post['discount_end_date'])
        {
            $post ['discount_end_date'] = strtotime($post['discount_end_date']) + (23 * 59 * 59);
        }

        $model = $this->getModel('prices_detail');

        if ($price_quantity_start == 0 && $price_quantity_end == 0)
        {
            if ($model->store($post))
            {
                $msg = JText::_('COM_REDSHOP_PRICE_DETAIL_SAVED');
            }
            else
            {
                $msg = JText::_('COM_REDSHOP_ERROR_SAVING_PRICE_DETAIL');
            }
        }
        else
        {
            if ($price_quantity_start < $price_quantity_end)
            {
                if ($model->store($post))
                {
                    $msg = JText::_('COM_REDSHOP_PRICE_DETAIL_SAVED');
                }
                else
                {
                    $msg = JText::_('COM_REDSHOP_ERROR_SAVING_PRICE_DETAIL');
                }
            }
            else
            {
                $msg = JText::_('COM_REDSHOP_ERROR_SAVING_PRICE_QUNTITY_DETAIL');
            }
        }
        $this->setRedirect('index.php?option=' . $option . '&view=prices&product_id=' . $product_id, $msg);
    }
}
