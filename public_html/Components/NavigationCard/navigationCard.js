import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/NavigationCard/";
const name = "navigationCard";
const tag = "nav-card";

class NavigationCard extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function navigationCard() { window.customElements.define(tag, NavigationCard); }