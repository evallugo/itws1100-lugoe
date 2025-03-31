$(document).ready(function() {
    // Gentle fade-in for the title
    $("h1").hide().fadeIn(800);

    // Load menu items from JSON with corrected path
    $.ajax({
        url: '../8/projects.json',
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
            // Fallback to show static buttons if JSON fails to load
            $('.buttons').html(`
                <a href="lab1.html" class="button">Lab 1 <i class="fas fa-flask"></i></a>
                <a href="lab2.html" class="button">Lab 2 <i class="fas fa-flask"></i></a>
                <a href="../4/index.html" class="button">Lab 4 <i class="fas fa-flask"></i></a>
                <a href="../5/lab5.html" class="button">Lab 5 <i class="fas fa-flask"></i></a>
                <a href="../6/lab6.html" class="button">Lab 6 <i class="fas fa-flask"></i></a>
                <a href="../7/lab7.html" class="button">Lab 7 <i class="fas fa-flask"></i></a>
                <a href="../8/lab8.html" class="button">Lab 8 <i class="fas fa-flask"></i></a>
            `);
        }
    });
}); 