<?php

(function () {
    $quarksConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\SuperBricks\Quarks\QuarksConfig::class);
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

    if ($quarksConfig->isCodeElementEnabled()) {
        $iconRegistry->registerIcon(
            'content-code_element',
            \TYPO3\CMS\Core\Imaging\IconProvider\FontawesomeIconProvider::class,
            ['name' => 'code']
        );
        $iconRegistry->registerIcon(
            'content-code_element-code_language-php',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:sbx_quarks/Resources/Public/Icons/Elements/php.svg']
        );
        $iconRegistry->registerIcon(
            'content-code_element-code_language-javascript',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:sbx_quarks/Resources/Public/Icons/Elements/javascript.svg']
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:sbx_quarks/Configuration/TSconfig/Page/Element/CodeElement.t3s">'
        );
    }
})();
