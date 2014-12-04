<?php
//var_dump($_GET);
var_dump($_POST);
var_dump($_FILES);
clearstatcache();

if(isset($_POST['image']) && !empty($_POST['image'])) {

    $dataURL = $_POST['image'];  

    $parts = explode(',', $dataURL); 
    $data = base64_decode($parts[1]);
	
	

	
echo '************************';
//echo $data;
echo '************************';

	$new_name = $_SERVER['DOCUMENT_ROOT'] . "/img/tmp.png";
	//$result = move_uploaded_file ( $data , $new_name );
  
	//echo "reussi ? " . $result;

    //if(is_writable('img/')) {    
        $success = file_put_contents($new_name, $data);
        echo ($success ? 'success' : 'unable to save file');
    /*} else {
        echo 'directory not writable';
    }*/
} else {
    echo 'no image';
}


/*if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  
  $path = $_FILES["file"]["tmp_name"];
  $new_name = $_SERVER['DOCUMENT_ROOT'] . "img/tmp.png";
  //$new_name = "/home/valentinkim/www/udsbat.valentinkim.org/img/tmp.png";
  
  $result = move_uploaded_file ( $path , $new_name );
  
  echo "reussi ? " . $result;
}*/
?>
