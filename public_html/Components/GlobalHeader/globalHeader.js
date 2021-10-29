import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/GlobalHeader/";
const name = "globalHeader";
const tag = "global-header";

class GlobalHeader extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function globalHeader() { window.customElements.define(tag, GlobalHeader); }