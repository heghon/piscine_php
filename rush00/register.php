<?php
session_start();
include("./admin/users.php");

if (!file_exists('./.installed')) {
  header('Location: /install.php', true);
}
$err = false;

if ($_POST['submit'] == "register") {
  $auth = add_user($_POST['name'], $_POST['lastname'], $_POST['passwd'] ,$_POST['mail'], 1, 0);
  if ($auth) {
    $_SESSION['usr_id'] = $auth['user_id'];
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
        <div id="register">
          <form class="register" action="" method="post">
            <p class=''><input type='text' name='name' placeholder="Prénom" required/></p>
            <p class=''><input type='text' name='lastname' placeholder="Nom" required/></p>
            <hr>
            <p class=''><input type='email' name='mail' placeholder="Email" required/></p>
            <p class=''><input type='password' name='passwd' placeholder="Mot de passe" required/></p>
            <p><input type="submit" name="submit" value="register"></p>
            <?php
              if ($err) {
                echo "<p class='error_reg'>Échec, l'email n'est pas unique.</p>";
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
