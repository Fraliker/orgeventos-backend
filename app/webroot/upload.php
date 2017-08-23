<?php
header('Access-Control-Allow-Origin: *');
$target_path = "files/";
//echo var_dump($_FILES); //file_get_contents( 'php://input' );
//die();
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else {
echo $target_path;
    echo "There was an error uploading the file, please try again!";
}
?>