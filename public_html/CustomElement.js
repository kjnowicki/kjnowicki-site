export class CustomElement extends HTMLElement {
    constructor(path, name) {
        super();
        this.innerHTML = "Loading...";
        this.loadContent(path, name);
    }

    async loadContent(path, name) {
        const source = path + name + ".html";
        var content = "Couldn't load the resources of the component."
        if(!source) {
            console.log("No 'src' attribute for the element.");
        }
        const response = await fetch(source);
        if (response.status != 200) {
            console.log(`Couldn't load the resources from: ${source}`);
        }
        content = await response.text();
        this.innerHTML = content;
    }
}