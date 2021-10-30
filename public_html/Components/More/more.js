import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/More/";
const name = "more";
const tag = "more";

class More extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function more() { window.customElements.define(tag, More); }