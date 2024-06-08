import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/GlobalHeader/";
const name = "globalHeader";
const tag = "global-header";

class GlobalHeader extends CustomElement {
    constructor() {
        super(path, name);
        window.onload = () => {
            this.home_link();
        }
    }

    home_link = function () {
        var checkEl = setInterval(() => {
            let el = document.querySelector("#header h1");
            if(el){
                el.addEventListener('click', () => {
                    window.location.href = router();
                })
                clearInterval(checkEl);
            }
        }, 100);
    }
}

export function globalHeader() { window.customElements.define(tag, GlobalHeader); }