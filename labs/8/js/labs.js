$(document).ready(function() {
  //title appears immediately without animation

  //load labs from json file
  $.ajax({
    url: '../8/projects.json',
    dataType: 'json',
    success: function(data) {
      const buttonsContainer = $('.buttons');
      buttonsContainer.empty();
      
      //create and animate each lab button
      data.labs.forEach(function(item, index) {
        const button = $(`
          <a href="${item.path}" class="button">
            ${item.name} <i class="${item.image}"></i>
          </a>
        `);
        
        //add tooltip with lab description
        button.tooltip({
          content: item.description,
          position: { my: "center bottom-20", at: "center top" },
          show: { effect: "fadeIn", duration: 200 },
          hide: { effect: "fadeOut", duration: 200 }
        });

        //set initial state for entrance animation
        button.css({
          'opacity': '0',
          'transform': 'translateY(10px)'
        }).appendTo(buttonsContainer);

        //animate button entrance with fade and slide
        setTimeout(() => {
          button.css({
            'transition': 'all 0.6s ease',
            'opacity': '1',
            'transform': 'translateY(0)'
          });
        }, index * 150);
        
        //add subtle hover animation
        button.hover(
          function() { 
            $(this).css({
              'transform': 'scale(1.03)',
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
      //fallback static buttons if json fails to load
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