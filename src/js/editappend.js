document.addEventListener('DOMContentLoaded', () => {
    // If not in admin page stop script
    if(!document.querySelector('body').classList.contains('admin')) {
        return;
    }

    // Add event listeners on badges
    document.querySelector('.badge-main-btn.added').addEventListener('dblclick',  () => {
        insertAtCursor('[added]');
    });

    document.querySelector('.badge-main-btn.updated').addEventListener('dblclick',  () => {
        insertAtCursor('[updated]');
    });

    document.querySelector('.badge-main-btn.fixed').addEventListener('dblclick',  () => {
        insertAtCursor('[fixed]');
    });

    document.querySelector('.badge-main-btn.removed').addEventListener('dblclick',  () => {
        insertAtCursor('[removed]');
    });

    // Function to insert badge value in textarea
    function insertAtCursor(myValue) {
        const textAreaElement = document.querySelector('#datalist');
        const startPosition = textAreaElement.selectionStart;
        const endPosition = textAreaElement.selectionEnd;
        const text = textAreaElement.value;

        if(startPosition === endPosition) {
            textAreaElement.value = text.substring(0, startPosition) + myValue + text.substr(startPosition);
            textAreaElement.focus();
            textAreaElement.setSelectionRange(startPosition + myValue.length, startPosition + myValue.length);
        }
    }
});