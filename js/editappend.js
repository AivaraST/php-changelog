// Add mouse events on version list items;
function addMouseEvents() {
    var textAreaElement = document.getElementById("datalist");
    
    document.getElementsByClassName("badge-main-btn added")[0].addEventListener("dblclick", function (e) {
        insertAtCursor(textAreaElement, "[added]");
    });
    document.getElementsByClassName("badge-main-btn updated")[0].addEventListener("dblclick", function (e) {
        insertAtCursor(textAreaElement, "[updated]");
    });
    document.getElementsByClassName("badge-main-btn fixed")[0].addEventListener("dblclick", function (e) {
        insertAtCursor(textAreaElement, "[fixed]");
    });
    document.getElementsByClassName("badge-main-btn removed")[0].addEventListener("dblclick", function (e) {
        insertAtCursor(textAreaElement, "[removed]");
    });
}
addMouseEvents();

function insertAtCursor(element, myValue) {
    var startPosition = element.selectionStart;
    var endPosition = element.selectionEnd;
    var text = element.value;

    if(startPosition == endPosition) {
        element.value = text.substring(0, startPosition) + myValue + text.substr(startPosition);
        element.focus();
        element.setSelectionRange(startPosition + myValue.length, startPosition + myValue.length);
    }
}