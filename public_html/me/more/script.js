import { router } from "../../router.js";
import { linker } from "../../linker.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});
import(router() + "/Components/GlobalFooter/globalFooter.js").then((module) => {
    module.globalFooter();
});

linker("#content a");