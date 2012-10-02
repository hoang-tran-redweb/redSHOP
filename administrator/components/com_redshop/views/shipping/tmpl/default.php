<?php
/**
 * @copyright Copyright (C) 2010 redCOMPONENT.com. All rights reserved.
 * @license   GNU/GPL, see license.txt or http://www.gnu.org/copyleft/gpl.html
 *            Developed by email@recomponent.com - redCOMPONENT.com
 *
 * redSHOP can be downloaded from www.redcomponent.com
 * redSHOP is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.
 *
 * You should have received a copy of the GNU General Public License
 * along with redSHOP; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

$option   = JRequest::getVar('option', '', 'request', 'string');
$ordering = ($this->lists['order'] == 'ordering');
?>
<form action="<?php echo 'index.php?option=' . $option; ?>" method="post" name="adminForm" id="adminForm">
    <div id="editcell">

        <table class="adminlist">
            <thead>
            <tr>
                <th width="5%">
                    <?php echo JText::_('COM_REDSHOP_NUM'); ?>
                </th>
                <th width="5%">
                    <input type="checkbox" name="toggle" value=""
                           onclick="checkAll(<?php echo count($this->shippings); ?>);"/>
                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_SHIPPING_NAME', 'name ', $this->lists['order_Dir'], $this->lists['order']); ?>

                </th>

                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_PLUGIN', 'element ', $this->lists['order_Dir'], $this->lists['order']); ?>

                </th>
                <th class="title">
                    <?php echo JText::_("COM_REDSHOP_VERSION") ?>

                </th>
                <th class="order" width="20%">
                    <?php  echo JHTML::_('grid.sort', 'COM_REDSHOP_ORDERING', 'ordering', $this->lists['order_Dir'], $this->lists['order']); ?>
                    <?php  if ($ordering)
                {
                    echo JHTML::_('grid.order', $this->shippings);
                } ?>
                </th>

                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_ID', 'id', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>

            </tr>
            </thead>
            <?php
            $k = 0;
            for ($i = 0, $n = count($this->shippings); $i < $n; $i++)
            {
                $row  = &$this->shippings[$i];
                $link = JRoute::_('index.php?option=' . $option . '&view=shipping_detail&task=edit&cid[]=' . $row->extension_id);

                $published = JHtml::_('jgrid.published', $row->enabled, $i, '', 1);

                $adminpath = JPATH_ROOT . DS . 'plugins';

                $paymentxml = $adminpath . DS . $row->folder . DS . $row->element . '.xml';

                $xml = JFactory::getXMLParser('Simple');

                //	    $xml = JFactory::getXMLParser('Simple');
                $xml->loadFile($paymentxml);


                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($i); ?>
                    </td>
                    <td align="center">
                        <?php echo JHTML::_('grid.id', $i, $row->extension_id); ?>
                    </td>
                    <td width="50%">
                        <a href="<?php echo $link; ?>"
                           title="<?php echo JText::_('COM_REDSHOP_EDIT_SHIPPING'); ?>"><?php echo $row->name; ?></a>
                    </td>

                    <td align="center">
                        <?php echo $row->element; ?>
                    </td>
                    <td align="center">
                        <?php
                        if (isset($xml->document->version))
                        {
                            echo $xml->document->version[0]->_data;
                        }
                        ?>
                    </td>
                    <td class="order" width="30%">
                        <span><?php echo $this->pagination->orderUpIcon($i, true, 'orderup', 'Move Up', $ordering); ?></span>
                        <span><?php echo $this->pagination->orderDownIcon($i, $n, true, 'orderdown', 'Move Down', $ordering); ?></span>
                        <?php $disabled = $ordering ? '' : 'disabled="disabled"'; ?>
                        <input type="text" name="order[]" size="5"
                               value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area"
                               style="text-align: center"/>
                    </td>
                    <td align="center" width="5%">
                        <?php echo $published;?>
                    </td>
                    <td align="center" width="5%">
                        <?php echo $row->extension_id; ?>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
            }
            ?>

            <tfoot>
            <td colspan="9">
                <?php  echo $this->pagination->getListFooter(); ?>
            </td>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="view" value="shipping"/>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
