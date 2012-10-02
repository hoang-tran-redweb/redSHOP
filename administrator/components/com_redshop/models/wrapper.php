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

class wrapperModelwrapper extends RedshopCoreModel
{
    public $_productid = 0;

    public $_total = null;

    public $_pagination = null;

    public $_context = 'wrapper_id';

    public function __construct()
    {
        parent::__construct();

        $app = JFactory::getApplication();

        $limit      = $app->getUserStateFromRequest($this->_context . 'limit', 'limit', $app->getCfg('list_limit'), 0);
        $limitstart = $app->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);

        $product_id       = JRequest::getVar('product_id');
        $this->_productid = (int)$product_id;
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
        $showall = JRequest::getVar('showall', '0');
        $and     = '';
        if ($showall && $this->_productid != 0)
        {
            $and = 'WHERE FIND_IN_SET(' . $this->_productid . ',w.product_id) OR wrapper_use_to_all = 1 ';

            $query = "SELECT * FROM " . $this->_table_prefix . "product_category_xref " . "WHERE product_id = " . $this->_productid;
            $cat   = $this->_getList($query);
            for ($i = 0; $i < count($cat); $i++)
            {
                $and .= " OR FIND_IN_SET(" . $cat[$i]->category_id . ",category_id) ";
            }
        }
        $query = 'SELECT distinct(w.wrapper_id), w.* FROM ' . $this->_table_prefix . 'wrapper AS w ' //				.'LEFT JOIN '.$this->_table_prefix.'product AS p ON p.product_id = w.product_id '
            . $and;
        return $query;
    }

    public function delete($cid = array())
    {
        if (count($cid))
        {
            $cids  = implode(',', $cid);
            $query = 'DELETE FROM ' . $this->_table_prefix . 'wrapper ' . 'WHERE wrapper_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }
        return true;
    }

    /**
     * Method to publish the records
     *
     * @access public
     * @return boolean
     */
    public function publish($cid = array(), $publish = 1)
    {
        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = ' UPDATE ' . $this->_table_prefix . 'wrapper ' . ' SET published = ' . intval($publish) . ' WHERE wrapper_id IN ( ' . $cids . ' )';
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

