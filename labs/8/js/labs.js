$(document).ready(function() {
    // Gentle fade-in for the title
    $("h1").hide().fadeIn(800);

    // Single AJAX call for navigation
    function setupLabNavigation() {
        // Determine the correct path to projects.json based on current location
        const currentPath = window.location.pathname;
        const isLab8 = currentPath.includes('/8/');
        const projectsJsonPath = isLab8 ? 'projects.json' : '../8/projects.json';

        $.ajax({
            url: projectsJsonPath,
            dataType: 'json',
            success: function(data) {
                console.log('Current path:', currentPath); // Debug log
                
                // Better regex to match lab numbers in different formats
                const labMatch = currentPath.match(/lab(\d+)|\/(\d+)\//i);
                if (!labMatch) {
                    console.log('No lab number found in path'); // Debug log
                    return;
                }
                
                const currentLabNum = parseInt(labMatch[1] || labMatch[2]);
                console.log('Current lab number:', currentLabNum); // Debug log
                
                const navContainer = $('.lab-navigation');
                navContainer.empty();
                
                // Create navigation buttons
                let navHTML = '<div class="buttons">';
                
                // Previous Lab button
                if (currentLabNum > 1) {
                    const prevLab = data.menuItems.find(lab => lab.id === currentLabNum - 1);
                    if (prevLab) {
                        navHTML += `<a href="${prevLab.link}">↩ Previous Lab</a>`;
                    }
                }
                
                // Back to Labs button
                navHTML += `<a href="../3/labs.html">Back to Labs</a>`;
                
                // Next Lab button
                if (currentLabNum < data.menuItems.length) {
                    const nextLab = data.menuItems.find(lab => lab.id === currentLabNum + 1);
                    if (nextLab) {
                        navHTML += `<a href="${nextLab.link}">Next Lab <i class="fas fa-arrow-right"></i></a>`;
                    }
                }
                
                navHTML += '</div>';
                navContainer.html(navHTML);
            },
            error: function(xhr, status, error) {
                console.error('Error loading navigation:', error, 'Path attempted:', projectsJsonPath);
            }
        });
    }

    // Initialize navigation
    setupLabNavigation();
}); 