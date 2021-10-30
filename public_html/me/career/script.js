import { router } from "../../router.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});
import(router() + "/Components/Career/career.js").then((module) => {
    module.career();
});
import(router() + "/Components/GlobalFooter/globalFooter.js").then((module) => {
    module.globalFooter();
});