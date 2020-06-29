SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- Table `#__redshop_tax_shoppergroup_xref`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `#__redshop_tax_shoppergroup_xref` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tax_rate_id` INT(11) NOT NULL,
  `shopper_group_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `#__tax_shop_idx2` (`tax_rate_id` ASC, `shopper_group_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'redSHOP Tax Rate Shopper Group Relation';

-- -----------------------------------------------------
-- Table `#__redshop_order_status_log`
-- -----------------------------------------------------
CALL redSHOP_Column_Update('#__redshop_order_status_log', 'by_user_id', 'by_user_id', 'INT(11) NOT NULL AFTER `order_id`');

-- -----------------------------------------------------
-- Table `#__redshop_order_status`
-- -----------------------------------------------------
CALL redSHOP_Column_Update('#__redshop_order_status', 'ordering', 'ordering', 'INT(11) NOT NULL DEFAULT 0 AFTER `published`');

SET FOREIGN_KEY_CHECKS = 1;