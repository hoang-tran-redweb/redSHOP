<?php
/**
 * @package     redSHOP
 * @subpackage  Cest
 * @copyright   Copyright (C) 2008 - 2020 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Cest\AbstractCest;

/**
 * Class TextCest
 *
 * @package  AcceptanceTester
 *
 * @link     http://codeception.com/docs/07-AdvancedUsage
 *
 * @since    1.4.0
 */
class TextCest extends AbstractCest
{
	use Cest\Traits\CheckIn, Cest\Traits\Publish, Cest\Traits\Delete;

	/**
	 * Name field, which is use for search
	 *
	 * @var string
	 * @since 1.4.0
	 */
	public $nameField = 'name';

	/**
	 * Method for set new data.
	 *
	 * @return  array
	 * @since 1.4.0
	 */
	protected function prepareNewData()
	{
		return array(
			'name'        => $this->faker->bothify('ManageTextLibraryAdministratorCest ?##?'),
			'description' => $this->faker->bothify('ManageTextLibraryAdministratorCest Description ?##?'),
			'section'     => 'product'
		);
	}

	/**
	 * Abstract method for run after complete create item.
	 *
	 * @param   \AcceptanceTester      $tester    Tester
	 * @param   \Codeception\Scenario  $scenario  Scenario
	 *
	 * @return  void
	 *
	 * @depends testItemCreate
	 * @since 1.4.0
	 */
	public function deleteDataSave(\AcceptanceTester $tester, \Codeception\Scenario $scenario)
	{
		$tester->wantTo('Run after create item with save button ');
		$stepClass = $this->stepClass;

		/** @var TextSteps $tester */
		$tester = new $stepClass($scenario);
		$tester->deleteItem($this->dataNew['name']);
	}

	/**
	 * Abstract method for run after complete create item.
	 *
	 * @param   \AcceptanceTester      $tester    Tester
	 * @param   \Codeception\Scenario  $scenario  Scenario
	 *
	 * @return  void
	 * @since 1.4.0
	 * @depends testItemCreateSaveClose
	 */
	public function deleteDataSaveClose(\AcceptanceTester $tester, \Codeception\Scenario $scenario)
	{
		$tester->wantTo('Run after create item with save button ');
		$stepClass = $this->stepClass;

		/** @var CategorySteps $tester */
		$tester = new $stepClass($scenario);
		$tester->deleteItem($this->dataNew['name']);

	}

	/**
	 * Method for set new data.
	 * @since 1.4.0
	 * @return  array
	 */
	protected function prepareEditData()
	{
		return array(
			'name'        => 'Updated ' . $this->dataNew['name'],
			'description' => $this->dataNew['description'],
			'section'     => 'product'
		);
	}
}

