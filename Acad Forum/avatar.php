<?php
if ($_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES["avatar"]["tmp_name"];
  $name = basename($_FILES["avatar"]["name"]);
  $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  
  if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
    $destination = "uploads/" . uniqid() . "." . $extension;
    move_uploaded_file($tmp_name, $destination);
    
    // Save the file path to the user's profile in the database
    $user_id = $_SESSION["user_id"];
    $sql = "UPDATE users SET avatar='$destination' WHERE id=$user_id";
    // execute the SQL statement
  } else {
    echo "Invalid file format.";
  }
} else {
  echo "Error uploading file.";
}
?>