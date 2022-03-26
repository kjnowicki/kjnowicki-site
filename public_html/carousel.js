const css = (el) => {
    var sheets = document.styleSheets, ret = [];
    el.matches = el.matches || el.webkitMatchesSelector || el.mozMatchesSelector 
        || el.msMatchesSelector || el.oMatchesSelector;
    for (var i in sheets) {
        var rules = sheets[i].cssRules;
        for (var r in rules) {
            if (el.matches(rules[r].selectorText)) {
                ret.push(rules[r].cssText);
            }
        }
    }
    return ret;
}

function mod(n, m) {
    return ((n % m) + m) % m;
}

var click = false;
var idle = true;
var rotate_enabled = false;
var previous_position = 0;
var currently_updating = false;
var adjusting_timeout = null;
var current_angle = 0;

const rotate_carousel_on_click = (element) => {
    if(!rotate_enabled && !currently_updating && click){
        idle = false;
        if(rotate_enabled) return;
        if(adjusting_timeout != null) clearTimeout(adjusting_timeout);
        let css_rotateY_val = Number(css(element.parentElement).join().match(/rotateY\(([-0-9]{1,3})deg\)/)[1]);
        document.querySelector("#carousel").style.transform = `rotateY(${-css_rotateY_val}deg)`;
        current_angle = -css_rotateY_val;
    }
}
const attach_carousel_listeners = () => {
    let el = document.getElementById("carousel");
    el.onmousedown = (e) => {
        previous_position = e.clientX;
        rotate_enabled = true;
    }
    el.ontouchstart = (e) => {
        previous_position = e.touches[0].clientX;
        rotate_enabled = true;
    }
}
const update_click = () => {
    click = true;
}

document.onmouseup = () => {
    rotate_enabled = false;
}

const rotating_carousel = (x) => {
    let carousel_el = document.querySelector("#carousel");
    let relative_dif = (previous_position - x) / window.innerWidth;
    let angle = current_angle - 180*relative_dif*0.45;
    if(Math.abs(angle - current_angle) < 2) return;
    clearTimeout(adjusting_timeout);
    currently_updating = true;
    click = false;
    idle = false;
    setTimeout(() => {
        carousel_el.style.transform = `rotateY(${angle}deg)`;
        current_angle = angle;
        previous_position = x;
        currently_updating = false;
        adjusting_timeout = setTimeout(() => {
            if(Math.abs(mod(angle + 11, 55) < 22 && !currently_updating)){
                angle = Math.round(angle / 55) * 55;
                carousel_el.style.transform = `rotateY(${angle}deg)`;
                current_angle = angle;
                rotate_enabled = false;
            } 
        }, 1500);
    }, 2);
}
document.onmousemove = (e) => {
    if(rotate_enabled && !currently_updating) {
        rotating_carousel(e.clientX)
    }
}
document.ontouchmove = (e) => {
    if(rotate_enabled && !currently_updating) {
        let touch =  (e.touches || e.changedTouches)[0];
        rotating_carousel(touch.clientX)
    }
}

var idle_inter = setInterval(()=> {
    if(idle) {
        let carousel_el = document.querySelector("#carousel");
        if(idle) carousel_el.style.transform = `rotateY(1deg)`;
        setTimeout(() => {
            if(idle) carousel_el.style.transform = `rotateY(-1deg)`;
            setTimeout(() => {
                if(idle) carousel_el.style.transform = `rotateY(0deg)`;
            }, 600);
        }, 600);
    }
    else {
        clearInterval(idle_inter);
    }
}, 10000);