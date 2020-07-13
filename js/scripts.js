// Constants
const MOUSE_STATUS_OUTSIDE = 0;
const MOUSE_STATUS_INSIDE = 1;

// Main element which we gonna use to slide up/down for animation;
var slideBlockElement = document.getElementsByClassName("changelog-slide-bg")[0];

// Variable that saves current mouse status for animation;
var slideBlockMouseStatus = MOUSE_STATUS_OUTSIDE;

// Add mouse events on version list items;
function addMouseEvents() {
    var slideDetectElements = document.getElementsByClassName("change-log-version");

    for(var i = 0; i < slideDetectElements.length; i++) {
        slideDetectElements[i].addEventListener("mouseenter", mouseAnimationEnter);
        slideDetectElements[i].addEventListener("mouseleave", mouseAnimationLeave);
    }
}
addMouseEvents();

// Mouse enter animation zone;
function mouseAnimationEnter() {
    // Main element class add for text and etc animations;
    this.classList.add("change-log-transition");

    // Sliding block animation;
    slideBlockMouseStatus = MOUSE_STATUS_INSIDE;
    slideBlockElement.style.opacity = "1";
    slideBlockElement.style.height = this.offsetHeight + "px";
    slideBlockElement.style.top = this.offsetTop + "px";
    
}

// Mouse leave animation zone;
function mouseAnimationLeave() {
    // Main element class remove for text and etc animations;
    this.classList.remove("change-log-transition");

    // Sliding block animation;
    slideBlockMouseStatus = MOUSE_STATUS_OUTSIDE;
    slideBlockElement.style.height = "1px";
    slideBlockElement.style.opacity = "0";
}