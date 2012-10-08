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

class RedshopModelXmlexport extends RedshopCoreModel
{
    public $_total = null;

    public $_pagination = null;

    public $_context = 'xmlexport_id';

    public function __construct()
    {
        parent::__construct();

        $app = JFactory::getApplication();

        $limit      = $app->getUserStateFromRequest($this->_context . 'limit', 'limit', $app->getCfg('list_limit'), 0);
        $limitstart = $app->getUserStateFromRequest($this->_context . 'limitstart', 'limitstart', 0);

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

    public function getProduct()
    {
        $query = "SELECT * FROM " . $this->_table_prefix . "xml_export ";
        $list  = $this->_data = $this->_getList($query);
        return $list;
    }

    public function _buildQuery()
    {
        $orderby = $this->_buildContentOrderBy();

        $query = "SELECT x.* FROM " . $this->_table_prefix . "xml_export AS x " . "WHERE 1=1 " . $orderby;
        return $query;
    }

    public function _buildContentOrderBy()
    {
        $app = JFactory::getApplication();

        $filter_order     = $app->getUserStateFromRequest($this->_context . 'filter_order', 'filter_order', 'xmlexport_date');
        $filter_order_Dir = $app->getUserStateFromRequest($this->_context . 'filter_order_Dir', 'filter_order_Dir', 'DESC');

        $orderby = " ORDER BY " . $filter_order . " " . $filter_order_Dir;
        return $orderby;
    }

    /**
     * Method to delete the records
     *
     * @access public
     * @return boolean
     */
    public function delete($cid = array())
    {
        $xmlhelper = new xmlHelper();
        if (count($cid))
        {
            $cids = implode(',', $cid);

            for ($i = 0; $i < count($cid); $i++)
            {
                $result   = $xmlhelper->getXMLExportInfo($cid[$i]);
                $rootpath = JPATH_COMPONENT_SITE . DS . "assets/xmlfile/export" . DS . $result->filename;
                if (is_file($rootpath))
                {
                    unlink($rootpath);
                }
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'xml_export_log ' . 'WHERE xmlexport_id IN (' . $cids . ')';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'xml_export_ipaddress ' . 'WHERE xmlexport_id IN (' . $cids . ')';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'xml_export ' . 'WHERE xmlexport_id IN (' . $cids . ')';
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

            $query = ' UPDATE ' . $this->_table_prefix . 'xml_export ' . ' SET published = ' . intval($publish) . ' WHERE xmlexport_id IN ( ' . $cids . ' )';
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

