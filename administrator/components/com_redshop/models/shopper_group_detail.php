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
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'core' . DS . 'model' . DS . 'detail.php';

class shopper_group_detailModelshopper_group_detail extends RedshopCoreModelDetail
{
    public function &getData()
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

    public function _loadData()
    {
        if (empty($this->_data))
        {
            $shoppergroup_id = NEW_SHOPPER_GROUP_GET_VALUE_FROM;
            if ($shoppergroup_id <= 0)
            {
                return false;
            }
            if ($this->_id)
            {
                $shoppergroup_id = $this->_id;
            }

            if ($shoppergroup_id <= 0)
            {
                return false;
            }

            $query = 'SELECT * FROM ' . $this->_table_prefix . 'shopper_group ' . 'WHERE shopper_group_id = "' . $shoppergroup_id . '" ';
            $this->_db->setQuery($query);
            $this->_data                   = $this->_db->loadObject();
            $this->_data->shopper_group_id = $this->_id;
            return (boolean)$this->_data;
        }
        return true;
    }

    public function _initData()
    {
        if (empty($this->_data))
        {
            $detail                              = new stdClass();
            $detail->shopper_group_id            = 0;
            $detail->shopper_group_name          = null;
            $detail->shopper_group_customer_type = 0;
            $detail->shopper_group_portal        = 0;
            $detail->shopper_group_categories    = null;
            $detail->shopper_group_url           = null;
            $detail->shopper_group_logo          = null;
            $detail->shopper_group_introtext     = null;
            $detail->shopper_group_desc          = null;
            $detail->parent_id                   = null;
            $detail->default_shipping            = 0;
            $detail->default_shipping_rate       = null;
            //			$detail->tax_exempt_on_shipping			= 0;
            $detail->published                          = 1;
            $detail->shopper_group_cart_checkout_itemid = 0;
            $detail->tax_group_id                       = 0;
            //			$detail->tax_exempt						= 0;
            $detail->show_price_without_vat       = 0;
            $detail->shopper_group_cart_itemid    = 0;
            $detail->shopper_group_quotation_mode = 0;
            $detail->use_as_catalog               = 0;
            $detail->show_price                   = 0;
            $this->_data                          = $detail;

            return (boolean)$this->_data;
        }

        return true;
    }

