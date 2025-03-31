$(document).ready(function() {
    // Gentle fade-in for the title
    $("h1").hide().fadeIn(800);

    function setupLabNavigation() {
        // Get the current lab number from the URL
        const currentPath = window.location.pathname;
        console.log('Current path:', currentPath);
        
        // Match lab number from different possible URL formats
        let labNum;
        if (currentPath.includes('lab8.html')) {
            labNum = 8;
        } else if (currentPath.includes('lab7.html')) {
            labNum = 7;
        } else if (currentPath.includes('lab6.html')) {
            labNum = 6;
        } else if (currentPath.includes('lab5.html')) {
            labNum = 5;
        } else if (currentPath.includes('/4/')) {
            labNum = 4;
        }
        
        console.log('Detected lab number:', labNum);

        if (!labNum) return;

        const navContainer = $('.lab-navigation');
        let navHTML = '<div class="buttons">';
        
        // Add Previous Lab button if not lab 1
        if (labNum > 1) {
            const prevLink = getPrevLabLink(labNum);
            navHTML += `<a href="${prevLink}">↩ Previous Lab</a>`;
        }
        
        // Always add Back to Labs button
        navHTML += `<a href="../3/labs.html">Back to Labs</a>`;
        
        // Add Next Lab button if not lab 8
        if (labNum < 8) {
            const nextLink = getNextLabLink(labNum);
            navHTML += `<a href="${nextLink}">Next Lab <i class="fas fa-arrow-right"></i></a>`;
        }
        
        navHTML += '</div>';
        navContainer.html(navHTML);
    }

    function getPrevLabLink(currentLab) {
        switch(currentLab) {
            case 8: return '../7/lab7.html';
            case 7: return '../6/lab6.html';
            case 6: return '../5/lab5.html';
            case 5: return '../4/index.html';
            case 4: return '../3/labs.html';
            default: return '../3/labs.html';
        }
    }

    function getNextLabLink(currentLab) {
        switch(currentLab) {
            case 4: return '../5/lab5.html';
            case 5: return '../6/lab6.html';
            case 6: return '../7/lab7.html';
            case 7: return '../8/lab8.html';
            default: return '../3/labs.html';
        }
    }

    // Initialize navigation
    setupLabNavigation();
}); 