<?php
/**
 * @package     RedSHOP.Backend
 * @subpackage  Helper
 *
 * @copyright   Copyright (C) 2008 - 2016 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

jimport('joomla.filesystem.file');

class economic
{
	public $_table_prefix = null;

	public $_db = null;

	public $_producthelper = null;

	public $_shippinghelper = null;

	public $_order_functions = null;

	public $_stockroomhelper = null;

	public $_dispatcher = null;

	protected static $instance = null;

	/**
	 * Returns the economic object, only creating it
	 * if it doesn't already exist.
	 *
	 * @return  economic  The economic object
	 *
	 * @since   1.6
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new static;
		}

		return self::$instance;
	}

	public function __construct()
	{
		$db                     = JFactory::getDbo();
		$this->_table_prefix    = '#__redshop_';
		$this->_db              = $db;
		$this->_producthelper   = productHelper::getInstance();
		$this->_shippinghelper  = shipping::getInstance();
		$this->_redhelper       = redhelper::getInstance();
		$this->_order_functions = order_functions::getInstance();
		$this->_stockroomhelper = rsstockroomhelper::getInstance();

		JPluginHelper::importPlugin('economic');
		$this->_dispatcher = JDispatcher::getInstance();
	}

	/**
	 * Create an user in E-conomic
	 *
	 * @param   array  $row   Data to create user
	 * @param   array  $data  Data of Economic
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createUserInEconomic() instead
	 */
	public function createUserInEconomic($row = array(), $data = array())
	{
		return RedshopEconomic::createUserInEconomic($row, $data);
	}

	/**
	 * Create Product Group in E-conomic
	 *
	 * @param   array    $row         Data to create
	 * @param   integer  $isShipping  Shipping flag
	 * @param   integer  $isDiscount  Discount flag
	 * @param   integer  $isvat       VAT flag
	 *
	 * @return  null/array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createProductGroupInEconomic() instead
	 */
	public function createProductGroupInEconomic($row = array(), $isShipping = 0, $isDiscount = 0, $isvat = 0)
	{
		return RedshopEconomic::createProductGroupInEconomic($row, $isShipping, $isDiscount, $isvat);
	}

	/**
	 * Create product in E-conomic
	 *
	 * @param   array  $row  Data to create
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createProductInEconomic() instead
	 */
	public function createProductInEconomic($row = array())
	{
		return RedshopEconomic::createProductInEconomic($row);
	}

	/**
	 * Get Total Property
	 *
	 * @param   integer  $productId  Product ID
	 *
	 * @return  integer
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::getTotalProperty() instead
	 */
	public function getTotalProperty($productId)
	{
		return RedshopEconomic::getTotalProperty($productId);
	}

	/**
	 * Create property product in economic
	 *
	 * @param   array  $prdrow  Product data
	 * @param   array  $row     Data property
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createPropertyInEconomic() instead
	 */
	public function createPropertyInEconomic($prdrow = array(), $row = array())
	{
		return RedshopEconomic::createPropertyInEconomic($prdrow, $row);
	}

	/**
	 * Create Sub Property in Economic
	 *
	 * @param   array  $prdrow  Product info
	 * @param   array  $row     Data of property
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createSubpropertyInEconomic() instead
	 */
	public function createSubpropertyInEconomic($prdrow = array(), $row = array())
	{
		return RedshopEconomic::createSubpropertyInEconomic($prdrow, $row);
	}

	/**
	 * Import Stock from Economic
	 *
	 * @param   array  $prdrow  Product Info
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::importStockFromEconomic() instead
	 */
	public function importStockFromEconomic($prdrow = array())
	{
		return RedshopEconomic::importStockFromEconomic($prdrow);
	}

	/**
	 * Create Shipping rate in economic
	 *
	 * @param   integer  $shipping_number  Shipping Number
	 * @param   string   $shipping_name    Shipping Name
	 * @param   integer  $shipping_rate    Shipping Rate
	 * @param   integer  $isvat            VAT flag
	 *
	 * @return  array
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::createShippingRateInEconomic() instead
	 */
	public function createShippingRateInEconomic($shipping_number, $shipping_name, $shipping_rate = 0, $isvat = 1)
	{
		return RedshopEconomic::createShippingRateInEconomic($shipping_number, $shipping_name, $shipping_rate, $isvat);
	}

	/**
	 * Get Max User Number in E-conomic
	 *
	 * @return  integer
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::getMaxDebtorInEconomic() instead
	 */
	public function getMaxDebtorInEconomic()
	{
		return RedshopEconomic::getMaxDebtorInEconomic();
	}

	/**
	 * Get Max Order Number in Economic
	 *
	 * @return  integer
	 *
	 * @deprecated  __DEPLOY_VERSION__ Use RedshopEconomic::getMaxOrderNumberInEconomic() instead
	 */
	public function getMaxOrderNumberInEconomic()
	{
		return RedshopEconomic::getMaxOrderNumberInEconomic();
	}

	/**
	 * Method to create Invoice and send mail in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function createInvoiceInEconomic($order_id, $data = array())
	{
		$orderdetail = $this->_order_functions->getOrderDetails($order_id);

		if ($orderdetail->is_booked == 0 && !$orderdetail->invoice_no)
		{
			$user_billinginfo  = RedshopHelperOrder::getOrderBillingUserInfo($order_id);
			$user_shippinginfo = RedshopHelperOrder::getOrderShippingUserInfo($order_id);
			$orderitem         = $this->_order_functions->getOrderItemDetail($order_id);

			$eco['shop_name']                 = Redshop::getConfig()->get('SHOP_NAME');
			$eco['economic_payment_terms_id'] = $data['economic_payment_terms_id'];
			$eco['economic_design_layout']    = $data['economic_design_layout'];

			$ecodebtorNumber = $this->createUserInEconomic($user_billinginfo, $data);

			if (count($ecodebtorNumber) > 0 && is_object($ecodebtorNumber[0]))
			{
				$eco['order_id']   = $orderdetail->order_id;
				$eco['setAttname'] = 0;

				if ($user_billinginfo->is_company == 1)
				{
					$eco['setAttname'] = 1;
				}

				$eco['name'] = $user_billinginfo->firstname . " " . $user_billinginfo->lastname;

				$eco['isvat']              = ($orderdetail->order_tax != 0) ? 1 : 0;
				$currency                  = Redshop::getConfig()->get('CURRENCY_CODE');
				$eco['email']              = $user_billinginfo->user_email;
				$eco['phone']              = $user_billinginfo->phone;
				$eco['currency_code']      = $currency;
				$eco['order_number']       = $orderdetail->order_number;
				$eco['amount']             = $orderdetail->order_total;
				$eco['debtorHandle']       = intVal($ecodebtorNumber[0]->Number);
				$eco['user_info_id']       = $user_billinginfo->users_info_id;
				$eco['customer_note']      = $orderdetail->customer_note;
				$eco['requisition_number'] = $orderdetail->requisition_number;
				$eco['vatzone']            = $this->getEconomicTaxZone($user_billinginfo->country_code);

				$invoiceHandle = $this->_dispatcher->trigger('createInvoice', array($eco));

				if (count($invoiceHandle) > 0 && $invoiceHandle[0]->Id)
				{
					$invoice_no = $invoiceHandle[0]->Id;
					$this->updateInvoiceNumber($order_id, $invoice_no);

					$eco['invoiceHandle'] = $invoice_no;
					$eco['name_ST']       = ($user_shippinginfo->is_company == 1 && $user_shippinginfo->company_name != '')
						? $user_shippinginfo->company_name : $user_shippinginfo->firstname . ' ' . $user_shippinginfo->lastname;
					$eco['address_ST']    = $user_shippinginfo->address;
					$eco['city_ST']       = $user_shippinginfo->city;
					$eco['country_ST']    = $this->_order_functions->getCountryName($user_shippinginfo->country_code);
					$eco['zipcode_ST']    = $user_shippinginfo->zipcode;

					$this->_dispatcher->trigger('setDeliveryAddress', array($eco));

					if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') == 2)
					{
						$this->createInvoiceLineInEconomicAsProduct($orderitem, $invoice_no, $orderdetail->user_id);
					}
					else
					{
						$this->createInvoiceLineInEconomic($orderitem, $invoice_no, $orderdetail->user_id);
					}

					$this->createInvoiceShippingLineInEconomic($orderdetail->ship_method_id, $invoice_no);

					$isVatDiscount = 0;

					if (Redshop::getConfig()->get('APPLY_VAT_ON_DISCOUNT') == '0' && (float) Redshop::getConfig()->get('VAT_RATE_AFTER_DISCOUNT') && $orderdetail->order_discount != "0.00" && $orderdetail->order_tax && !empty($orderdetail->order_discount))
					{
						$totaldiscount               = $orderdetail->order_discount;
						$Discountvat                 = ((float) Redshop::getConfig()->get('VAT_RATE_AFTER_DISCOUNT') * $totaldiscount) / (1 + (float) Redshop::getConfig()->get('VAT_RATE_AFTER_DISCOUNT'));
						$orderdetail->order_discount = $totaldiscount - $Discountvat;
						$isVatDiscount               = 1;
					}

					$order_discount = $orderdetail->order_discount + $orderdetail->special_discount_amount;

					if ($order_discount)
					{
						$this->createInvoiceDiscountLineInEconomic($orderdetail, $invoice_no, $data, 0, $isVatDiscount);
					}

					if ($orderdetail->payment_discount != 0)
					{
						$this->createInvoiceDiscountLineInEconomic($orderdetail, $invoice_no, $data, 1);
					}
				}

				return $invoiceHandle;
			}

			else
			{
				return "USRE_NOT_SAVED_IN_ECONOMIC";
			}
		}

		return true;
	}

	/**
	 * Method to create Invoice line in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function createInvoiceLineInEconomic($orderitem = array(), $invoice_no = "", $user_id = 0)
	{
		if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') == 2)
		{
			return;
		}

		for ($i = 0, $in = count($orderitem); $i < $in; $i++)
		{
			$displaywrapper   = "";
			$displayattribute = "";
			$displayaccessory = "";

			// Create Gift Card Entry for invoice
			if ($orderitem[$i]->is_giftcard)
			{
				$this->createGFInvoiceLineInEconomic($orderitem[$i], $invoice_no);
				continue;
			}

			$product_id = $orderitem[$i]->product_id;
			$product    = Redshop::product((int) $product_id);
			$this->createProductInEconomic($product);

			if ($orderitem[$i]->wrapper_id)
			{
				$wrapper = $this->_producthelper->getWrapper($orderitem[$i]->product_id, $orderitem[$i]->wrapper_id);

				if (count($wrapper) > 0)
				{
					$wrapper_name = $wrapper[0]->wrapper_name;
				}

				$displaywrapper = "\n" . JText::_('COM_REDSHOP_WRAPPER') . ": " . $wrapper_name . "(" . $orderitem[$i]->wrapper_price . ")";
			}

			$eco['updateInvoice']  = 0;
			$eco['invoiceHandle']  = $invoice_no;
			$eco['order_item_id']  = $orderitem[$i]->order_item_id;
			$eco['product_number'] = $orderitem[$i]->order_item_sku;

			$discount_calc = "";

			if ($orderitem[$i]->discount_calc_data)
			{
				$discount_calc = $orderitem[$i]->discount_calc_data;
				$discount_calc = str_replace("<br />", "\n", $discount_calc);
				$discount_calc = "\n" . $discount_calc;
			}

			// Product user field Information
			$p_userfield    = $this->_producthelper->getuserfield($orderitem[$i]->order_item_id);
			$displaywrapper = $displaywrapper . "\n" . strip_tags($p_userfield);

			$eco['product_name']     = $orderitem[$i]->order_item_name . $displaywrapper . $displayattribute . $discount_calc . $displayaccessory;
			$eco['product_price']    = $orderitem[$i]->product_item_price_excl_vat;
			$eco['product_quantity'] = $orderitem[$i]->product_quantity;
			$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");

			$InvoiceLine_no = $this->_dispatcher->trigger('createInvoiceLine', array($eco));

			$displayattribute = $this->makeAttributeOrder($invoice_no, $orderitem[$i], 0, $orderitem[$i]->product_id, $user_id);

			if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
			{
				$orderitem[$i]->product_item_price_excl_vat -= $displayattribute;
				$displayattribute = '';
			}

			$displayaccessory = $this->makeAccessoryOrder($invoice_no, $orderitem[$i], $user_id);

			$orderitem[$i]->product_item_price_excl_vat -= $displayaccessory;
			$displayaccessory = '';

			if (count($InvoiceLine_no) > 0 && $InvoiceLine_no[0]->Number)
			{
				$updateInvoiceLine        = $InvoiceLine_no[0]->Number;
				$eco['updateInvoice']    = 1;
				$eco['invoiceHandle']    = $invoice_no;
				$eco['order_item_id']    = $updateInvoiceLine;
				$eco['product_number']   = $orderitem[$i]->order_item_sku;
				$eco['product_name']     = $orderitem[$i]->order_item_name . $displaywrapper . $displayattribute . $discount_calc . $displayaccessory;
				$eco['product_price']    = $orderitem[$i]->product_item_price_excl_vat;
				$eco['product_quantity'] = $orderitem[$i]->product_quantity;
				$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");

				$InvoiceLine_no = $this->_dispatcher->trigger('createInvoiceLine', array($eco));
			}
		}
	}

	/**
	 * Method to create Invoice line in E-conomic for GiftCard
	 *
	 * @access public
	 * @return array
	 */
	public function createGFInvoiceLineInEconomic($orderitem = array(), $invoice_no = "")
	{
		$product                 = new stdClass;
		$product->product_id     = $orderitem->product_id;
		$product->product_number = $orderitem->order_item_sku = "gift_" . $orderitem->product_id . "_" . $orderitem->order_item_name;
		$product->product_name   = $orderitem->order_item_name;
		$product->product_price  = $orderitem->product_item_price_excl_vat;

		$giftdata                 = $this->_producthelper->getGiftcardData($orderitem->product_id);
		$product->accountgroup_id = $giftdata->accountgroup_id;
		$product->product_volume  = 0;

		$this->createProductInEconomic($product);

		$eco['updateInvoice']    = 0;
		$eco['invoiceHandle']    = $invoice_no;
		$eco['order_item_id']    = $orderitem->order_item_id;
		$eco['product_number']   = $orderitem->order_item_sku;
		$eco['product_name']     = $orderitem->order_item_name;
		$eco['product_price']    = $orderitem->product_item_price_excl_vat;
		$eco['product_quantity'] = $orderitem->product_quantity;
		$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");

		$this->_dispatcher->trigger('createInvoiceLine', array($eco));
	}

	/**
	 * Method to create Invoice line in E-conomic
	 *
	 * Changes for ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC option 2 :- To use combination of attribute + product : For Stock regulation     *
	 *
	 * @access public
	 * @return array
	 */
	public function createInvoiceLineInEconomicAsProduct($orderitem = array(), $invoice_no = "", $user_id = 0)
	{
		for ($i = 0, $in = count($orderitem); $i < $in; $i++)
		{
			$displaywrapper   = "";
			$displayaccessory = "";

			$product_id = $orderitem[$i]->product_id;
			$product    = Redshop::product((int) $product_id);
			$this->createProductInEconomic($product);

			if ($orderitem[$i]->wrapper_id)
			{
				$wrapper = $this->_producthelper->getWrapper($orderitem[$i]->product_id, $orderitem[$i]->wrapper_id);

				if (count($wrapper) > 0)
				{
					$wrapper_name = $wrapper[0]->wrapper_name;
				}

				$displaywrapper = "\n" . JText::_('COM_REDSHOP_WRAPPER') . ": " . $wrapper_name . "(" . $orderitem[$i]->wrapper_price . ")";
			}

			// Fetch Accessory from Order Item
			$displayaccessory = $this->makeAccessoryOrder($invoice_no, $orderitem[$i], $user_id);

			$eco['updateInvoice']  = 0;
			$eco['invoiceHandle']  = $invoice_no;
			$eco['order_item_id']  = $orderitem[$i]->order_item_id;
			$eco['product_number'] = $orderitem[$i]->order_item_sku;

			$discount_calc = "";

			if ($orderitem[$i]->discount_calc_data)
			{
				$discount_calc = $orderitem[$i]->discount_calc_data;
				$discount_calc = str_replace("<br />", "\n", $discount_calc);
				$discount_calc = "\n" . $discount_calc;
			}

			// Product user field Information
			$p_userfield    = $this->_producthelper->getuserfield($orderitem[$i]->order_item_id);
			$displaywrapper = $displaywrapper . "\n" . strip_tags($p_userfield);

			$eco['product_name']     = $orderitem[$i]->order_item_name . $displaywrapper . $discount_calc . $displayaccessory;
			$eco['product_price']    = $orderitem[$i]->product_item_price_excl_vat;
			$eco['product_quantity'] = $orderitem[$i]->product_quantity;
			$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");

			// Collect Order Attrubute Items
			$orderItemAttdata = $this->_order_functions->getOrderItemAttributeDetail($orderitem[$i]->order_item_id, 0, "attribute", $orderitem[$i]->product_id);

			if (count($orderItemAttdata) > 0)
			{
				$attributeId = $orderItemAttdata[0]->section_id;
				$productId   = $orderitem[$i]->product_id;

				$orderPropdata = $this->_order_functions->getOrderItemAttributeDetail($orderitem[$i]->order_item_id, 0, "property", $attributeId);

				if (count($orderPropdata) > 0)
				{
					$propertyId = $orderPropdata[0]->section_id;

					// Collect Attribute Property
					$orderProperty = $this->_producthelper->getAttibuteProperty($propertyId, $attributeId, $productId);

					$property_number = $orderProperty[0]->property_number;
					$property_name   = $orderPropdata[0]->section_name;

					if ($property_number)
					{
						$eco['product_number'] = $property_number;
					}

					$eco['product_name']   = $orderitem[$i]->order_item_name . " " . $property_name . $displaywrapper . $discount_calc;
				}
			}

			$this->_dispatcher->trigger('createInvoiceLine', array($eco));
		}
	}

	/**
	 * Method to create Invoice line for shipping in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function createInvoiceShippingLineInEconomic($ship_method_id = "", $invoice_no = "")
	{
		if ($ship_method_id != "")
		{
			$order_shipping = RedshopShippingRate::decrypt($ship_method_id);

			if (count($order_shipping) > 5)
			{
				// Load language file of the shipping plugin
				JFactory::getLanguage()->load(
					'plg_redshop_shipping_' . strtolower(str_replace('plgredshop_shipping', '', $order_shipping[0])),
					JPATH_ADMINISTRATOR
				);

				$shippingName        = JText::_($order_shipping[1]);
				$shipping_nshortname = (strlen($shippingName) > 15) ? substr($shippingName, 0, 15) : $shippingName;
				$shipping_number     = $shipping_nshortname . ' ' . $order_shipping[4];
				$shipping_name       = $order_shipping[2];
				$shipping_rate       = $order_shipping[3];

				$isvat = 0;

				if (isset($order_shipping[6]) && $order_shipping[6] != 0)
				{
					$isvat         = 1;
					$shipping_rate = $shipping_rate - $order_shipping[6];
				}

				if (isset($order_shipping[7]) && $order_shipping[7] != '')
				{
					$shipping_number = $order_shipping[7];
				}

				$ecoShippingrateNumber = $this->createShippingRateInEconomic($shipping_number, $shipping_name, $shipping_rate, $isvat);

				if (isset($ecoShippingrateNumber[0]->Number))
				{
					$eco['product_number'] = $ecoShippingrateNumber[0]->Number;

					$eco['invoiceHandle']    = $invoice_no;
					$eco['product_name']     = $shipping_name;
					$eco['order_item_id']    = "";
					$eco['product_id']       = $shipping_number;
					$eco['product_quantity'] = 1;
					$eco['product_price']    = $shipping_rate;
					$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");
					$eco['shipping']         = 1;

					$this->_dispatcher->trigger('createInvoiceLine', array($eco));
				}
			}
		}
	}

	/**
	 * Method to create Invoice line for discount in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function createInvoiceDiscountLineInEconomic($orderdetail = array(), $invoice_no = "", $data = array(), $isPaymentDiscount = 0, $isVatDiscount = 0)
	{
		if (Redshop::getConfig()->get('DEFAULT_ECONOMIC_ACCOUNT_GROUP'))
		{
			$accountgroup = $this->_redhelper->getEconomicAccountGroup(Redshop::getConfig()->get('DEFAULT_ECONOMIC_ACCOUNT_GROUP'), 1);

			if (count($accountgroup) > 0)
			{
				$ecoProductGroupNumber = $this->createProductGroupInEconomic(array(), 0, 1, $isVatDiscount);

				if (isset($ecoProductGroupNumber[0]->Number))
				{
					$eco['product_group'] = $ecoProductGroupNumber[0]->Number;
				}

				$discount     = $orderdetail->order_discount + $orderdetail->special_discount_amount;
				$product_name = JText::_('COM_REDSHOP_ORDER_DISCOUNT');

				$product_number = $accountgroup[0]->economic_discount_product_number;

				if ($isPaymentDiscount)
				{
					$product_number = $accountgroup[0]->economic_discount_product_number . "_" . $data['economic_payment_method'];
					$product_name   = ($orderdetail->payment_oprand == '+') ? JText::_('PAYMENT_CHARGES_LBL') : JText::_('PAYMENT_DISCOUNT_LBL');
					$discount       = ($orderdetail->payment_oprand == "+") ? (0 - $orderdetail->payment_discount) : $orderdetail->payment_discount;
				}

				$discount_short = (strlen($product_number) > 20) ? substr($product_number, 0, 20) : $product_number;

				$eco['invoiceHandle']    = $invoice_no;
				$eco['product_number']   = $discount_short;
				$eco['product_name']     = $product_name;
				$eco['order_item_id']    = "";
				$eco['product_desc']     = "";
				$eco['product_s_desc']   = "";
				$eco['product_id']       = $discount_short;
				$eco['product_quantity'] = 1;
				$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");
				$eco['product_price']    = (0 - $discount);
				$eco['product_volume']   = 1;

				$debtorHandle          = $this->_dispatcher->trigger('Product_FindByNumber', array($eco));
				$eco['eco_prd_number'] = "";

				if (count($debtorHandle) > 0 && isset($debtorHandle[0]->Number) != "")
				{
					$eco['eco_prd_number'] = $debtorHandle[0]->Number;
				}

				$eco['product_stock'] = 1;
				$this->_dispatcher->trigger('storeProduct', array($eco));
				$this->_dispatcher->trigger('createInvoiceLine', array($eco));
			}
		}
	}

	/**
	 * Method to create Invoice and send mail in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function renewInvoiceInEconomic($orderdata)
	{
		$invoiceHandle = array();

		if ($orderdata->is_booked == 0)
		{
			$data        = array();
			$paymentInfo = $this->_order_functions->getOrderPaymentDetail($orderdata->order_id);

			if (count($paymentInfo) > 0)
			{
				$payment_name = $paymentInfo[0]->payment_method_class;
				$paymentArr   = explode("rs_payment_", $paymentInfo[0]->payment_method_class);

				if (count($paymentArr) > 0)
				{
					$payment_name = $paymentArr[1];
				}

				$data['economic_payment_method'] = $payment_name;
				$paymentmethod                   = $this->_order_functions->getPaymentMethodInfo($paymentInfo[0]->payment_method_class);

				if (count($paymentmethod) > 0)
				{
					$paymentparams                     = new JRegistry($paymentmethod[0]->params);
					$data['economic_payment_terms_id'] = $paymentparams->get('economic_payment_terms_id');
					$data['economic_design_layout']    = $paymentparams->get('economic_design_layout');
					$data['economic_is_creditcard']    = $paymentparams->get('is_creditcard');
				}
			}

			// Delete existing draft invoice from e-conomic
			if ($orderdata->invoice_no)
			{
				$this->deleteInvoiceInEconomic($orderdata);
			}

			$invoiceHandle = $this->createInvoiceInEconomic($orderdata->order_id, $data);
		}

		return $invoiceHandle;
	}

	/**
	 * Method to delete invoice in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function deleteInvoiceInEconomic($orderdata = array())
	{
		if ($orderdata->invoice_no)
		{
			$eco['invoiceHandle'] = $orderdata->invoice_no;
			$this->_dispatcher->trigger('deleteInvoice', array($eco));
			$this->updateInvoiceNumber($orderdata->order_id, 0);
		}
	}

	/**
	 * Method to check invoice is draft or booked in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function checkInvoiceDraftorBookInEconomic($orderdetail)
	{
		$eco['invoiceHandle'] = $orderdetail->invoice_no;
		$eco['order_number']  = $orderdetail->order_number;
		$bookInvoiceData       = $this->_dispatcher->trigger('checkBookInvoice', array($eco));

		if (count($bookInvoiceData) > 0 && isset($bookInvoiceData[0]->InvoiceHandle))
		{
			$bookInvoiceData = $bookInvoiceData[0]->InvoiceHandle;

			if (isset($bookInvoiceData->Number) && is_numeric($bookInvoiceData->Number))
			{
				$bookinvoice_number = $bookInvoiceData->Number;
				$this->updateBookInvoice($orderdetail->order_id);
				$this->updateBookInvoiceNumber($orderdetail->order_id, $bookinvoice_number);
				$invoiceData[0]->invoiceStatus = "booked";
			}
		}

		else
		{
			$invoiceData[0]->invoiceStatus = "draft";
		}

		return $invoiceData;
	}

	/**
	 * Method to update invoice draft for changing the date in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function updateInvoiceDateInEconomic($orderdetail, $bookinvoicedate = 0)
	{
		$db = JFactory::getDbo();
		$eco['invoiceHandle'] = $orderdetail->invoice_no;

		if ($bookinvoicedate != 0)
		{
			$eco['invoiceDate'] = $bookinvoicedate . "T" . date("h:i:s");
		}

		else
		{
			$eco['invoiceDate'] = date("Y-m-d") . "T" . date("h:i:s");
		}

		$bookinvoice_date = strtotime($eco['invoiceDate']);
		$query = 'UPDATE ' . $this->_table_prefix . 'orders '
			. 'SET bookinvoice_date = ' . $db->quote($bookinvoice_date) . ' '
			. 'WHERE order_id = ' . (int) $orderdetail->order_id;

		$this->_db->setQuery($query);
		$this->_db->execute();

		$InvoiceNumber = $this->_dispatcher->trigger('updateInvoiceDate', array($eco));

		return $InvoiceNumber;
	}

	/**
	 * Method to book invoice and send mail in E-conomic
	 *
	 * @access public
	 * @return array
	 */
	public function bookInvoiceInEconomic($order_id, $checkOrderStatus = 1, $bookinvoicedate = 0)
	{
		$file = '';

		if (Redshop::getConfig()->get('ECONOMIC_INTEGRATION') == 1)
		{
			$orderdetail = $this->_order_functions->getOrderDetails($order_id);

			if ($orderdetail->invoice_no != '' && $orderdetail->is_booked == 0)
			{
				if ((Redshop::getConfig()->get('ECONOMIC_INVOICE_DRAFT') == 2 && $orderdetail->order_status == Redshop::getConfig()->get('BOOKING_ORDER_STATUS')) || $checkOrderStatus == 0)
				{
					$user_billinginfo = RedshopHelperOrder::getOrderBillingUserInfo($order_id);

					if ($user_billinginfo->is_company == 0 || (!$user_billinginfo->ean_number && $user_billinginfo->is_company == 1))
					{
						$currency = Redshop::getConfig()->get('CURRENCY_CODE');

						$eco['invoiceHandle'] = $orderdetail->invoice_no;
						$eco['debtorHandle']  = intVal($user_billinginfo->users_info_id);
						$eco['currency_code'] = $currency;
						$eco['amount']        = $orderdetail->order_total;
						$eco['order_number']  = $orderdetail->order_number;
						$eco['order_id']      = $orderdetail->order_id;

						$currectinvoiceData = $this->_dispatcher->trigger('checkDraftInvoice', array($eco));

						if (count($currectinvoiceData) > 0 && trim($currectinvoiceData[0]->OtherReference) == $orderdetail->order_number)
						{
							$this->updateInvoiceDateInEconomic($orderdetail, $bookinvoicedate);

							if ($user_billinginfo->is_company == 1 && $user_billinginfo->company_name != '')
							{
								$eco['name'] = $user_billinginfo->company_name;
							}

							else
							{
								$eco['name'] = $user_billinginfo->firstname . " " . $user_billinginfo->lastname;
							}

							$paymentInfo = $this->_order_functions->getOrderPaymentDetail($orderdetail->order_id);

							if (count($paymentInfo) > 0)
							{
								$paymentmethod = $this->_order_functions->getPaymentMethodInfo($paymentInfo[0]->payment_method_class);

								if (count($paymentmethod) > 0)
								{
									$paymentparams                    = new JRegistry($paymentmethod[0]->params);
									$eco['economic_payment_terms_id'] = $paymentparams->get('economic_payment_terms_id');
									$eco['economic_design_layout']    = $paymentparams->get('economic_design_layout');
								}

								// Setting merchant fees for economic
								if($paymentInfo[0]->order_transfee > 0)
								{
									$eco['order_transfee'] = $paymentInfo[0]->order_transfee;
								}
							}

							if (Redshop::getConfig()->get('ECONOMIC_BOOK_INVOICE_NUMBER') == 1)
							{
								$bookhandle = $this->_dispatcher->trigger('CurrentInvoice_Book', array($eco));
							}
							else
							{
								$bookhandle = $this->_dispatcher->trigger('CurrentInvoice_BookWithNumber', array($eco));
							}

							if (count($bookhandle) > 0 && isset($bookhandle[0]->Number))
							{
								$bookinvoice_number = $eco['bookinvoice_number'] = $bookhandle[0]->Number;

								if (Redshop::getConfig()->get('ECONOMIC_BOOK_INVOICE_NUMBER') == 1)
								{
									$this->updateBookInvoiceNumber($order_id, $bookinvoice_number);
								}

								$bookinvoicepdf = $this->_dispatcher->trigger('bookInvoice', array($eco));

								if (JError::isError(JError::getError()))
								{
									return $file;
								}
								elseif ($bookinvoicepdf != "")
								{
									$file = JPATH_ROOT . '/components/com_redshop/assets/orders/rsInvoice_' . $order_id . '.pdf';
									JFile::write($file, $bookinvoicepdf);

									if (is_file($file))
									{
										$this->updateBookInvoice($order_id);
									}
								}
							}
						}
					}
				}
			}
		}

		return $file;
	}

	public function updateInvoiceNumber($order_id = 0, $invoice_no = 0)
	{
		$db = JFactory::getDbo();

		$query = 'UPDATE ' . $this->_table_prefix . 'orders '
			. 'SET invoice_no = ' . $db->quote($invoice_no) . ' '
			. 'WHERE order_id = ' . (int) $order_id ;
		$this->_db->setQuery($query);
		$this->_db->execute();
	}

	public function updateBookInvoice($order_id = 0)
	{
		$query = 'UPDATE ' . $this->_table_prefix . 'orders '
			. 'SET is_booked="1" '
			. 'WHERE order_id = ' . (int) $order_id;
		$this->_db->setQuery($query);
		$this->_db->execute();
	}

	public function updateBookInvoiceNumber($order_id = 0, $bookinvoice_number = 0)
	{
		$query = 'UPDATE ' . $this->_table_prefix . 'orders '
			. 'SET bookinvoice_number = ' . (int) $bookinvoice_number . ' '
			. 'WHERE order_id = ' . (int) $order_id;
		$this->_db->setQuery($query);
		$this->_db->execute();
	}

	public function getProductByNumber($product_number = '')
	{
		$db = JFactory::getDbo();

		$query = 'SELECT * FROM ' . $this->_table_prefix . 'product '
			. 'WHERE product_number = ' . $db->quote($product_number);
		$this->_db->setQuery($query);
		$result = $this->_db->loadObject();

		return $result;
	}

	public function makeAccessoryOrder($invoice_no, $orderItem, $user_id = 0)
	{
		$displayaccessory = "";
		$retPrice         = 0;
		$orderItemdata    = $this->_order_functions->getOrderItemAccessoryDetail($orderItem->order_item_id);

		if (count($orderItemdata) > 0)
		{
			$displayaccessory .= "\n" . JText::_("COM_REDSHOP_ACCESSORY");

			for ($i = 0, $in = count($orderItemdata); $i < $in; $i++)
			{
				if (true)
				{
					$product = $this->getProductByNumber($orderItemdata[$i]->order_acc_item_sku);

					if (count($product) > 0)
					{
						$this->createProductInEconomic($product);
					}
				}

				$accessory_quantity = " (" . JText::_('COM_REDSHOP_ACCESSORY_QUANTITY_LBL') . " " . $orderItemdata[$i]->product_quantity . ") ";
				$displayaccessory .= "\n" . urldecode($orderItemdata[$i]->order_acc_item_name) . " (" . ($orderItemdata[$i]->order_acc_price + $orderItemdata[$i]->order_acc_vat) . ")" . $accessory_quantity;

				if (true)
				{
					$retPrice += $orderItemdata[$i]->product_acc_item_price;

					$eco['updateInvoice']    = 0;
					$eco['invoiceHandle']    = $invoice_no;
					$eco['order_item_id']    = $orderItem->order_item_id;
					$eco['product_number']   = $orderItemdata[$i]->order_acc_item_sku;
					$eco['product_name']     = $orderItemdata[$i]->order_acc_item_name;
					$eco['product_price']    = $orderItemdata[$i]->product_acc_item_price;
					$eco['product_quantity'] = $orderItemdata[$i]->product_quantity;
					$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");
					$InvoiceLine_no           = $this->_dispatcher->trigger('createInvoiceLine', array($eco));
				}

				$displayattribute = $this->makeAttributeOrder($invoice_no, $orderItem, 1, $orderItemdata[$i]->product_id, $user_id);
				$displayaccessory .= $displayattribute;

				if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
				{
					$orderItemdata[$i]->product_acc_item_price -= $displayattribute;
					$displayattribute = '';
				}

				if (true && count($InvoiceLine_no) > 0 && $InvoiceLine_no[0]->Number)
				{
					$eco['updateInvoice']    = 1;
					$eco['invoiceHandle']    = $invoice_no;
					$eco['order_item_id']    = $InvoiceLine_no[0]->Number;
					$eco['product_number']   = $orderItemdata[$i]->order_acc_item_sku;
					$eco['product_name']     = $orderItemdata[$i]->order_acc_item_name . $displayattribute;
					$eco['product_price']    = $orderItemdata[$i]->product_acc_item_price;
					$eco['product_quantity'] = $orderItemdata[$i]->product_quantity;
					$eco['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");

					$InvoiceLine_no = $this->_dispatcher->trigger('createInvoiceLine', array($eco));
				}
			}
		}

		if (true)
		{
			$displayaccessory = $retPrice;
		}

		return $displayaccessory;
	}

	public function makeAttributeOrder($invoice_no, $orderItem, $is_accessory = 0, $parent_section_id = 0, $user_id = 0)
	{
		$displayattribute = "";
		$retPrice         = 0;
		$chktag           = $this->_producthelper->getApplyattributeVatOrNot('', $user_id);
		$orderItemAttdata = $this->_order_functions->getOrderItemAttributeDetail($orderItem->order_item_id, $is_accessory, "attribute", $parent_section_id);

		if (count($orderItemAttdata) > 0)
		{
			$product = Redshop::product((int) $parent_section_id);

			for ($i = 0, $in = count($orderItemAttdata); $i < $in; $i++)
			{
				$attribute            = $this->_producthelper->getProductAttribute(0, 0, $orderItemAttdata[$i]->section_id);
				$hide_attribute_price = 0;

				if (count($attribute) > 0)
				{
					$hide_attribute_price = $attribute[0]->hide_attribute_price;
				}

				$displayattribute .= "\n" . urldecode($orderItemAttdata[$i]->section_name) . " : ";
				$orderPropdata = $this->_order_functions->getOrderItemAttributeDetail($orderItem->order_item_id, $is_accessory, "property", $orderItemAttdata[$i]->section_id);

				for ($p = 0, $pn = count($orderPropdata); $p < $pn; $p++)
				{
					$property      = $this->_producthelper->getAttibuteProperty($orderPropdata[$p]->section_id);
					$virtualNumber = "";

					if (count($property) > 0 && $property[0]->property_number)
					{
						$virtualNumber = "[" . $property[0]->property_number . "]";

						if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
						{
							$orderPropdata[$p]->virtualNumber = $property[0]->property_number;
							$this->createPropertyInEconomic($product, $property[0]);
						}
					}

					$disPrice = "";

					if (!$hide_attribute_price)
					{
						$property_price = $orderPropdata[$p]->section_price;

						if (!empty($chktag))
						{
							$property_price = $orderPropdata[$p]->section_price + $orderPropdata[$p]->section_vat;
						}

						$disPrice = " (" . $orderPropdata[$p]->section_oprand . $this->_producthelper->getProductFormattedPrice($property_price) . ")";
					}

					$displayattribute .= urldecode($orderPropdata[$p]->section_name) . $disPrice . $virtualNumber;

					if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
					{
						$retPrice += $orderPropdata[$p]->section_price;
						$this->createAttributeInvoiceLineInEconomic($invoice_no, $orderItem, array($orderPropdata[$p]));
					}

					$orderSubpropdata = $this->_order_functions->getOrderItemAttributeDetail($orderItem->order_item_id, $is_accessory, "subproperty", $orderPropdata[$p]->section_id);

					if (count($orderSubpropdata) > 0)
					{
						for ($sp = 0; $sp < count($orderSubpropdata); $sp++)
						{
							$subproperty   = $this->_producthelper->getAttibuteSubProperty($orderSubpropdata[$sp]->section_id);
							$virtualNumber = "";

							if (count($subproperty) > 0 && $subproperty[0]->subattribute_color_number)
							{
								$virtualNumber = "[" . $subproperty[0]->subattribute_color_number . "]";

								if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
								{
									$orderSubpropdata[$sp]->virtualNumber = $subproperty[0]->subattribute_color_number;
									$this->createSubpropertyInEconomic($product, $subproperty[0]);
								}
							}

							$disPrice = "";

							if (!$hide_attribute_price)
							{
								$subproperty_price = $orderSubpropdata[$sp]->section_price;

								if (!empty($chktag))
								{
									$subproperty_price = $orderSubpropdata[$sp]->section_price + $orderSubpropdata[$sp]->section_vat;
								}

								$disPrice = " (" . $orderSubpropdata[$sp]->section_oprand . $this->_producthelper->getProductFormattedPrice($subproperty_price) . ")";
							}

							$displayattribute .= "\n" . urldecode($orderSubpropdata[$sp]->section_name) . $disPrice . $virtualNumber;

							if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
							{
								$retPrice += $orderSubpropdata[$sp]->section_price;
							}
						}

						if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
						{
							$this->createAttributeInvoiceLineInEconomic($invoice_no, $orderItem, $orderSubpropdata);
						}
					}
				}
			}
		}

		if (Redshop::getConfig()->get('ATTRIBUTE_AS_PRODUCT_IN_ECONOMIC') != 0)
		{
			$displayattribute = $retPrice;
		}

		return $displayattribute;
	}

	public function createAttributeInvoiceLineInEconomic($invoice_no, $orderItem, $orderAttitem)
	{
		for ($i = 0, $in = count($orderAttitem); $i < $in; $i++)
		{
			$eco[$i]['invoiceHandle']    = $invoice_no;
			$eco[$i]['order_item_id']    = $orderItem->order_item_id;
			$eco[$i]['product_number']   = $orderAttitem[$i]->virtualNumber;
			$eco[$i]['product_name']     = $orderAttitem[$i]->section_name;
			$eco[$i]['product_price']    = $orderAttitem[$i]->section_price;
			$eco[$i]['product_quantity'] = $orderItem->product_quantity;
			$eco[$i]['delivery_date']    = date("Y-m-d") . "T" . date("h:i:s");
			$this->_dispatcher->trigger('createInvoiceLine', array($eco[$i]));
		}
	}

	public function getEconomicTaxZone($country_code = "")
	{
		if ($country_code == Redshop::getConfig()->get('SHOP_COUNTRY'))
		{
			$taxzone = 'HomeCountry';
		}
		elseif ($this->isEUCountry($country_code))
		{
			$taxzone = 'EU';
		}
		else
		{
			// Non EU Country
			$taxzone = 'Abroad';
		}

		return $taxzone;
	}

	public function isEUCountry($country)
	{
		$eu_country = array('AUT', 'BGR', 'BEL', 'CYP', 'CZE', 'DEU', 'DNK', 'ESP', 'EST', 'FIN',
			'FRA', 'FXX', 'GBR', 'GRC', 'HUN', 'IRL', 'ITA', 'LVA', 'LTU', 'LUX',
			'MLT', 'NLD', 'POL', 'PRT', 'ROM', 'SVK', 'SVN', 'SWE');

		return in_array($country, $eu_country);
	}
}
