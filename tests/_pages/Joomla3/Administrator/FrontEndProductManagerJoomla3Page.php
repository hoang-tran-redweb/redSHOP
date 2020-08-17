<?php
/**
 * @package     redSHOP
 * @subpackage  Page Class
 * @copyright   Copyright (C) 2008 - 2020 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Class ProductFrontEndJoomla3Page
 *
 * @since  1.4.0
 *
 * @link   http://codeception.com/docs/07-AdvancedUsage#PageObjects
 */
class FrontEndProductManagerJoomla3Page extends AdminJ3Page
{
	// Include url of current page

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $URL = '/index.php?option=com_redshop';

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $cartPageUrL = "index.php?option=com_redshop&view=cart";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $quotation = "/index.php?option=com_redshop&view=quotation";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addQuotation = "//input[@name='addquotation']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $categoryDiv = "//div[@id='redshopcomponent']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $productList = "//div[@id='redcatproducts']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addToCart = "//span[contains(text(), 'Add to cart')]";

	/**
	 * @var string
	 * @since 1.4.0
	 */

	public static $addToCompare = "//input[@name='rsProductCompareChk']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $showProductToCompare = "//a[text() = 'Show Products To Compare']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $alertMessageDiv = "//div[@class='alert alert-success']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $alertSuccessMessage = "Product has been added to your cart.";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $alterOutOfStock = "Sorry, This product is out of stock....";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addQuotationSuccess = 'Quotation detail has been sent successfully';

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $checkoutURL = "/index.php?option=com_redshop&view=checkout";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $headBilling = 'Billing Address Information';

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $newCustomerSpan = "//span[text() = 'New customer? Please Provide Your Billing Information']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $checkoutButton = "//input[@class='greenbutton btn btn-primary']";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $proceedButton = 'Proceed';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $proceedButtonId = "#submitbtn";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressEmail = "#private-email1";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $userEmail = "//input[@id='user_email']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressFirstName = "//input[@id='private-firstname']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressLastName = "//input[@id='private-lastname']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressAddress = "//input[@id='private-address']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressPostalCode = "//input[@id='private-zipcode']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressCity = "//input[@id='private-city']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressCountry = "//select[@id='rs_country_country_code']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressState = "//select[@id='state_code']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $addressPhone = "//input[@id='private-phone']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingFirstName = "//input[@id='firstname_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingLastName = "//input[@id='lastname_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingAddress = "//input[@id='address_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingPostalCode = "//input[@id='zipcode_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingCity = "//input[@id='city_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $countryId = "#rs_country_country_code";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $selectSecondCountry = "//select[@id='rs_country_country_code']/option[2]";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingCountry = "//select[@id='country_code_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingState = "//select[@id='state_code_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $shippingPhone = "//input[@id='phone_ST']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $billingFinal = "//h3[text() = 'Bill to information']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $termAndConditions = "//input[@id='termscondition']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $termAndConditionsId = 'termscondition';

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $checkoutFinalStep = "#checkout_final";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $orderReceiptTitle = "//h1[contains(text(), 'Order Receipt')]";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $orderReceipt = "Order Receipt";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idAddAccount = "//label//input[@id='createaccount']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idUserNameOneStep = "//input[@id='onestep-createaccount-username']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idPassOneStep = "//input[@id='password1']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idPassConfirmOneStep = "//input[@id='password2']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $radioCompany = "//input[@id='toggler2']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $radioIDCompany = "//input[@id='toggler2']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $radioPrivate = "//input[@billing_type='private']";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyNameOnePage = "#company-company_name";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyAddressOnePage = "#company-address";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyEmailOnePage = "#company-email1";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyZipCodeOnePage = "#company-zipcode";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyCityOnePage = "#company-city";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyPhoneOnePage = "#company-phone";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idBusinessNumber = "#vat_number";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idEanNumber = "#ean_number";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyFirstName = "#company-firstname";

	/**
	 * @var array
	 * @since 1.4.0
	 */
	public static $idCompanyLastName = "#company-lastname";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $searchProductRedShop = "//div[@class='product_search']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $inputSearchProductRedShop = "//input[@id='keyword']";

