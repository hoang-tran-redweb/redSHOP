<?php
/**
 * @package     redSHOP
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'core' . DS . 'model.php';

class supplierModelsupplier extends RedshopCoreModel
{
    public $_total = null;

    public $_pagination = null;

    public $_context = 'supplier_id';

    public function __construct()
    {
        parent::__construct();

        $app = JFactory::getApplication();

        $limit      = $app->getUserStateFromRequest($this->_context . 'limit', 'limit', $app->getCfg('list_limit'), 0);
        $limitstart = $app->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }

    public function getData()
    {
        if (empty($this->_data))
        {
            $query       = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_data;
    }

    public function getTotal()
    {
        if (empty($this->_total))
        {
            $query        = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    public function getPagination()
    {
        if (empty($this->_pagination))
        {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_pagination;
    }

    public function _buildQuery()
    {
        $orderby = $this->_buildContentOrderBy();
        $query   = " SELECT distinct(s.supplier_id),s.* FROM " . $this->_table_prefix . "supplier s WHERE 1=1" . $orderby;
        return $query;
    }

    public function _buildContentOrderBy()
    {
        $app = JFactory::getApplication();

        $filter_order     = $app->getUserStateFromRequest($this->_context . 'filter_order', 'filter_order', 'supplier_id');
        $filter_order_Dir = $app->getUserStateFromRequest($this->_context . 'filter_order_Dir', 'filter_order_Dir', '');
        $orderby          = ' ORDER BY ' . $filter_order . ' ' . $filter_order_Dir;
        return $orderby;
    }

    public function publish($cid = array(), $publish = 1)
    {
        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'UPDATE ' . $this->_table_prefix . 'supplier' . ' SET published = ' . intval($publish) . ' WHERE supplier_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }

        return true;
    }

    public function copy($cid = array())
    {

        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'SELECT * FROM ' . $this->_table_prefix . 'supplier WHERE supplier_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            $this->_copydata = $this->_db->loadObjectList();
        }
        foreach ($this->_copydata as $cdata)
        {

            $post['supplier_id']    = 0;
            $post['supplier_name']  = 'Copy Of ' . $cdata->supplier_name;
            $post['supplier_desc']  = $cdata->supplier_desc;
            $post['supplier_email'] = $cdata->supplier_email;
            $post['published']      = $cdata->published;

            supplier_detailModelsupplier_detail::store($post);
        }

        return true;
    }

    public function delete($cid = array())
    {
        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'DELETE FROM ' . $this->_table_prefix . 'supplier WHERE supplier_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }

        return true;
    }
}

