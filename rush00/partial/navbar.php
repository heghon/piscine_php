<?php

session_start();

function disconnect() {
  session_destroy();
  $_SESSION['usr_id'] = -1;
}

if ($_GET['disconnect'] == "sign_out") {
  disconnect();
  $_SESSION['usr_id'] = -1;
}
if ($_SESSION['usr_id'] > 0) {
  $user_dsp = "known_user";
}
else {
  $user_dsp = "visitor";
}

?>

<div id="navigation">
  <div class="nav_logo">
    <a href="/index.php"><img class="nav_logo" src="/img/logo_light.png" /></a>
  </div>
  <div class="nav_bar">
    <div class="nav_search">
      <input type="text" placeholder="Search..">
    </div>
    <div class="nav_account">
      <?php
      if ($user_dsp == "visitor") {
        echo "<div class='nav_items_top'>";
        echo "<a class='nav_register' href='/register.php'>S'inscrire</a>";
        echo "<a class='nav_login' href='/connection.php'>Se connecter</a>";
        echo "</div>";
        echo "<div class='nav_account_ico'></div>";
      } else {
        echo "<div class='nav_items_top'>";
        echo "<a class='nav_logout' href='/index.php?disconnect=sign_out'>D&eacute;connection</a>";
        echo "<a class='nav_settings' href='/user_account.php'>Compte</a>";
        echo "</div>";
        echo "<div class='nav_account_ico'></div>";
      }
      ?>
    </div>
    <div class="nav_content">
      <div style="display:inline;float:right"><a href="/basket.php"><img width="50px" height="50px" src="/img/basket.png"/></a></div>
    </div>
  </div>
</div>