	/**
	 * @var string
	 * @since 1.4.0
	 */
	public static $buttonSearchProductRedShop = "//input[@id='Search']";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessageEnterUser = "#onestep-createaccount-username-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $enableCreateAccount = "jQuery('#createaccount').click()";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $shippingMethod = "//strong[contains(text(),'Shipping Method')]";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessagePassword = "#password1-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessageConfirmPassword = "#password2-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessageEAN = "#ean_number-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessageAcceptTerms= "#termscondition-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $locatorMessagePayment = "#payment_method_id-error";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterUser = "Please enter username";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageFieldRequired = "This field is required";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterEmail = "Please enter email address";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterCompanyName = "Please enter company name";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterFirstName = "Please enter first name";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterLastName = "Please enter last name";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterAddress = "Please enter address";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterCity = "Please enter city";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEnterPhone = "Please specify a valid phone number";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageSelectPayment = "Select Payment Method";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageAcceptTerms = "Please accept Terms and conditions before clicking in the Checkout button.";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEmailInvalid = "Please enter a valid email address.";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageEAN = "Enter only 13 digits without spaces";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $messageRelated = 'You may also interested in this/these product(s)';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $selectorEmailInvalid = '//label[@for = "private-email1"]';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $paymentEWAY = "//div[@id='rs_payment_eway']//label//input";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $countryCode1 = "#s2id_rs_country_country_code";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $searchCountryInput = "//div[@id='select2-drop']//div[@class='select2-search']//input";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $countryCode2 = "#s2id_rs_country_country_code_ST";

	/**
	 * @param $name
	 * @since 2.1.2
	 * @return string
	 */
	public function locatorMessagePrivate($name)
	{
		$xpath = "#private-$name-error";
		return $xpath;
	}

	/**
	 * @param $name
	 * @since 2.1.2
	 * @return string
	 */
	public function locatorMessageCompany($name)
	{
		$xpath = "#company-$name-error";
		return $xpath;
	}

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $quantity1 = "(//span[@class='update_cart'])[1]";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $quantity2 = "(//span[@class='update_cart'])[2]";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $labelPayment = "//h3[contains(text(),'Payment Method')]";

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $quantityFieldCart = '//input[@name="quantity"]';

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $totalFinalCheckout = '(//div[@class="form-group total"])/div';

	/**
	 * @var string
	 * @since 2.1.2
	 */
	public static $errorAddToCart = 'Product was not added to cart';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $paymentBankTransferDiscount = "//input[@value='rs_payment_banktransfer_discount']";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $submitCurrent = 'Change Currency';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $productPrice = '#product_price';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $priceDenmark = 'DKK';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $page = 'Product Front End Page';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $currencyChooseButton = '#product_currency';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $mostSoldProducts = 'Most Sold Products';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $latestProducts = 'Latest Products';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $newestProducts = 'Newest Products';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $nameProductNewest = '(//div[@class =\'current\']/dd/div/div/p/a)[1]';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $namProductsLatest = '(//div[@class =\'current\']/dd/div/div/p/a)[2]';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $nameProductSold = '(//div[@class =\'current\']/dd/div/div/p/a)[3]';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $discount = '#mod_redmainprice';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $valueDiscount = '//div[@class="mod_discount_main"]//td[2]';

	/**
	 * @var string
	 * @since 3.0.1
	 */
	public static $nameProduct1OnCart = "//tr[1]/td[1]";

	/**
	 * @var string
	 * @since 3.0.1
	 */
	public static $nameProduct2OnCart = "//tr[2]/td[1]";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $shippingWithVat = '#spnShippingrate';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $iconShippingRate = "//input[@onclick=\"javascript:onestepCheckoutProcess(this.name,'giaohangnhanh');\"]";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $iconShippingGLS = "//input[@onclick=\"javascript:onestepCheckoutProcess(this.name,'default_shipping_gls');\"]";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $iconShippingGLSBusiness = "//input[@onclick=\"javascript:onestepCheckoutProcess(this.name,'default_shipping_glsbusiness');\"]";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $iconSelfPickup = "//input[@onclick=\"javascript:onestepCheckoutProcess(this.name,'self_pickup');\"]";

	/**
	 * Function to get the Path $position for Attribute Dropdown List
	 *
	 * @param $position
	 *
	 * @return string
	 */
	public function attributeDropdown($position)
	{
		$xpath = "//span[@id='select2-chosen-$position']";

		return $xpath;
	}

	/**
	 * Function to get the Path $position for Attribute Dropdown Search
	 *
	 * @param $position
	 *
	 * @return string
	 */
	public function attributeDropdownSearch($position)
	{
		$xpath = "#s2id_autogen".$position."_search";

		return $xpath;
	}
	/**
	 * @var array
	 */
	public static $attributeSearchFirst = "//input[@id='s2id_autogen1_search']";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $radioShippingRate = '//label[@class="radio inline"]';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $radioPayment = '//label[@class="radio"]';

	/**
	 * @var string
	 * @since 2.1.6
	 */
	public static $containerSelect = "(//div[@class='select2-container'])[2]";

