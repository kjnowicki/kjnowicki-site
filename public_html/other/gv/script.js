import { router } from "../../router.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});