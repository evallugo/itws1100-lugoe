$(document).ready(function() {
    // Add jQuery UI effects to the page title
    $("h1").effect("bounce", { times: 1 }, 1000);

    // Load the JSON file
    $.ajax({
        url: '../8/projects.json',
        dataType: 'json',
        success: function(data) {
            const buttonsContainer = $('.buttons');
            buttonsContainer.empty(); // Clear existing buttons
            
            // Add each project with animation
            data.menuItems.forEach(function(item, index) {
                const button = $(`
                    <a href="${item.link}" class="button">
                        ${item.title} <i class="${item.icon}"></i>
                    </a>
                `);
                
                // Add jQuery UI tooltip
                button.tooltip({
                    content: item.description,
                    position: { my: "center bottom-20", at: "center top" }
                });

                // Add fade-in effect with delay based on index
                button.hide().appendTo(buttonsContainer)
                    .delay(index * 200)
                    .fadeIn(500);
                
                // Add hover effect
                button.hover(
                    function() { $(this).effect("pulse", { times: 1 }, 200); },
                    function() { }
                );
            });
        },
        error: function(xhr, status, error) {
            console.error('Error loading projects:', error);
            $('.buttons').html('<p style="color: white;">Error loading projects. Please try again later.</p>');
        }
    });
}); 