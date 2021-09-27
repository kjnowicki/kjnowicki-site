import { CustomElement } from "../../CustomElement.js";

const path = "Components/GlobalFooter/";
const name = "globalFooter";
const tag = "global-footer";

class GlobalFooter extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function globalFooter() { window.customElements.define(tag, GlobalFooter); }