const contentResize = () => {
    let contentEl = document.getElementById("global-content");
    let headerEl = document.querySelector("global-header");
    let footerEl = document.querySelector("global-footer");
    contentEl.style.height = 0.97*(window.innerHeight - headerEl.offsetHeight - footerEl.offsetHeight) + "px";
    contentEl.style.overflowY = "auto";
}

export function contentFitting() {
    contentResize();
    window.onresize = () => {
        contentResize();
    }
}