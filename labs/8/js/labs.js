$(document).ready(function() {
  //title appears immediately without animation

  //load labs from json file
  $.ajax({
    url: '../../labs/8/projects.json',
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

        //append button to container
        button.appendTo(buttonsContainer);

        //animate button entrance with fade and slide
        setTimeout(() => {
          button.addClass('visible');
        }, index * 150);
      });
    },
    error: function(xhr, status, error) {
      console.error('Error loading projects:', error);
      const fallbackButtons = `
        <a href="../../labs/1/lab1.html" class="button">Lab 1 <i class="fas fa-flask"></i></a>
        <a href="../../labs/3/lab2.html" class="button">Lab 2 <i class="fas fa-flask"></i></a>
        <a href="../../labs/4/index.html" class="button">Lab 4 <i class="fas fa-flask"></i></a>
        <a href="../../labs/5/lab5.html" class="button">Lab 5 <i class="fas fa-flask"></i></a>
        <a href="../../labs/6/lab6.html" class="button">Lab 6 <i class="fas fa-flask"></i></a>
        <a href="../../labs/7/lab7.html" class="button">Lab 7 <i class="fas fa-flask"></i></a>
        <a href="../../labs/8/lab8.html" class="button">Lab 8 <i class="fas fa-flask"></i></a>
        <a href="../../labs/9/index.php" class="button">Lab 9 <i class="fas fa-flask"></i></a>
        <a href="../../labs/10/index.php" class="button">Lab 10 <i class="fas fa-flask"></i></a>
      `;
      
      $('.buttons').html(fallbackButtons);
      
      // Animate fallback buttons
      $('.buttons a').each(function(index) {
        setTimeout(() => {
          $(this).addClass('visible');
        }, index * 150);
      });
    }
  });
}); 