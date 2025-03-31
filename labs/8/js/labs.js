$(document).ready(function() {
    // Gentle fade-in for the title
    $("h1").hide().fadeIn(800);

    // Load menu items from JSON
    $.ajax({
        url: 'projects.json',
        dataType: 'json',
        success: function(data) {
            const buttonsContainer = $('.buttons');
            buttonsContainer.empty();
            
            // Add each project with animation
            data.menuItems.forEach(function(item, index) {
                const button = $(`
                    <a href="${item.link}" class="button">
                        ${item.title} <i class="${item.icon}"></i>
                    </a>
                `);
                
                // Add tooltip
                button.tooltip({
                    content: item.description,
                    position: { my: "center bottom-20", at: "center top" }
                });

                // Add fade-in animation
                button.hide().appendTo(buttonsContainer)
                    .delay(index * 100)
                    .fadeIn(200);
                
                // Add hover effect
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
        }
    });
}); 