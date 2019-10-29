<?php
session_start();
include("admin/users.php");
include("book.php");

if (!file_exists('./.installed')) {
  header('Location: /install.php', true);
}
$filter = "all";
if ($_SESSION['usr_id'] <= 0) {
  $_SESSION['usr_id'] = -1;
}
if (!$_SESSION['basket']) {
  $_SESSION['basket'] = array();
  $_SESSION['cost'] = 0.00;
}
if ($_GET['filter']) {
  $filter = $_GET['filter'];
}

if ($_GET['add_article']) {
  if (!$_SESSION['basket'][$_GET['add_article']]) {
    $_SESSION['basket'][$_GET['add_article']] = 1;
  }
  else {
    $_SESSION['basket'][$_GET['add_article']] += 1;
  }
  $book = explode(";", $_GET['add_article']);
  $book = get_book($book[0], $book[1]);
  $_SESSION['cost'] += $book['cost'];
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
        <div class="main_ad"></div>
        <div class="best_sales">
          <?php
          $top = get_best_sellers();
          $limit = 5;
          $disp_id = 0;
          foreach ($top as $book) {
            if ($disp_id >= $limit) {
              break ;
            }
            echo "<a class='best_sellers_a' href='#'><div class='best_sellers'>            <img class='book_picture_top' src=".$book['picture']." /></div></a>";
            //<!--<div class='best_sellers'>".$book['title']."</div>-->
            $disp_id++;
          }
          ?>
        </div>
        <div class="cat_book_selector">
          <ul>
            <a href="?filter=all"><li class="item">Tout</li></a>
            <a href="?filter=histoire"><li class="item">Histoire</li></a>
            <a href="?filter=enfants"><li>Enfants</li></a>
            <a href="?filter=informatique"><li>Informatique</li></a>
            <a href="?filter=arts"><li>Arts</li></a>
            <a href="?filter=actu"><li>Actualités</li></a>
            <a href="?filter=science-fiction"><li>Science-fiction</li></a>
            <a href="?filter=fantastique"><li>Fantastique</li></a>
            <a href="?filter=bd"><li>BD</li></a>
          </ul>
        </div>
        <div class="filtered_books_display">
          <?php
          $collection = get_book_by_filter($filter);
          foreach ($collection as $book) {
            echo "<div class='book_display'>
            <img class='book_picture' src=".$book['picture']." />
            <div class='book_tinf'>
              <h2 class='book_title'>".$book['title']."</h2>
              <div class='book_information'>
                <p class='book_abstract'>".$book['abstract']."</p>
                <p class='book_abstract'><b>Auteur</b> : ".$book['author']."</p><br/>
                <p class='book_abstract'><b>Date de parution</b> : ".$book['date']."</p>
              </div>
            </div>
            <p class='book_price'>".$book['cost']."&euro;&nbsp;&nbsp;</p>
            <div class='book_buy'><a href='?add_article=".$book['title'].";".$book['author']."'><img width='50px' height='50px' src='/img/basket.png'></img></a></div>
            </div>
            <div class='book_sep'></div>";
          }
          ?>
        </div>
      </div>
      <?php include("partial/footer.php") ?>
    </div>
  </body>
</html>
