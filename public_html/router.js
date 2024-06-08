var root = document.location.origin;
if(root.includes('localhost')) root += '/kjnowicki-site/public_html'

export function router(){ return root; };