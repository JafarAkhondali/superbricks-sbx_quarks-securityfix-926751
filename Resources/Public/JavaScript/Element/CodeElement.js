var Form;
(function (Form) {
    var Element;
    (function (Element) {
        var CodeElement = (function () {
            function CodeElement(element) {
                this.element = element;
            }
            return CodeElement;
        }());
        Element.CodeElement = CodeElement;
    })(Element = Form.Element || (Form.Element = {}));
})(Form || (Form = {}));
/// <reference path="../../../Build/node_modules/@types/ace/index.d.ts" />
var CodeElement = Form.Element.CodeElement;
var Form;
(function (Form) {
    var Factory;
    (function (Factory) {
        var CodeElementFactory = (function () {
            function CodeElementFactory(ace) {
                this.ace = ace;
            }
            CodeElementFactory.prototype.instantiate = function (element) {
                var editingContainer = document.querySelector('[data-textarea-id="' + element.id + '"]');
                var editor = this.ace.edit(editingContainer);
                editor.$blockScrolling = Infinity;
                editor.setTheme("ace/theme/monokai");
                console.log(element.dataset);
                editor.getSession().setMode("ace/mode/" + element.dataset.codeLang);
                editor.setOptions({
                    maxLines: 30,
                    minLines: 13
                });
                editor.setValue(element.value, 1);
                element.classList.add('hidden');
                editingContainer.classList.remove('hidden');
                var target = element;
                var source = editor;
                editor.getSession().on('change', function (e) {
                    target.value = source.getValue();
                });
                // const instance = new CodeElement(element);
                // this.instances.push(instance);
            };
            return CodeElementFactory;
        }());
        Factory.CodeElementFactory = CodeElementFactory;
    })(Factory = Form.Factory || (Form.Factory = {}));
})(Form || (Form = {}));
/// <reference path="../../Classes/Form/Element/CodeElement.ts" />
/// <reference path="../../Classes/Form/Factory/CodeElementFactory.ts" />
/// <reference path="../../Build/node_modules/@types/jquery/index.d.ts" />
/// <reference path="../../Build/node_modules/@types/ace/index.d.ts" />
var CodeElementFactory = Form.Factory.CodeElementFactory;
require.config({
    baseUrl: window.location.protocol + "//" + window.location.host + window.location.pathname.split("/").slice(0, -2).join("/"),
    paths: {
        ace: "typo3conf/ext/sbx_quarks/Resources/Public/JavaScript/Contrib/ace/lib/ace"
    }
});
require(["jquery", "ace/ace"], function ($, ace) {
    $(document).ready(function () {
        var codeElementFactory = new CodeElementFactory(ace);
        var editorElements = document.getElementsByClassName('enable-ace-editor');
        for (var i = 0; i < editorElements.length; i++) {
            codeElementFactory.instantiate(editorElements[i]);
        }
    });
});
