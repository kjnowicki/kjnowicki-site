import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/Career/";
const name = "career";
const tag = "career";

class Career extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function career() { window.customElements.define(tag, Career); }