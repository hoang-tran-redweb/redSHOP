<?php
/**
 * @package     RedShop
 * @subpackage  Cest
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Cest;

use Codeception\Scenario;
use Faker\Factory;
use Faker\Generator;
use function get_called_class;
use Step\AbstractStep;
use function str_replace;
use function ucfirst;

/**
 * Class Abstract cest
 *
 * @package  AcceptanceTester
 *
 * @link     http://codeception.com/docs/07-AdvancedUsage
 *
 * @since    2.0
 */
class AbstractCest
{
	/**
	 * @var  Generator
	 */
	public $faker;

	/**
	 * @var  string
	 */
	public $className;

	/**
	 * @var  string
	 */
	public $stepClass;

	/**
	 * @var  string
	 */
	public $pageClass;

	/**
	 * @var array
	 */
	public $formFields = array();

	/**
	 * @var array
	 */
	public $dataNew = array();

	/**
	 * @var array
	 */
	public $dataEdit = array();

	/**
	 * Name field, which is use for search
	 *
	 * @var string
	 */
	public $nameField = '';

	/**
	 * CountryCest constructor.
	 */
	public function __construct()
	{
		$this->faker      = Factory::create();
		$this->className  = get_called_class();
		$this->stepClass  = 'AcceptanceTester\\' . str_replace('Cest', 'Steps', $this->className);
		$this->pageClass  = str_replace('Cest', 'Page', $this->className);
		$this->className  = ucfirst(str_replace('Cest', '', $this->className));
		$this->dataNew    = $this->prepareNewData();
		$this->dataEdit   = $this->prepareEditData();
		$this->formFields = $this->prepareFormFields();
	}

	/**
	 * Method run before
	 *
	 * @param   \AcceptanceTester $tester Acceptance tester
	 *
	 * @return  void
	 */
	public function _before(\AcceptanceTester $tester)
	{
		$tester->doAdministratorLogin();
	}

	/**
	 * Method for set new data.
	 *
	 * @return  array
	 */
	protected function prepareNewData()
	{
		return array();
	}

	/**
	 * Method for set new data.
	 *
	 * @return  array
	 */
	protected function prepareEditData()
	{
		return array();
	}

	/**
	 * Method for set form fields.
	 *
	 * @return  array
	 */
	protected function prepareFormFields()
	{
		return array();
	}

	/**
	 * Method for test create item
	 *
	 * @param   \AcceptanceTester  $tester    Tester
	 * @param   Scenario           $scenario  Scenario
	 *
	 * @return  void
	 */
	public function testCreateItem(\AcceptanceTester $tester, Scenario $scenario)
	{
		$tester->wantTo('Administrator > Test create new ' . $this->className . ' item.');
		$stepClass = $this->stepClass;

		/** @var AbstractStep $step */
		$step = new $stepClass($scenario);
		$step->addNewItem($this->pageClass, $this->formFields, $this->dataNew);
	}

	/**
	 * Method for test edit item
	 *
	 * @param   \AcceptanceTester  $tester    Tester
	 * @param   Scenario           $scenario  Scenario
	 *
	 * @return  void
	 */
	public function testEditItem(\AcceptanceTester $tester, Scenario $scenario)
	{
		$tester->wantTo('Administrator > Test edit ' . $this->className . ' item.');
		$stepClass = $this->stepClass;

		/** @var AbstractStep $step */
		$step = new $stepClass($scenario);
		$step->editItem($this->pageClass, $this->dataNew[$this->nameField], $this->formFields, $this->dataEdit);
	}
}
