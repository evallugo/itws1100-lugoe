$(document).ready(function() {
    // Gentle fade-in for the title
    $("h1").hide().fadeIn(800);

    // Load the JSON file
    $.ajax({
        url: '../8/projects.json',
        dataType: 'json',
        success: function(data) {
            const buttonsContainer = $('.buttons');
            buttonsContainer.empty(); // Clear existing buttons
            
            // Add each project with smoother animation
            data.menuItems.forEach(function(item, index) {
                const button = $(`
                    <a href="${item.link}" class="button">
                        ${item.title} <i class="${item.icon}"></i>
                    </a>
                `);
                
                // Add jQuery UI tooltip
                button.tooltip({
                    content: item.description,
                    position: { my: "center bottom-20", at: "center top" },
                    show: { effect: "fadeIn", duration: 200 },
                    hide: { effect: "fadeOut", duration: 200 }
                });

                // Smoother entrance animation
                button.css({
                    'opacity': '0',
                    'transform': 'translateY(20px)'
                }).appendTo(buttonsContainer);

                // Animate each button with a slide-up fade effect
                setTimeout(() => {
                    button.css({
                        'transition': 'all 0.4s ease-out',
                        'opacity': '1',
                        'transform': 'translateY(0)'
                    });
                }, index * 150);
                
                // Gentler hover effect
                button.hover(
                    function() { 
                        $(this).css({
                            'transform': 'scale(1.05)',
                            'transition': 'transform 0.3s ease'
                        });
                    },
                    function() { 
                        $(this).css({
                            'transform': 'scale(1)',
                            'transition': 'transform 0.3s ease'
                        });
                    }
                );
            });
        },
        error: function(xhr, status, error) {
            console.error('Error loading projects:', error);
            $('.buttons').html('<p style="color: white;">Error loading projects. Please try again later.</p>');
        }
    });

    // Add this after your existing code to make buttons draggable
    $('.button').draggable({ 
        containment: ".center-content",
        snap: true,
        revert: true
    });

    // Single AJAX call for navigation
    function setupLabNavigation() {
        $.ajax({
            url: '../8/projects.json',
            dataType: 'json',
            success: function(data) {
                const currentPath = window.location.pathname;
                console.log('Current path:', currentPath); // Debug log
                
                // Updated regex to handle both formats: lab1.html and index.html
                const labMatch = currentPath.match(/lab(\d+)|.*\/(\d+)\//i);
                if (!labMatch) {
                    console.log('No lab number found in path'); // Debug log
                    return;
                }
                
                // Get lab number from either the first or second capture group
                const currentLabNum = parseInt(labMatch[1] || labMatch[2]);
                console.log('Current lab number:', currentLabNum); // Debug log
                
                const labs = data.menuItems;
                const navContainer = $('.lab-navigation');
                
                // Clear existing navigation
                navContainer.empty();
                
                // Create navigation buttons
                let navHTML = '';
                
                // Previous Lab button
                if (currentLabNum > 1) {
                    const prevLab = labs.find(lab => lab.id === currentLabNum - 1);
                    if (prevLab) {
                        navHTML += `<a href="${prevLab.link}" class="button">↩ Previous Lab</a>`;
                    }
                }
                
                // Back to Labs button
                navHTML += `<a href="../3/labs.html" class="button">Back to Labs</a>`;
                
                // Next Lab button
                if (currentLabNum < labs.length) {
                    const nextLab = labs.find(lab => lab.id === currentLabNum + 1);
                    if (nextLab) {
                        navHTML += `<a href="${nextLab.link}" class="button">Next Lab <i class="fas fa-arrow-right"></i></a>`;
                    }
                }
                
                // Add buttons to container
                navContainer.html(navHTML);
                
                // Add hover effects
                $('.lab-navigation .button').hover(
                    function() { 
                        $(this).css({
                            'background-color': 'rgba(255, 105, 180, 0.6)',
                            'color': 'white',
                            'transition': 'all 0.3s ease'
                        });
                    },
                    function() { 
                        $(this).css({
                            'background-color': 'transparent',
                            'color': 'hotpink',
                            'transition': 'all 0.3s ease'
                        });
                    }
                );
            },
            error: function(xhr, status, error) {
                console.error('Error loading navigation:', error);
            }
        });
    }

    // Initialize navigation
    setupLabNavigation();
}); 