	/**
	 * @var string
	 * @since 2.1.6
	 */
	public static $select2Input = "//div[@id='select2-drop']//input";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $quantityOrderReceipt = '//div[@class="update_cart"]';

	/**
	 * Function to get the Path for Category on the FrontEnd Page
	 *
	 * @param   String $categoryName Name of the Category
	 *
	 * @return string
	 * @since 1.4.0
	 */
	public function productCategory($categoryName)
	{
		$path = "//a[text() = '" . $categoryName . "']";

		return $path;
	}

	/**
	 * Function to get the Path for Product
	 *
	 * @param   String $productName Name of the Product
	 *
	 * @return string
	 * @since 1.4.0
	 */
	public function product($productName)
	{
		$path = "//a[text() = '" . $productName . "']";

		return $path;
	}

	/**
	 * Function to return path of the Product on the Final Receipt Page
	 *
	 * @param   String $productName Name of the Product
	 *
	 * @return string
	 * @since 1.4.0
	 */
	public function finalCheckout($productName)
	{
		$path = "//div/a[text()='" . $productName . "']";

		return $path;
	}

	/**
	 * Function to get Path $productName in Product
	 *
	 * @param String $productName Name of the Product
	 *
	 * @return string
	 * @since 1.4.0
	 */
	public function productName($productName)
	{
		$path = "//div[text()='" . $productName . "']";

		return $path;
	}

	/**
	 * @param $position
	 * @return string
	 * @since 2.1.3
	 */
	public function nameRedSHOPProduct($position)
	{
		$xpath = "(//div[@class='mod_redshop_products_title'])[$position]";

		return $xpath;
	}

	/**
	 * Shopper group product header in frontend
	 * @var string
	 * @since 2.1.3
	 */
	public static $shopperGroupProductHeader = "redSHOP - ShopperGroup Product";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $selectorPageHeader = "//h3[contains(text(),'redSHOP - ShopperGroup Product')]";

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $priceWhoBought = '.priceWhoBought';

	/**
	 * @var string
	 * @since 2.1.3
	 */
	public static $btnAddToCartWhoBought = '.addToCartWhoBought';

	/**
	 * @param $name
	 * @return string
	 * @since 2.1.3
	 */
	public function nameModule($name)
	{
		$xpath = "//h3[contains(text(),'$name')]";
		return $xpath;
	}

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $eanPayment = "#rs_payment_eantransfer2";

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $klarnaPayment = "#klarna2";

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $fieldPNO = "#rs_pno";

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $tableCart = "//table[@class='table table-striped']";

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $columnProduct = "//table[@class='table table-striped']//tbody/tr/td[1]";

	/**
	 * @var string
	 * @since 2.1.4
	 */
	public static $buttonEmptyCart = '//input[@onclick = "document.empty_cart.submit();"]';

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $productRelatedTitle = "//div[@class='mod_redshop_products_title']";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $addToCartProductRelated = "//div[@class='mod_redshop_products_addtocart']//span[contains(text(),'Add to cart')]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $productFirst = "(//div[@class='category_box_inside'])[1]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $productSecond = "(//div[@class='category_box_inside'])[2]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $buttonWriteReview = "//a[contains(text(),'Write review')]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $buttonWriteQuestion = "//a[contains(text(),'Ask Question About Product')]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $buttonShowMap = "//input[@id='showMap_input']";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $inputMap = "//input[@id='mapSeachBox']";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $firstAddress = "(//td[@class = 'radio_point_container'])[1]";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $saveAddressOnMap = "//div[@id='pickupLocations']//div[1]//div[@class = 'map-button-save']";

	/**
	 * @var string
	 * @since 3.0.2
	 */
	public static $nameIframe = "question-iframe";

	/**
	 * @return string
	 * @since 3.0.2
	 */
	public function jQueryIframe()
	{
		return 'jQuery(".iframe").attr("name", "question-iframe")';
	}

	/**
	 * @param $idProduct
	 * @param $position
	 * @return string
	 * @since 3.0.2
	 */
	public function checkboxChooseProductAccessories($idProduct, $position)
	{
		return "(//input[@name='accessory_id_".$idProduct."[]'])[".$position."]";
	}

	/**
	 * @param $productName
	 * @return string
	 * @since 3.0.2
	 */
	public function xpathProductAccessorieName($productName)
	{
		return "//label[contains(text(),'". $productName . "')]";
	}

	/**
	 * @param $shippingName
	 * @return string
	 * @since 3.0.3
	 */
	public function xpathShippingName($shippingName)
	{
		return "//span[contains(text(),'". $shippingName . "')]";
	}
}
