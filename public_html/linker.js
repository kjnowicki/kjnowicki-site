import { router } from "./router.js";

const linking = function (locator) {
    var checkEl = setInterval(() => {
        let elements = document.querySelectorAll(locator);
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

export const linker = linking;