import { router } from "../../router.js";

import(router() + "/Components/GlobalHeader/globalHeader.js").then((module) => {
    module.globalHeader();
});
import(router() + "/Components/AboutMe/aboutMe.js").then((module) => {
    module.aboutMe();
});
import(router() + "/Components/GlobalFooter/globalFooter.js").then((module) => {
    module.globalFooter();
});