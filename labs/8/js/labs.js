$(document).ready(function() {
    // Remove title animation - it will just be visible immediately
    // $("h1").hide().fadeIn(800);  <- removing this line

    // Load menu items from JSON with corrected path
    $.ajax({
        url: '../8/projects.json',
        dataType: 'json',
        success: function(data) {
            const buttonsContainer = $('.buttons');
            buttonsContainer.empty();
            
            // Add each project with smoother animation
            data.menuItems.forEach(function(item, index) {
                const button = $(`
                    <a href="${item.link}" class="button">
                        ${item.title} <i class="${item.icon}"></i>
                    </a>
                `);
                
                // Add tooltip
                button.tooltip({
                    content: item.description,
                    position: { my: "center bottom-20", at: "center top" },
                    show: { effect: "fadeIn", duration: 200 },
                    hide: { effect: "fadeOut", duration: 200 }
                });

                // Smoother entrance animation
                button.css({
                    'opacity': '0',
                    'transform': 'translateY(10px)'  // Reduced from 20px for subtler movement
                }).appendTo(buttonsContainer);

                // Animate each button with a gentler slide-up fade effect
                setTimeout(() => {
                    button.css({
                        'transition': 'all 0.6s ease',  // Increased duration for smoother effect
                        'opacity': '1',
                        'transform': 'translateY(0)'
                    });
                }, index * 150);  // Slightly increased delay between buttons
                
                // Gentler hover effect
                button.hover(
                    function() { 
                        $(this).css({
                            'transform': 'scale(1.03)',  // Reduced scale for subtler effect
                            'transition': 'all 0.4s ease'
                        });
                    },
                    function() { 
                        $(this).css({
                            'transform': 'scale(1)',
                            'transition': 'all 0.4s ease'
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