import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/AboutMe/";
const name = "aboutMe";
const tag = "about-me";

class AboutMe extends CustomElement {
    constructor() {
        super(path, name);
    }
}

export function aboutMe() { window.customElements.define(tag, AboutMe); }