    public function store($data)
    {
        $logo = JRequest::getVar('shopper_group_logo', '', 'files', '');

        if ($logo['name'] != "" || $data['shopper_group_logo_tmp'] != null)
        {
            $logopath = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $data['shopper_group_logo']; //specific path of the file
            if (is_file($logopath))
            {
                unlink($logopath);
            }
        }
        if ($logo['name'] != "")
        {
            $logoname = JPath::clean(time() . '_' . $logo['name']); //Make the filename unique
            // Image Upload
            $logotype = JFile::getExt($logo['name']); //Get extension of the file

            $src  = $logo['tmp_name'];
            $dest = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $logoname; //specific path of the file

            if ($logotype == 'jpg' || $logotype == 'jpeg' || $logotype == 'gif' || $logotype == 'png')
            {
                JFile::upload($src, $dest);
                $data['shopper_group_logo'] = $logoname;
            }
        }
        else
        {
            if ($data['shopper_group_logo_tmp'] != null)
            {
                $image_split                = preg_split('/', $data['shopper_group_logo_tmp']);
                $logoname                   = JPath::clean(time() . '_' . $image_split[count($image_split) - 1]); //Make the filename unique
                $data['shopper_group_logo'] = $logoname;

                // Image copy
                $src  = JPATH_ROOT . DS . $data['shopper_group_logo_tmp'];
                $dest = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $logoname;

                copy($src, $dest);
                // End Image Upload
            }
        }

        $isNew = false;
        if (!$data['shopper_group_id'] && NEW_SHOPPER_GROUP_GET_VALUE_FROM)
        {
            $isNew        = true;
            $destname     = time() . $data['shopper_group_logo'];
            $logopath     = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $data['shopper_group_logo'];
            $copylogopath = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $destname;
            if (is_file($logopath))
            {
                copy($logopath, $copylogopath);
            }
            $data['shopper_group_logo'] = $destname;
        }

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

        if ($isNew && NEW_SHOPPER_GROUP_GET_VALUE_FROM)
        {
            $query = 'SELECT * FROM ' . $this->_table_prefix . 'product_price ' . 'WHERE shopper_group_id="' . NEW_SHOPPER_GROUP_GET_VALUE_FROM . '" ';
            $this->_db->setQuery($query);
            $product_price = $this->_db->loadObjectlist();

            for ($i = 0; $i < count($product_price); $i++)
            {
                $product_data                     = (array)$product_price[$i];
                $product_data['price_id']         = 0;
                $product_data['shopper_group_id'] = $row->shopper_group_id;
                $product_data['cdate']            = date("Y-m-d");

                $prdrow = JTable::getInstance('prices_detail', 'Table');
                if (!$prdrow->bind($product_data))
                {
                    $this->setError($this->_db->getErrorMsg());
                    //					return false;
                }
                if (!$prdrow->store())
                {
                    $this->setError($this->_db->getErrorMsg());
                    //					return false;
                }
            }

            $query = 'SELECT * FROM ' . $this->_table_prefix . 'product_attribute_price ' . 'WHERE shopper_group_id="' . NEW_SHOPPER_GROUP_GET_VALUE_FROM . '" ';
            $this->_db->setQuery($query);
            $attribute_price = $this->_db->loadObjectlist();

            for ($i = 0; $i < count($attribute_price); $i++)
            {
                $attribute_data                     = (array)$attribute_price[$i];
                $attribute_data['price_id']         = 0;
                $attribute_data['shopper_group_id'] = $row->shopper_group_id;
                $attribute_data['cdate']            = time();

                $attrow = JTable::getInstance('attributeprices_detail', 'Table');
                if (!$attrow->bind($attribute_data))
                {
                    $this->setError($this->_db->getErrorMsg());
                    //					return false;
                }
                if (!$attrow->store())
                {
                    $this->setError($this->_db->getErrorMsg());
                    //					return false;
                }
            }
        }
        return $row;
    }

    public function delete($cid = array())
    {
        if (count($cid))
        {
            $cids = implode(',', $cid);

            $query = 'SELECT * FROM ' . $this->_table_prefix . 'shopper_group ' . 'WHERE shopper_group_id IN (' . $cids . ') ';
            $this->_db->setQuery($query);
            $list = $this->_db->loadObjectlist();
            for ($i = 0; $i < count($list); $i++)
            {
                $logopath = REDSHOP_FRONT_IMAGES_RELPATH . 'shopperlogo' . DS . $list[$i]->shopper_group_logo;
                if (is_file($logopath))
                {
                    unlink($logopath);
                }
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'product_price WHERE shopper_group_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'product_attribute_price WHERE shopper_group_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }

            $query = 'DELETE FROM ' . $this->_table_prefix . 'shopper_group WHERE shopper_group_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }

        return true;
    }

    public function publish($cid = array(), $publish = 1)
    {
        if (count($cid))
        {
            $cids  = implode(',', $cid);
            $query = 'UPDATE ' . $this->_table_prefix . 'shopper_group ' . 'SET published = ' . intval($publish) . ' WHERE shopper_group_id IN ( ' . $cids . ' )';
            $this->_db->setQuery($query);
            if (!$this->_db->query())
            {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
        }
        return true;
    }

    public function getVatGroup()
    {
        $query = "SELECT tg.tax_group_name as text, tg.tax_group_id as value FROM `" . $this->_table_prefix . "tax_group` as tg WHERE `published` = 1 ";
        $this->_db->setQuery($query);
        return $this->_db->loadObjectList();
    }

    public function getmanufacturers()
    {
        $query = 'SELECT manufacturer_id as value,manufacturer_name as text FROM ' . $this->_table_prefix . 'manufacturer  WHERE published=1 ORDER BY `manufacturer_name`';
        $this->_db->setQuery($query);
        return $this->_db->loadObjectlist();
    }
}
