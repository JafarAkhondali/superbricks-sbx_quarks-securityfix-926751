<?php
(function () {
    $quarksConfig = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \SuperBricks\Quarks\QuarksConfig::class
    );

    if ($quarksConfig->isCodeElementEnabled()) {
        \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
            $GLOBALS['TCA']['tt_content'],
            [
                'ctrl' => [
                    'requestUpdate' => $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',tx_quarks_code_element_code_language',
                    'typeicon_classes' => [
                        'code_element' => 'content-code_element',
                    ],
                ],
                'types' => [
                    'code_element' => [
                        'showitem' => '
                        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                        tx_quarks_code_element_code_language,
                        tx_quarks_code_element_code,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
                        --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
                        categories',
                    ],
                ],
                'columns' => [
                    'CType' => [
                        'config' => [
                            'items' => [
                                1480021370 => [
                                    'LLL:EXT:sbx_quarks/Resources/Private/Language/locallang.xlf:element.code_element.title',
                                    'code_element',
                                    'content-code_element',
                                ],
                            ],
                        ],
                    ],
                    'tx_quarks_code_element_code_language' => [
                        'label' => 'LLL:EXT:sbx_quarks/Resources/Private/Language/locallang.xlf:element.code_element.field.tx_quarks_code_element_code_language',
                        'exclude' => true,
                        'config' => [
                            'type' => 'select',
                            'items' => [
                                ['PHP', 'php', 'content-code_element-code_language-php'],
                                ['JavaScript', 'javascript', 'content-code_element-code_language-javascript'],
                            ],
                            'renderType' => 'selectSingle',
                            'maxitems' => 1,
                            'size' => 1,
                        ],
                    ],
                    'tx_quarks_code_element_code' => [
                        'label' => 'LLL:EXT:sbx_quarks/Resources/Private/Language/locallang.xlf:element.code_element.field.tx_quarks_code_element_code',
                        'exclude' => true,
                        'defaultExtras' => 'enableAceEditor',
                        'config' => [
                            'type' => 'text',
                        ],
                    ],
                ],
            ]
        );
    }
})();
