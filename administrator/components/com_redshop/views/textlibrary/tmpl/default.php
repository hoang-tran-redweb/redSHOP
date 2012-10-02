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

$option = JRequest::getVar('option');
$filter = JRequest::getVar('filter');
?>
<form action="<?php echo 'index.php?option=' . $option; ?>" method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <table class="adminlist">
            <tr>
                <td valign="top" align="right" class="key">
                    <?php echo JText::_('COM_REDSHOP_FILTER'); ?>:
                    <input type="text" name="filter" id="filter" value="<?php echo $filter;?>"
                           onchange="document.adminForm.submit();">

                    <?php echo JText::_('COM_REDSHOP_SECTION'); ?>:

                    <?php echo $this->lists['section']; ?>&nbsp;
                    <button onclick="this.form.submit();"><?php echo JText::_('COM_REDSHOP_GO'); ?></button>
                    &nbsp;
                    <button
                        onclick="this.form.getElementById('section').value='0';this.form.submit();"><?php echo JText::_('COM_REDSHOP_RESET');?></button>

                </td>
            </tr>
        </table>
        <table class="adminlist">
            <thead>
            <tr>
                <th width="5%">
                    <?php echo JText::_('COM_REDSHOP_NUM'); ?>
                </th>
                <th width="5%" class="title">
                    <input type="checkbox" name="toggle" value=""
                           onclick="checkAll(<?php echo count($this->textlibrarys); ?>);"/>
                </th>
                <th class="title" width="30%">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_TAG_NAME', 'text_name', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="50%">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_TEXT_DESCRIPTION', 'text_desc', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="50%">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_SECTION', 'section', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort', 'COM_REDSHOP_ID', 'textlibrary_id', $this->lists['order_Dir'], $this->lists['order']); ?>
                </th>

            </tr>
            </thead>
            <?php
            $k = 0;
            for ($i = 0, $n = count($this->textlibrarys); $i < $n; $i++)
            {
                $row     = &$this->textlibrarys[$i];
                $row->id = $row->textlibrary_id;
                $link    = JRoute::_('index.php?option=' . $option . '&view=textlibrary_detail&task=edit&cid[]=' . $row->textlibrary_id);

                $published = JHtml::_('jgrid.published', $row->published, $i, '', 1);

                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td class="order">
                        <?php echo $this->pagination->getRowOffset($i); ?>
                    </td>
                    <td class="order">
                        <?php echo JHTML::_('grid.id', $i, $row->id); ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"
                           title="<?php echo JText::_('COM_REDSHOP_EDIT_TAG'); ?>">{<?php echo $row->text_name; ?>}</a>
                    </td>
                    <td>
                        <?php echo $row->text_desc; ?>
                    </td>
                    <td>
                        <?php echo $row->section; ?>
                    </td>
                    <td align="center">
                        <?php echo $published;?>
                    </td>
                    <td align="center">
                        <?php echo $row->textlibrary_id; ?>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
            }
            ?>

            <tfoot>
            <td colspan="9">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="view" value="textlibrary"/>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>"/>
</form>
