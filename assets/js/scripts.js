/**
 * DualTone scripts
 */
document.addEventListener('DOMContentLoaded', function() {
    findEmptyElements('.wp-block-template-part');
    activateGoBackLinks('.go-back-link');
    deactivateHashLinks();
});


/**
 * Find empty elements
 */
function findEmptyElements(elementSelector) {
    var elements = document.querySelectorAll(elementSelector);
    
    elements.forEach(function(element) {
        if (element.innerHTML.trim() === '') {
            element.classList.add('empty');
        }
    });
}

/**
 * Activate go back links for elements with a class
 */
function activateGoBackLinks(elementSelector) {
    var goBackLinks = document.querySelectorAll(elementSelector);
    goBackLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            goBack();
        });
    });
}

/**
 * Function to goes back in history or closes a tab
 */
function goBack() {
    if (window.history.length > 1) {
        // Si hay historial, ir atrás en la historia
        window.history.back();
    } else {
        // Si no hay historial, cerrar la pestaña
        window.close();
    }
}

/**
 * Find inactive links and set theme up
 */
function deactivateHashLinks() {
    // Get all links on the page
    var links = document.querySelectorAll('a[href="##"]');
  
    // Loop through each link
    links.forEach(function(link) {
        // Prevent default click event
        link.addEventListener('click', function(event) {
            vent.preventDefault();
        });

        // Add the class 'inactive' to the link
        link.classList.add('inactive');
    });
}
