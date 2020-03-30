<?php
// We put this here so we do not have to type out a header section for each page and can just reference a file already created for this. 
  require "header.php";
?>

    <main>
      <div class="wrapper-main">
        <section class="section-default">

          <?php
            //Here is where a message will appear for the user when they log in/out.
          if (!isset($_SESSION['id'])) {
            echo '<p class="login-status">You are now logged out. See you back soon!</p>';
          }
          else if (isset($_SESSION['id'])) {
            echo '<p class="login-status">You are now logged in. Enjoy!</p>';
          }
        
          ?>
        </section>
      </div>
    </main>

<?php
// This is the same kind of setup as we did for the header in the beggining of this page. 
  require "footer.php";
?>
