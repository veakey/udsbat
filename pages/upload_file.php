<?php
if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  
  $path = $_FILES["file"]["tmp_name"];
  $new_name = "/home/valentinkim/www/udsbat.valentinkim.org/img/bob.png";
  
  $result = move_uploaded_file ( $path , $new_name );
  
  echo "reussi ? " . $result;
}
?>
