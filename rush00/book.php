<?php

//  IDEA: The book will have the following informations :
//   Title : title of the book
//   Date : publication date
//   Prix : current cost for the buyer
//   Auteur : author
//   Abstract : Abstract of the book
//   Sales : number of sale done
//   Stock : number of available book
//   Genre : genre of the book (SF/Fantasy/Thriller)

function get_book($title, $author) {
  $collection = get_data(".data/books.dat");
  if (!$collection) {
    return false;
  }
  foreach ($collection as $book) {
    if ($book['author'] == $author && $book['title'] == $title) {
      return $book;
    }
  }
  return false;
}

function get_book_by_filter($filter) {
  $filtered = array();
  $collection = get_data(".data/books.dat");
  if (!$collection) {
    return (array());
  }
  if ($filter == 'all') {
    asort($collection);
    return $collection;
  }
  foreach ($collection as $book) {
    $genre = explode(";", $book['genre']);
    if (count($genre) == 0) {
      $genre = $book['genre'];
      if ($filter == $key) {
        $filtered[] = $book;
      }
    }
    else {
      foreach ($genre as $key) {
        if ($filter == $key) {
          $filtered[] = $book;
          break ;
        }
      }
    }
  }
  asort($filtered);
  return $filtered;
}

function get_best_sellers() {
  $output = array();
  $data = get_data(".data/books.dat");
  if (!$data || count($data) == 0) {
      return $output;
  }
  foreach ($data as $book) {
    $output[$book['sales'].";".$book['title'].";".$book['author']] = $book;
  }
  krsort($output, SORT_NUMERIC);
  return $output;
}

function create_book($title, $date, $cost, $author, $abstract, $sales, $stock, $genre, $picture) {
  $book = array(
    'title' => $title,
    'date' => $date,
    'cost' => $cost,
    'author' => $author,
    'abstract' => $abstract,
    'sales' => $sales,
    'stock' => $stock,
    'genre' => $genre,
    'picture' => $picture,
  );
  return $book;
}

function is_book_unique($new_book) {
  $collection = get_data(".data/books.dat");
  if (!$collection || count($collection) == 0) {
    return true;
  }
  foreach ($collection as $book) {
    if ($book['title'] == $new_book['title'] && $book['author'] == $new_book['author']) {
      return false;
    }
  }
  return true;
}

function add_book($data) {
  $book = create_book($data['title'], $data['date'], $data['cost'], $data['author'], $data['abstract'], $data['sales'], $data['stock'], $data['genre'], $data['picture']);
  if (!is_book_unique($book)) {
    return false;
  }
  $collection = get_data(".data/books.dat");
  if (!$collection) {
    $collection = array();
  }
  $collection[] = $book;
  print_r($collection);
  set_data(".data/books.dat", $collection);
  return true;
}

function remove_book($book) {
  $collection = get_data(".data/books.dat");
  foreach ($collection as $col_book) {
    if ($col_book == $book) {
      unset($collection[$col_book]);
      return ;
    }
  }
}

?>
