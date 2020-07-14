document.addEventListener('DOMContentLoaded', () => {
    // If not in index page stop script
    if(!document.querySelector('body').classList.contains('home')) {
        return;
    }

    // Variables
    const MOUSE_STATUS_OUTSIDE = 0;
    const MOUSE_STATUS_INSIDE = 1;

    const slideBlockElement = document.getElementsByClassName("changelog-slide-bg")[0];
    const slideDetectElements = document.getElementsByClassName("change-log-version");

    let slideBlockMouseStatus = MOUSE_STATUS_OUTSIDE;

    // Add event listeners on all version blocks mouse enter/leave
    for (var i = 0; i < slideDetectElements.length; i++) {
        slideDetectElements[i].addEventListener("mouseenter", mouseAnimationEnter);
        slideDetectElements[i].addEventListener("mouseleave", mouseAnimationLeave);
    }

    // Function when we enter version zone.
    function mouseAnimationEnter() {
        // Main element class add for text and etc animations;
        this.classList.add("change-log-transition");

        // Sliding block animation;
        slideBlockMouseStatus = MOUSE_STATUS_INSIDE;
        slideBlockElement.style.opacity = "1";
        slideBlockElement.style.height = this.offsetHeight + "px";
        slideBlockElement.style.top = this.offsetTop + "px";

    }

    // Function when we leave version zone.
    function mouseAnimationLeave() {
        // Main element class remove for text and etc animations;
        this.classList.remove("change-log-transition");

        // Sliding block animation;
        slideBlockMouseStatus = MOUSE_STATUS_OUTSIDE;
        slideBlockElement.style.height = "1px";
        slideBlockElement.style.opacity = "0";
    }
});