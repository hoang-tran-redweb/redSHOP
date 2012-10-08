<?php
/**
 * @package     redSHOP
 * @subpackage  Views
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

class RedshopViewRating_detail extends JViewLegacy
{
    public function display($tpl = null)
    {
        $option    = JRequest::getVar('option');
        $userslist = JRequest::getVar('userslist');

        JToolBarHelper::title(JText::_('COM_REDSHOP_RATING_MANAGEMENT_DETAIL'), 'redshop_rating48');

        $document = JFactory::getDocument();

        $document->addStyleSheet('components/' . $option . '/assets/css/search.css');

        $document->addScript('components/' . $option . '/assets/js/search.js');

        $uri = JFactory::getURI();

        $this->setLayout('default');

        $lists = array();

        $detail = $this->get('data');

        $isNew = ($detail->rating_id < 1);

        $text = $isNew ? JText::_('COM_REDSHOP_NEW') : JText::_('COM_REDSHOP_EDIT');

        JToolBarHelper::title(JText::_('COM_REDSHOP_RATING') . ': <small><small>[ ' . $text . ' ]</small></small>', 'redshop_rating48');

        JToolBarHelper::save();

        if ($isNew)
        {
            JToolBarHelper::cancel();
        }
        else
        {

            JToolBarHelper::cancel('cancel', 'Close');
        }

        $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $detail->published);
        $lists['favoured']  = JHTML::_('select.booleanlist', 'favoured', 'class="inputbox"', $detail->favoured);

        $lists['userslist'] = JHTML::_('select.genericlist', $userslist, 'userid', 'class="inputbox" size="1" ', 'value', 'text', $detail->userid);

        $this->assignRef('lists', $lists);
        $this->assignRef('detail', $detail);
        $this->request_url = $uri->toString();

        parent::display($tpl);
    }
}
