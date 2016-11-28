<?php
namespace SuperBricks\Quarks\Form\Element;

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

use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Fluid\View\TemplatePaths;

/**
 * Class CodeElement
 */
class CodeElement extends AbstractFormElement
{
    /**
     *
     */
    public function render()
    {
        // note that there are empty keys. they are set here to prevent errors in the
        return [
            'html' => $this->buildHtml(),
            'requireJsModules' => [
                'TYPO3/CMS/SbxQuarks/Element/CodeElement',
            ],
            'additionalJavaScriptPost' => [],
            'additionalJavaScriptSubmit' => [],
            'additionalHiddenFields' => [],
            'stylesheetFiles' => [],
        ];
    }

    /**
     * @return string
     */
    protected function buildHtml()
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->getRenderingContext()->getTemplatePaths()->fillDefaultsByPackageName('sbx_quarks');
        $view->getRenderingContext()->setControllerName('Form/Element');
        $view->assignMultiple(
            [
                'attributes' => [
                    'id' => $this->data['parameterArray']['itemFormElID'],
                    'class' => 'form-control formengine-textarea text-monospace t3js-enable-tab enable-ace-editor',
                    'name' => $this->data['parameterArray']['itemFormElName'],
                    'style' => $this->getStyles(),
                    'rows' => $this->getRows(),
                    'maxlength' => $this->getMaxLength(),
                    'placeholder' => $this->getPlaceholder(),
                    'onChange' => implode(' ', $this->data['parameterArray']['fieldChangeFunc']),
                    'data-code-lang' => $this->data['databaseRow']['tx_quarks_code_element_code_language'][0],
                ],
                'data' => [
                    'content' => $this->data['parameterArray']['itemFormElValue'],
                ],
            ]
        );

        $html = $view->render('CodeElement');

        if ($this->hasFieldConfig('wizards')) {
            if (isset($this->data['parameterArray']['fieldConf']['defaultExtras'])) {
                $specialConfiguration = (array)BackendUtility::getSpecConfParts(
                    $this->data['parameterArray']['fieldConf']['defaultExtras']
                );
            } else {
                $specialConfiguration = [];
            }

            $html = $this->renderWizards(
                [$html],
                $this->getFieldConfig('wizards'),
                $this->data['tableName'],
                $this->data['databaseRow'],
                $this->data['fieldName'],
                $this->data['parameterArray'],
                $this->data['parameterArray']['itemFormElName'],
                $specialConfiguration,
                false
            );
        }

        return $html;
    }

    /**
     * @return int
     */
    protected function getRows()
    {
        $rows = 10;
        if ($this->hasFieldConfig('rows')) {
            $rows = MathUtility::forceIntegerInRange($this->getFieldConfig('rows'), 1, 20);
        }
        return $rows;
    }

    /**
     * @return string
     */
    protected function getStyles()
    {
        $styles = '';
        if (($maxTextAreaHeight = (int)$this->getBackendUserAuthentication()->uc['resizeTextareas_MaxHeight']) > 0) {
            $styles .= sprintf('max-height: %dpx', $maxTextAreaHeight);
        }
        return $styles;
    }

    /**
     * @return string
     */
    protected function getMaxLength()
    {
        $maxLength = '';
        if ($this->hasFieldConfig('max')) {
            $maxLength = (string)MathUtility::forceIntegerInRange($this->getFieldConfig('max'), 1, 20);
        }
        return $maxLength;
    }

    /**
     * @return string
     */
    protected function getPlaceholder()
    {
        $placeholder = '';
        if ($this->hasFieldConfig('placeholder')) {
            $placeholder .= htmlspecialchars(trim($this->getFieldConfig('placeholder')));
        }
        return $placeholder;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function hasFieldConfig($name)
    {
        return isset($this->data['parameterArray']['fieldConf']['config'][$name]);
    }

    /**
     * @param string $name
     * @return string|array|int
     */
    protected function getFieldConfig($name)
    {
        return $this->data['parameterArray']['fieldConf']['config'][$name];
    }

    /**
     * @return BackendUserAuthentication
     *
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    protected function getBackendUserAuthentication()
    {
        return $GLOBALS['BE_USER'];
    }
}
