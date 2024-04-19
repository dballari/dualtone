/**
 * DualTone sripts to customize behavior
 */
document.addEventListener('DOMContentLoaded', function() {
    classifyHeading('h2.wp-block-post-title');
});

/**
 * Adds a class to the targeted headings according to their length
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

        console.log('length: ', headingSelector, length, classToAdd);
    
        heading.classList.add(classToAdd);
    });
}
