    </div>
    <div class="footer">
      <?php
      //include database connection
      require_once 'Quiz3/conn.php';

      //get footer text from database
      $footer_query = "SELECT footer_text FROM myFooter ORDER BY footer_id DESC LIMIT 1";
      $footer_result = $db->query($footer_query);
      $footer_text = "© 2025 Eva Lugo. All rights reserved."; //default text

      if ($footer_result && $footer_result->num_rows > 0) {
          $footer_row = $footer_result->fetch_assoc();
          $footer_text = $footer_row['footer_text'];
      }
      echo htmlspecialchars($footer_text);
      ?>
    </div>
  </body>
</html>
