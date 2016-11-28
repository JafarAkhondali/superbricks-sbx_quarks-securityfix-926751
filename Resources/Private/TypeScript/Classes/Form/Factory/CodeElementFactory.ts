/// <reference path="../../../Build/node_modules/@types/ace/index.d.ts" />

import CodeElement = Form.Element.CodeElement;

module Form.Factory {
    export class CodeElementFactory {
        protected ace: AceAjax.Ace;
        protected instances: Array<CodeElement>;

        constructor(ace: AceAjax.Ace) {
            this.ace = ace;
        }

        public instantiate(element:HTMLElement|Element) {
            const editingContainer = document.querySelector('[data-textarea-id="' + element.id + '"]');
            const editor = this.ace.edit(editingContainer);
            editor.$blockScrolling = Infinity;
            editor.setTheme("ace/theme/monokai");
            console.log(element);

            editor.getSession().setMode("ace/mode/" + element.dataset.codeLang);
            editor.setOptions({
                maxLines: 30,
                minLines: 13,
            });
            editor.setValue(element.value, 1);
            element.classList.add('hidden');
            editingContainer.classList.remove('hidden');

            let target = element;
            let source = editor;
            editor.getSession().on('change', function (e) {
                target.value = source.getValue();
            });

            // const instance = new CodeElement(element);
            // this.instances.push(instance);
        }
    }
}
