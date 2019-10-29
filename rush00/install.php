<?php
session_start();
include("./admin/users.php");

if (file_exists('./.installed')) {
  header('Location: /index.php', true);
}

if ($_POST['submit'] == "register") {
  $install = init_user($_POST, 1);
  if ($install != -1) {
    file_put_contents(".installed", date("U"));
    $token = hash("whirlpool", date(DATE_ATOM));
  }
  $_SESSION['usr_id'] = 1;
  header('Location: /index.php', true);
}
?>

<html>
  <head>
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">
    <title>Amazaun</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="icon" type="image/png" href="img/favico.png" />
  </head>
  <body>
    <div id="page-container">
      <div id="content-wrap">
        <div id="install_register">
          <p>Vous voici sur la page d'installation de votre site AMAZAUN !</p>
          <p>En remplissant le formulaire suivant, vous aller créer un compte</p>
          <p>administrateur qui pourra par la suite gérer tout le site.</p>
          <form class="install_register_admin" action="" method="post">
            <hr>
            <div class="first_row_install_form">
              <?php
              echo "<p class='form_install'>".str_pad("Prénom : ",10)."<input type='text' name='name' required/></p>";
              echo "<p class='form_install'>".str_pad("Nom : ",10)."<input type='text' name='lastname' required/></p>";
              ?>
            </div>
            <hr>
            <div class="second_row_install_form">
              <?php
              echo "<p class='form_install'>".str_pad("Mail : ",30)."<input type='email' name='mail' required/></p>";
              echo "<p class='form_install'>".str_pad("Mot de passe : ",30)."<input type='password' name='passwd' required/></p>";
              ?>
            </div>
            <p><input type="submit" name="submit" value="register"></p>
          </form>
        </div>
      </div>
    </div>
    <?php include("partial/footer.php") ?>
    </div>
  </body>
</html>
