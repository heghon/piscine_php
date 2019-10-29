<?php
include("data_management.php");
// IDEA: User structure
//  user_id : id of the user
//  user_name : name of the user
//  user_lastname : lastname of user
//  user_mail : email of the form (blabla@blabla.kdjkd), must be unique
//  user_passwd : password of the user

function get_user($mail) {
  $data = get_data(".data/users.dat");
  if (!$data[$mail]) {
    return -1;
  }
  return ($data[$mail]);
}

function auth_check($mail, $passwd) {
  $data = get_data(".data/users.dat");
  if (!$data[$mail]) {
    return array('valid' => false, 'id' => 0);
  }
  if ($data[$mail]['user_passwd'] == hash("whirlpool", $passwd)) {
    return array('valid' => true, 'id' => $data[$mail]['user_id']);
  }
  return array('valid' => false, 'id' => 0);
}

function set_user($id, $name, $lastname, $passwd, $mail, $rights) {
  $passwd = "".$passwd;
  $user = array(
    "user_id" => $id,
    "user_name" => $name,
    "user_lastname" => $lastname,
    "user_passwd" => hash("whirlpool", $passwd),
    "user_mail" => $mail,
    "user_right" => $rights,
  );
  return ($user);
}

function is_user_unique($mail, $user_data) {
  foreach ($user_data as $user) {
    if ($user['user_mail'] == $mail) {
      return false;
    }
  }
  return true;
}

function del_user($mail) {
  $user_data = get_data(".data/users.dat");
  $i = 0;
  foreach ($user_data as $user) {
    if ($user['user_mail'] == $mail) {
      array_splice($user_data, $i, 1);
      break ;
    }
    $i++;
  }
  set_data(".data/users.dat", $user_data);
}

function add_user($name, $lastname, $passwd, $mail, $rights, $install) {
  if ($install == 1) {
    mkdir(".data/");
    mkdir("log/");
    file_put_contents(".data/users.dat", "");
    file_put_contents(".data/books.dat", "");
    file_put_contents(".data/sales.dat", "");
    $user = set_user(1, $name, $lastname, $passwd, $mail, $rights);
    set_data(".data/users.dat", array($mail => $user));
  }
  else {
    $data = get_data(".data/users.dat");
    $id = count($data) + 1;
    if (!is_user_unique($mail, $data)) {
      return false;
    }
    $data[$mail] = ($user = set_user($id, $name, $lastname, $passwd, $mail, $rights));
    set_data(".data/users.dat", $data);
  }
  return $user;
}

function init_user($data, $install) {
  if (!$data['name'] || !$data['lastname'] || !$data['mail'] || !$data['passwd']
  || $data['submit'] != "register") {
    return -1;
  }
  $userd = add_user($data['name'], $data['lastname'], $data['passwd'] ,$data['mail'], 777, 1);
  return $userd['id'];
}

?>
