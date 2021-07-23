import { CustomElement } from "../../CustomElement.js";

const path = "Components/GlobalHeader/";
const name = "globalHeader";
const tag = "global-header";

class GlobalHeader extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function globalHeader() { window.customElements.define(tag, GlobalHeader); }