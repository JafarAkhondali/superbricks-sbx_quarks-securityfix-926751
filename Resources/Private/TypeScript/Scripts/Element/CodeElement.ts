/// <reference path="../../Classes/Form/Element/CodeElement.ts" />
/// <reference path="../../Classes/Form/Factory/CodeElementFactory.ts" />
/// <reference path="../../Build/node_modules/@types/jquery/index.d.ts" />
/// <reference path="../../Build/node_modules/@types/ace/index.d.ts" />

import CodeElementFactory = Form.Factory.CodeElementFactory;


require.config({
    baseUrl: window.location.protocol + "//" + window.location.host + window.location.pathname.split("/").slice(0, -2).join("/"),

    paths: {
        ace: "typo3conf/ext/sbx_quarks/Resources/Public/JavaScript/Contrib/ace/lib/ace"
    }
});



require(["jquery", "ace/ace"], function ($: JQueryStatic, ace: AceAjax.Ace) {
    $(document).ready(function () {
        const codeElementFactory: CodeElementFactory = new CodeElementFactory(ace);

        const editorElements = document.getElementsByClassName('enable-ace-editor');
        for (let i = 0; i < editorElements.length; i++) {
            codeElementFactory.instantiate(editorElements[i]);
        }
    });
});

