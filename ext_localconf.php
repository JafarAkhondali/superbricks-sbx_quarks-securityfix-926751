<?php
(function () {
    $quarksConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\SuperBricks\Quarks\QuarksConfig::class);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sbx_quarks/Configuration/TypoScript/ElementDefaults.t3s">'
    );

    if ($quarksConfig->isCodeElementEnabled()) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1479582265] = [
            'nodeName' => 'text',
            'priority' => 50,
            'class' => \SuperBricks\Quarks\Form\Resolver\CodeNodeResolver::class,
        ];
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sbx_quarks/Configuration/TypoScript/Element/CodeElement.t3s">'
        );
    }
})();
