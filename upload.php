<?php

if(!empty($_POST)) {
  require_once("includes/database.php");

  $name = basename($_FILES["fileToUpload"]["name"]);
  $id = createNewID();

  $target_dir = "../download/uploads/";
  echo is_writable($target_dir) ? "Writable" : "Not Writable";
  $target_file = $target_dir . $id;
  $uploadOk = 1;

  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }

/*
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }*/

  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";

  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          databaseAddFile($id, $name);
          echo "\n\n\n your file has been uploaded as $id \n\n\n use http://$_SERVER[HTTP_HOST]".dirname($_SERVER['PHP_SELF'])."/?$id to download your file!";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
    }
} else {
?>

<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php } ?>
