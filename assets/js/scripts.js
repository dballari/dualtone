/**
 * DualTone scripts
 */
document.addEventListener('DOMContentLoaded', function() {
    findEmptyElements('.wp-block-template-part');
    activateGoBackLinks('.go-back-link');
    //classifyHeading('h2.wp-block-post-title');
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
 * Function to go back in history
 */
function goBack() {
    window.history.back();
}


/**
 * Adds a class to the targeted headings according to their length
 * @TODO content length responsive font size
 */
function classifyHeading(headingSelector) {
    var headings = document.querySelectorAll(headingSelector);
  
    headings.forEach(function(heading) {
        var text = heading.textContent.trim();
        var length = text.length;
        var classToAdd;
        if (length < 18) {
            classToAdd = 'small';
        } else if (length <= 70) {
            classToAdd = 'medium';
        } else {
            classToAdd = 'large';
        }
        //console.log('length: ', headingSelector, length, classToAdd);
        heading.classList.add(classToAdd);
    });
}
