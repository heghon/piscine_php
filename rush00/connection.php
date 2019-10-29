<?php
session_start();
include("./admin/users.php");

if (!file_exists('./.installed')) {
  header('Location: /install.php', true);
}
$err = false;
if ($_POST['submit'] == "login") {
  $auth = auth_check($_POST['mail'], $_POST['passwd']);
  if ($auth['valid']) {
    $_SESSION['usr_id'] = $auth['id'];
    $_SESSION['usr_mail'] = $_POST['mail'];
    header('Location: /index.php', true);
  }
  else {
    $err = true;
  }
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
      <div id="navigation">
        <div class="nav_logo_center">
          <a href="index.php"><img class="nav_logo_center" src="img/logo_light.png" /></a>
        </div>
      </div>
      <div id="content-wrap">
        <div id="login">
          <form class="login" action="" method="post">
            <div class="login_content">
              <p class=''><input type='email' name='mail' placeholder="Email" required/></p>
              <p class=''><input type='password' name='passwd' placeholder="Mot de passe" equired/></p>
            </div>
            <p><input type="submit" name="submit" value="login"></p>
            <?php
              if ($err) {
                echo "<p class='error_reg'>Échec, mauvaise combinaison.</p>";
              }
            ?>
          </form>
        </div>
      </div>
    </div>
    <?php include("partial/footer.php") ?>
    </div>
  </body>
</html>
