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
//
defined('_JEXEC') or die ('Restricted access');

JHTMLBehavior::modal();
$producthelper = new producthelper();
$option        = JRequest::getVar('option', '', 'request', 'string');
$filter        = JRequest::getVar('filter');
$model         = $this->getModel('giftcard');
?>
<form action="<?php
echo 'index.php?option=' . $option;
?>"
      method="post" name="adminForm" id="adminForm">
    <div id="editcell">
        <!--<table width="100%">
	<tr>
		<td valign="top" align="left" class="key">
			<?php echo JText::_('COM_REDSHOP_USER_FILTER'); ?>:
				<input type="text" name="filter" id="filter" value="<?php echo $filter; ?>" onchange="document.adminForm.submit();">
			<button onclick="this.form.submit();"><?php echo JText::_('COM_REDSHOP_GO'); ?></button>
			<button onclick="document.getElementById('filter').value='';this.form.submit();"><?php echo JText::_('COM_REDSHOP_RESET'); ?></button>
		</td>
	</tr>
</table>
-->
        <table class="adminlist">
            <thead>
            <tr>
                <th width="5%">
                    <?php
                    echo JText::_('COM_REDSHOP_NUM');
                    ?>
                </th>
                <th width="5%"><input type="checkbox" name="toggle" value=""
                                      onclick="checkAll(<?php
                                      echo count($this->giftcard);
                                      ?>);"/></th>
                <th class="title">
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_NAME', 'giftcard_name', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>

                </th>
                <th>
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_IMAGE', 'giftcard_image', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th>
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_BGIMAGE', 'giftcard_bgimage', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th width="5%">
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_PRICE', 'giftcard_price', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th width="5%">
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_VALUE', 'giftcard_value', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th width="5%">
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_GIFTCARD_VALIDITY', 'giftcard_validity', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php
                    echo JHTML::_('grid.sort', 'COM_REDSHOP_PUBLISHED', 'published', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>
                <th width="5%" nowrap="nowrap">
                    <?php
                    echo JHTML::_('grid.sort', 'ID', 'giftcard_id', $this->lists ['order_Dir'], $this->lists ['order']);
                    ?>
                </th>

            </tr>
            </thead>
            <?php
            $k = 0;
            for ($i = 0, $n = count($this->giftcard); $i < $n; $i++)
            {
                $row     = &$this->giftcard [$i];
                $row->id = $row->giftcard_id;
                $link    = JRoute::_('index.php?option=' . $option . '&view=giftcard_detail&task=edit&cid[]=' . $row->giftcard_id);

                $published = JHTML::_('grid.published', $row, $i);

                ?>
                <tr class="<?php echo "row$k";?>">
                    <td align="center">
                        <?php
                        echo $this->pagination->getRowOffset($i);
                        ?>
                    </td>
                    <td align="center">
                        <?php
                        echo JHTML::_('grid.id', $i, $row->id);
                        ?>
                    </td>
                    <td><a href="<?php
                        echo $link;
                        ?>"
                           title="<?php
                               echo JText::_('COM_REDSHOP_EDIT_GIFTCARD');
                               ?>"><?php
                        echo $row->giftcard_name;
                        ?></a>
                    </td>
                    <td>
                        <?php $giftcard_path = 'giftcard/' . $row->giftcard_image;
                        if (is_file(REDSHOP_FRONT_IMAGES_RELPATH . $giftcard_path))
                        {
                            ?>
                            <a class="modal" href="<?php echo REDSHOP_FRONT_IMAGES_ABSPATH . $giftcard_path;?>"
                               title="<?php echo JText::_('COM_REDSHOP_VIEW_IMAGE');?>"
                               rel="{handler: 'image', size: {}}">
                                <?php echo $row->giftcard_image;?></a>
                            <?php }    ?>
                    </td>
                    <td>
                        <?php $giftcard_bgpath = 'giftcard/' . $row->giftcard_bgimage;
                        if (is_file(REDSHOP_FRONT_IMAGES_RELPATH . $giftcard_bgpath))
                        {
                            ?>
                            <a class="modal" href="<?php echo REDSHOP_FRONT_IMAGES_ABSPATH . $giftcard_bgpath;?>"
                               title="<?php echo JText::_('COM_REDSHOP_VIEW_IMAGE');?>"
                               rel="{handler: 'image', size: {}}">
                                <?php echo $row->giftcard_bgimage;?></a>
                            <?php }    ?>
                    </td>
                    <td align="center"><?php echo $producthelper->getProductFormattedPrice($row->giftcard_price);?></td>
                    <td align="center"><?php echo $producthelper->getProductFormattedPrice($row->giftcard_value);?></td>
                    <td align="center"><?php echo $row->giftcard_validity;?></td>
                    <td align="center">
                        <?php
                        echo $published;
                        ?>
                    </td>
                    <td align="center">
                        <?php
                        echo $row->giftcard_id;
                        ?>
                    </td>
                </tr>
                <?php
                $k = 1 - $k;
            }
            ?>

            <tfoot>
            <td colspan="10">
                <?php
                echo $this->pagination->getListFooter();
                ?>
            </td>
            </tfoot>
        </table>
    </div>

    <input type="hidden" name="view" value="giftcard"/> <input
    type="hidden" name="task" value=""/> <input type="hidden"
                                                name="boxchecked" value="0"/> <input type="hidden" name="filter_order"
                                                                                     value="<?php
                                                                                     echo $this->lists ['order'];
                                                                                     ?>"/> <input type="hidden"
                                                                                                  name="filter_order_Dir"
                                                                                                  value="<?php
                                                                                                  echo $this->lists ['order_Dir'];
                                                                                                  ?>"/></form>
