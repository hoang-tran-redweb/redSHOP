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

defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'product.php');
$producthelper = new producthelper();

$config = new Redconfiguration();
$option = JRequest::getVar('option', '', 'request', 'string');
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
                           onclick="checkAll(<?php echo count($this->vouchers); ?>);"/>
                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_VOUCHER_CODE', 'amount', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th class="title">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_VOUCHER_AMOUNT', 'amount', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th>
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_VOUCHER_TYPE', 'voucher_type', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>

                <th>
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_VOUCHER_STARTDATE', 'start_date', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>

                <th>
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_VOUCHER_ENDDATE', 'end_date', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_LBL_VOUCHER_LEFT', 'voucher_left', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_ID', 'voucher_id', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>

            </tr>
            </thead>
            <?php

            $k = 0;
            for ($i = 0, $n = count($this->vouchers); $i < $n; $i++)
            {
                $row     = &$this->vouchers[$i];
                $row->id = $row->voucher_id;
                $link    = JRoute::_('index.php?option=' . $option . '&view=voucher_detail&task=edit&cid[]=' . $row->voucher_id);

                $published = JHtml::_('jgrid.published', $row->published, $i, '', 1);
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td align="center">
                        <?php echo $this->pagination->getRowOffset($i); ?>
                    </td>
                    <td align="center">
                        <?php echo JHTML::_('grid.id', $i, $row->id); ?>
                    </td>
                    <td align="center">
                        <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REDSHOP_EDIT_VOUCHER'); ?>">
                            <?php echo $row->voucher_code; ?></a>
                    </td>
                    <td align="center">
                        <?php echo $producthelper->getProductFormattedPrice($row->amount); ?>
                    </td>
                    <td align="center"><?php echo $row->voucher_type; ?></td>
                    <td align="center"><?php echo $config->convertDateFormat($row->start_date); ?></td>
                    <td align="center"><?php echo $config->convertDateFormat($row->end_date); ?></td>
                    <td align="center"><?php echo $row->voucher_left; ?></td>
                    <td align="center"><?php echo $published;?></td>
                    <td align="center"><?php echo $row->voucher_id; ?></td>
                </tr>
                <?php
                $k = 1 - $k;
            }
            ?>

            <tfoot>
            <td colspan="10">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="view" value="voucher"/>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
