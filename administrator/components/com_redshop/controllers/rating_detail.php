<?php
/**
 * @package     redSHOP
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die ('Restricted access');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'core' . DS . 'controller.php';

class RedshopControllerRating_detail extends RedshopCoreController
{
    public $redirectViewName = 'rating';

    public function __construct($default = array())
    {
        parent::__construct($default);
        $this->registerTask('add', 'edit');
    }

    public function edit()
    {
        $this->input->set('view', 'rating_detail');
        $this->input->set('layout', 'default');
        $this->input->set('hidemainmenu', 1);

        $model     = $this->getModel('rating_detail');
        $userslist = $model->getuserslist();
        $this->input->set('userslist', $userslist);

        $product = $model->getproducts();
        $this->input->set('product', $product);

        parent::display();
    }

    public function save($apply = 0)
    {
        $post            = $this->input->getArray($_POST);
        $comment         = $this->input->post->getString('comment', '');
        $post["comment"] = $comment;

        $option = $this->input->get('option');
        $cid    = $this->input->post->get('cid', array(0), 'array');

        $post ['rating_id'] = $cid [0];

        $model = $this->getModel('rating_detail');

        if ($model->store($post))
        {

            $msg = JText::_('COM_REDSHOP_RATING_DETAIL_SAVED');
        }
        else
        {

            $msg = JText::_('COM_REDSHOP_ERROR_SAVING_RATING_DETAIL');
        }

        $this->setRedirect('index.php?option=' . $option . '&view=rating', $msg);
    }

    public function fv_publish()
    {
        $option = $this->input->get('option');

        $cid = $this->input->post->get('cid', array(0), 'array');

        if (!is_array($cid) || count($cid) < 1)
        {
            throw new RuntimeException(JText::_('COM_REDSHOP_SELECT_AN_ITEM_TO_PUBLISH'));
        }

        $model = $this->getModel('rating_detail');

        if (!$model->favoured($cid, 1))
        {
            echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
        }

        $msg = JText::_('COM_REDSHOP_RATING_DETAIL_PUBLISHED_SUCCESFULLY');
        $this->setRedirect('index.php?option=' . $option . '&view=rating', $msg);
    }

    public function fv_unpublish()
    {
        $option = $this->input->get('option');
        $cid    = $this->input->post->get('cid', array(0), 'array');

        if (!is_array($cid) || count($cid) < 1)
        {
            throw new RuntimeException(JText::_('COM_REDSHOP_SELECT_AN_ITEM_TO_UNPUBLISH'));
        }

        $model = $this->getModel('rating_detail');

        if (!$model->favoured($cid, 0))
        {
            echo "<script> alert('" . $model->getError(true) . "'); window.history.go(-1); </script>\n";
        }

        $msg = JText::_('COM_REDSHOP_RATING_DETAIL_UNPUBLISHED_SUCCESFULLY');
        $this->setRedirect('index.php?option=' . $option . '&view=rating', $msg);
    }
}
