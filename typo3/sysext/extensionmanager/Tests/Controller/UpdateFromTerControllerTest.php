<?php
	/***************************************************************
	 * Copyright notice
	 *
	 * (c) 2012
	 * All rights reserved
	 *
	 * This script is part of the TYPO3 project. The TYPO3 project is
	 * free software; you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation; either version 2 of the License, or
	 * (at your option) any later version.
	 *
	 * The GNU General Public License can be found at
	 * http://www.gnu.org/copyleft/gpl.html.
	 *
	 * This script is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

	/**
	 * Testcase for the Tx_Extensionmanager_Utility_List class in the TYPO3 Core.
	 *
	 * @package TYPO3
	 * @subpackage extensionmanager
	 */
class Tx_Extensionmanager_Controller_UpdateFromTerControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * Enable backup of global and system variables
	 *
	 * @var boolean
	 */
	protected $backupGlobals = TRUE;

	/**
	 * Exclude TYPO3_DB from backup/ restore of $GLOBALS
	 * because resource types cannot be handled during serializing
	 *
	 * @var array
	 */
	protected $backupGlobalsBlacklist = array('TYPO3_DB');

	/**
	 * @test
	 */
	public function updateExtensionListFromTerCallsUpdateExtListIfLastUpdateIsMoreThan24HoursAgo() {
		$controllerMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Controller_UpdateFromTerController',
			array('dummy')
		);
		$repositoryRepositoryMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Domain_Repository_RepositoryRepository',
			array('findOneByUid')
		);
		$repositoryModelMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Domain_Model_Repository',
			array('getLastUpdate')
		);
		$repositoryHelperMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Utility_Repository_Helper',
			array('updateExtList')
		);
		$viewMock = $this->getAccessibleMock(
			'Tx_Fluid_View_TemplateView',
			array('assign')
		);

		$requestMock = $this->getAccessibleMock(
			'Tx_Extbase_MVC_Request',
			array('hasArgument', 'getArgument')
		);

		$viewMock->expects($this->any())
			->method('assign')
			->will($this->returnValue($viewMock));

		$repositoryModelMock->expects($this->once())
			->method('getLastUpdate')
			->will($this->returnValue(1343234402));

		$repositoryRepositoryMock
			->expects($this->once())
			->method('findOneByUid')
			->with(1)
			->will($this->returnValue($repositoryModelMock));

		$repositoryHelperMock->expects($this->once())
			->method('updateExtList');

		$GLOBALS['EXEC_TIME'] = 1343493602;

		$controllerMock->_set('repositoryRepository', $repositoryRepositoryMock);
		$controllerMock->_set('repositoryHelper', $repositoryHelperMock);
		$controllerMock->_set('settings', array('repositoryUid' => 1));
		$controllerMock->_set('view', $viewMock);
		$controllerMock->_set('request', $requestMock);
		$controllerMock->updateExtensionListFromTerAction();
	}

	/**
	 * @test
	 */
	public function updateExtensionListFromTerCallsUpdateExtListIfForceUpdateCheckIsSet() {
		$controllerMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Controller_UpdateFromTerController',
			array('dummy')
		);
		$repositoryRepositoryMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Domain_Repository_RepositoryRepository',
			array('findOneByUid')
		);
		$repositoryModelMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Domain_Model_Repository',
			array('getLastUpdate')
		);
		$repositoryHelperMock = $this->getAccessibleMock(
			'Tx_Extensionmanager_Utility_Repository_Helper',
			array('updateExtList')
		);
		$viewMock = $this->getAccessibleMock(
			'Tx_Fluid_View_TemplateView',
			array('assign')
		);

		$requestMock = $this->getAccessibleMock(
			'Tx_Extbase_MVC_Request',
			array('hasArgument', 'getArgument')
		);

		$requestMock->expects($this->once())
			->method('hasArgument')
			->will($this->returnValue(TRUE));

		$requestMock->expects($this->once())
			->method('getArgument')
			->will($this->returnValue(TRUE));

		$viewMock->expects($this->any())
			->method('assign')
			->will($this->returnValue($viewMock));

		$repositoryModelMock->expects($this->once())
			->method('getLastUpdate')
			->will($this->returnValue(1343493602));

		$repositoryRepositoryMock
			->expects($this->once())
			->method('findOneByUid')
			->with(1)
			->will($this->returnValue($repositoryModelMock));

		$repositoryHelperMock->expects($this->once())
			->method('updateExtList');

		$GLOBALS['EXEC_TIME'] = 1343493602;

		$controllerMock->_set('repositoryRepository', $repositoryRepositoryMock);
		$controllerMock->_set('repositoryHelper', $repositoryHelperMock);
		$controllerMock->_set('settings', array('repositoryUid' => 1));
		$controllerMock->_set('view', $viewMock);
		$controllerMock->_set('request', $requestMock);
		$controllerMock->updateExtensionListFromTerAction();
	}
}