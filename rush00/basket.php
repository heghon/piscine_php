<?php
session_start();
include("admin/users.php");
include("book.php");

if (!file_exists('./.installed')) {
  header('Location: /install.php', true);
}

if ($_GET['pay-me-up-baby'] == "TRUE") {
  $_SESSION['cost'] = 0.00;
  $_SESSION['basket'] = array();
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
        <div class="empty"></div>
        <div class="basket">
          <div class="cat1">
            <?php
            $basket = $_SESSION['basket'];
            if (!(!$basket || count($basket) == 0)) {
            foreach ($basket as $item => $value) {
              $cost = 0.00;
              $book_info = explode(";", $item);
              $book = get_book($book_info[0], $book_info[1]);
              $cost = $book['cost'] * $value;
              echo "<div class='basket_item'>
              ".$book['title']."
              <p style='display:inline;float:right'>".$cost."( ".$book['cost']." * ".$value." )"." &euro;</p>
              </div>";
            }
          }
            ?>
          </div>
          <div class="cat2">
            <h2> Prix </h2>
            <h3><?php if (!$_SESSION['cost']) {echo "0.00";} else {echo $_SESSION['cost'];} ?> &euro;</h3>
            <div class="pay">
              <a href="?pay-me-up-baby=TRUE"><button class="pay_up_btn" type="button">Payer</button></a>
            </div>
          </div>
        </div>
      </div>
      <?php include("partial/footer.php") ?>
    </div>
  </body>
</html>
