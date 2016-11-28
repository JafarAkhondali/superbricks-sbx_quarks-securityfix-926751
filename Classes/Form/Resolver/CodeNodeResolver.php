<?php
namespace SuperBricks\Quarks\Form\Resolver;

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

use SuperBricks\Quarks\Form\Element\CodeElement;
use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Backend\Form\NodeResolverInterface;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * Class CodeNodeResolver
 */
class CodeNodeResolver implements NodeResolverInterface
{
    /**
     * @var NodeFactory
     */
    protected $nodeFactory = null;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * CodeNodeResolver constructor.
     * @param NodeFactory $nodeFactory
     * @param array $data
     */
    public function __construct(NodeFactory $nodeFactory, array $data)
    {
        $this->nodeFactory = $nodeFactory;
        $this->data = $data;
    }

    /**
     * @return null|string
     */
    public function resolve()
    {
        if (isset($this->data['parameterArray']['fieldConf']['defaultExtras'])) {
            $extras = BackendUtility::getSpecConfParts(
                $this->data['parameterArray']['fieldConf']['defaultExtras']
            );
            if (isset($extras['enableAceEditor']) && true === (bool)$extras['enableAceEditor']) {
                return CodeElement::class;
            }
        }
        return null;
    }
}
