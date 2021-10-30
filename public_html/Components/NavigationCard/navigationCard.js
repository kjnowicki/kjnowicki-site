import { router } from "../../router.js";
import { CustomElement } from "../../CustomElement.js";

const path = router() + "/Components/NavigationCard/";
const name = "navigationCard";
const tag = "nav-card";

class NavigationCard extends CustomElement {
    constructor() {
        super(path, name);
        window.onload = () => {
            this.linking();
        }
    }

    linking = function () {
        var checkEl = setInterval(() => {
            let elements = document.querySelectorAll("nav-card a");
            if(elements.length > 0) {
                elements.forEach(element => {
                    let url = router() + element.getAttribute('url');
                    element.addEventListener('click',() => {
                        window.location.href = url;
                    });
                });
                clearInterval(checkEl);
            }
        }, 100)
    }
}

export function navigationCard() { window.customElements.define(tag, NavigationCard); }