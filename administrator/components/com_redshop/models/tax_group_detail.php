<?php
/**
 * @package     redSHOP
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

require_once(JPATH_COMPONENT . DS . 'helpers' . DS . 'thumbnail.php');
jimport('joomla.client.helper');
JClientHelper::setCredentialsFromRequest('ftp');

class tax_group_detailModeltax_group_detail extends JModelLegacy
{
    public $_id = null;

    public $_data = null;

    public $_table_prefix = null;

    function __construct()
    {
        parent::__construct();

        $this->_table_prefix = '#__' . TABLE_PREFIX . '_';

        $array = JRequest::getVar('cid', 0, '', 'array');

        $this->setId((int)$array[0]);
    }

    function setId($id)
    {
        $this->_id   = $id;
        $this->_data = null;
    }

    function &getData()
    {
        if ($this->_loadData())
        {
        }
        else
        {
            $this->_initData();
        }

        return $this->_data;
    }

    function _loadData()
    {
        if (empty($this->_data))
        {
            $query = 'SELECT * FROM ' . $this->_table_prefix . 'tax_group WHERE tax_group_id = ' . $this->_id;
            $this->_db->setQuery($query);
            $this->_data = $this->_db->loadObject();
            return (boolean)$this->_data;
        }
        return true;
    }

    function _initData()
    {
        if (empty($this->_data))
        {
            $detail                 = new stdClass();
            $detail->tax_group_id   = 0;
            $detail->tax_group_name = null;
            $detail->published      = 0;
            $detail->tax_rate       = null;

            $this->_data = $detail;

            return (boolean)$this->_data;
        }

        return true;
    }

    function store($data)
    {

        $row = $this->getTable();

        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }

    function delete($cid = array())
    {
        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'DELETE FROM ' . $this->_table_prefix . 'tax_group WHERE tax_group_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }

        return true;
    }

    function publish($cid = array(), $publish = 1)
    {

        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'UPDATE ' . $this->_table_prefix . 'tax_group' . ' SET published = ' . intval($publish) . ' WHERE tax_group_id IN ( ' . $cids . ' )';

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
