<?php
namespace TYPO3\CMS\Extbase\Domain\Model;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
/**
 * A file object (File Abstraction Layer)
 *
 * @api experimental! This class is experimental and subject to change!
 */
class File extends \TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder {

	/**
	 * @return \TYPO3\CMS\Core\Resource\File
	 */
	public function getOriginalResource() {
		if ($this->originalResource === NULL) {
			$this->originalResource = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->getFileObject($this->getUid());
		}

		return $this->originalResource;
	}
}
