<?php
session_start();
include("admin/users.php");

if (!file_exists('./.installed')) {
  header('Location: /install.php', true);
}
if (count($_SESSION) == 0) {
  header('Location: /index.php', true);
}
if (!$_SESSION['usr_id'] && $_SESSION['usr_id'] != 0) {
  $_SESSION['usr_id'] = -1;
  header('Location: /index.php', true);
}

$user_data = get_user($_SESSION['usr_mail']);

$active_panel = "inf";
if ($_GET['cat']) {
  if ($_GET['cat'] == "inf" || $_GET['cat'] == "billing" || $_GET['cat'] == "cmds") {
    $active_panel = $_GET['cat'];
  }
}

if ($_GET['delete_account'] == TRUE) {
  del_user($_SESSION['usr_mail']);
  $_SESSION['usr_id'] = "";
  $_SESSION['usr_mail'] = "";
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
      <?php include("partial/navbar.php") ?>
      <div id="content-wrap">
        <div id="account">
          <div class="cat_selector">
            <ul>
              <a href="?cat=inf"><li class="item">Informations personnelles</li></a>
              <li class="sep">|</>
              <a href="?cat=billing"><li>Informations de paiement</li></a>
              <li class="sep">|</>
              <a href="?cat=cmds"><li>Commandes</li></a>
            </ul>
          </div>
          <hr>
          <div class="cat_content">
            <?php
            if ($active_panel == "inf") {
              echo "<p>Prénom : ".$user_data['user_name']."</p>";
              echo "<p>Nom &nbsp;&nbsp;&nbsp;&nbsp;: ".$user_data['user_lastname']."</p>";
              echo "<p>Email &nbsp;&nbsp;&nbsp;: ".$user_data['user_mail']."</p>";
              echo "<a href='?delete_account=TRUE'><button type='button'>Supprimer compte</button></a>";
            }
            elseif ($active_panel == "billing") {
                echo "<center><p style='color:red'>Cette fonction n'est pas encore implémentée.</p></center>";
            }
            elseif ($active_panel == "cmds") {

            }
            ?>
          </div>
        </div>
      </div>
      <?php include("partial/footer.php") ?>
    </div>
  </body>
</html>
