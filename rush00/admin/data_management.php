<?php

function get_data($file) {
  if (!file_exists($file)) {
    error_log("Tried to access $file which does not exist at ".date('l jS \of F Y h:i:s A')."\n", 3, "../log/error.log");
    file_put_contents($file, NULL);
  }
  $data = file_get_contents($file);
  $data = unserialize($data);
  return ($data);
}

function set_data($file, $data) {
  if (!file_exists($file)) {
    error_log("Tried to write $file which does not exist at ".date('l jS \of F Y h:i:s A')."\n", 3, "../log/error.log");
    file_put_contents($file, NULL);
  }
  $data = serialize($data);
  file_put_contents($file, $data);
}

?>
