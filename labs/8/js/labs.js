$(document).ready(function() {
    // Reduce bounce effect time from 1000ms to 500ms
    $("h1").effect("bounce", { times: 1 }, 500);

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

                // Reduce delay between items from 200ms to 100ms
                // Reduce fadeIn time from 500ms to 200ms
                button.hide().appendTo(buttonsContainer)
                    .delay(index * 100)
                    .fadeIn(200);
                
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

    // Add this after your existing code to make buttons draggable
    $('.button').draggable({ 
        containment: ".center-content",
        snap: true,
        revert: true
    });
}); 