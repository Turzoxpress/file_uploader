
<?php
$main_url = $_POST["main_url"];
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$msg = "";



// Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  $msg = "Sorry, file already exists.";

  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  //echo "Sorry, your file is too large.";
  $msg = "Sorry, your file is too large.";

  $uploadOk = 0;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
  $res = array("status" => 201,"message" => "failed to upload , Reason : ".$msg);
    echo json_encode($res,JSON_PRETTY_PRINT);
    //echo "failed to upload";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    $filepath = $main_url.htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));

    $res = array("status" => 200,"message" => $filepath);
    echo json_encode($res);
    //echo $filepath;
    //echo $filepath;
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    //echo "Sorry, there was an error uploading your file.";
    $res = array("status" => 201,"message" => "failed to upload");
    echo json_encode($res,JSON_PRETTY_PRINT);
   //echo "failed to upload";
  }
}
?>
