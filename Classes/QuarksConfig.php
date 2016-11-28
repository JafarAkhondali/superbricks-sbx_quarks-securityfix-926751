<?php
namespace SuperBricks\Quarks;

/**
 * Copyright (C) 2016 SuperBricks
 * Authors:
 *  Oliver Eglseder <php@vxvr.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;

/**
 * Class QuarksConfig
 */
class QuarksConfig implements SingletonInterface
{
    /**
     * Provide default values for all options, so that isset/empty check may be omitted
     *
     * @var array
     */
    protected $config = [
        'elements' => [
            'codeElement' => true,
        ],
    ];

    /**
     * QuarksConfig constructor.
     */
    public function __construct()
    {
        $this->config = ArrayUtility::arrayMergeRecursiveOverrule($this->config, unserialize($this->getExtConf()));
    }

    /**
     * @return bool
     */
    public function isCodeElementEnabled()
    {
        return true === $this->config['elements']['codeElement'];
    }

    /**
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function getExtConf()
    {
        return $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['sbx_quarks'] ?? 'a:0:{}';
    }
}
