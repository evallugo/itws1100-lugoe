$(document).ready(function() {
    // Replace bounce with a gentler fade-in for the title
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

    // Add navigation functionality
    function setupLabNavigation() {
        $.ajax({
            url: '../8/projects.json',
            dataType: 'json',
            success: function(data) {
                // Get current lab number from URL
                const currentPath = window.location.pathname;
                const labMatch = currentPath.match(/lab(\d+)/i);
                if (!labMatch) return;
                
                const currentLabNum = parseInt(labMatch[1]);
                const labs = data.menuItems;
                
                // Find previous and next labs
                const prevLab = labs.find(lab => lab.id === currentLabNum - 1);
                const nextLab = labs.find(lab => lab.id === currentLabNum + 1);
                
                // Update navigation buttons if they exist
                if (prevLab) {
                    $('.prev-lab').attr('href', prevLab.link).fadeIn(400);
                } else {
                    $('.prev-lab').hide();
                }
                
                if (nextLab) {
                    $('.next-lab').attr('href', nextLab.link).fadeIn(400);
                } else {
                    $('.next-lab').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading lab navigation:', error);
            }
        });
    }

    // Call the navigation setup
    setupLabNavigation();
}); 