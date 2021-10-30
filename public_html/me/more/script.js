import { router } from "../../router.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});
import(router() + "/Components/More/more.js").then((module) => {
    module.more();
});
import(router() + "/Components/GlobalFooter/globalFooter.js").then((module) => {
    module.globalFooter();
});