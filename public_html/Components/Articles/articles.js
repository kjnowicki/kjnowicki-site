import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/Articles/";
const name = "articles";
const tag = "articles";

class Articles extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function articles() { window.customElements.define(tag, Articles); }