export class CustomElement extends HTMLElement {
    constructor(path, name) {
        super();
        this.innerHTML = "Loading...";
        this.loadContent(path, name);
        this.appendStyle(path, name);
    }

    async loadContent(path, name) {
        const source = path + name + ".html";
        var content = "Couldn't load the resources of the component."

        const response = await fetch(source);
        if (response.status != 200) {
            console.log(`Couldn't load the resources from: ${source}`);
        }
        content = await response.text();
        let contentAttr = this.attributes.getNamedItem("content");
        if (contentAttr != null) {
            let contentVarsMatches = content.matchAll("\{([A-z]{0,})\}");
            const content_constants = await (await fetch(path + name + "Constants.txt")).text();
            content = this.getContentWithVars(content, contentVarsMatches, contentAttr.value, content_constants)
        }
        this.innerHTML = content;
    }

    async appendStyle(_path, _name) {
        if (document.getElementById("style." + _name) != null) return;

        let style = document.createElement("link");
        style.setAttribute("id", "style." + _name);
        style.setAttribute("rel", "stylesheet");
        style.setAttribute("href", _path + _name + ".css");
        document.head.appendChild(style);
    }

    getContentWithVars(_content, _contentVarsMatches, _contentAttrName, _content_constants) {
        do {
            let contentVarMatch = _contentVarsMatches.next();
            let contentVarValue = contentVarMatch.value;
            if (contentVarValue != undefined) {
                let fullAttributeName = [_contentAttrName, contentVarValue[1]].join(".");
                let contentAttrValue = _content_constants.match(fullAttributeName + '=(.*)')[1];
                _content = _content.replace(`${contentVarValue[0]}`, contentAttrValue)
            }
            else {
                break;
            }
        } while (true);
        return (_content);
    }
}