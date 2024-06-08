import { globalHeader } from "./Components/GlobalHeader/globalHeader.js";
import { navigationCard } from "./Components/NavigationCard/navigationCard.js"
import { globalFooter } from './Components/GlobalFooter/globalFooter.js';
import { contentFitting } from './Scripts/globalContent.js';

//components
globalHeader();
navigationCard();
globalFooter();

//scripts
contentFitting();