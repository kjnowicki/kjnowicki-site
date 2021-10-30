import { router } from "../../router.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});
import(router() + "/Components/Articles/articles.js").then((module) => {
    module.articles();
});
import(router() + "/Components/GlobalFooter/globalFooter.js").then((module) => {
    module.globalFooter();
});