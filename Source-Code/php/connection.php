
<?php
$con = mysqli_connect("localhost","root","","test2");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

if ($con){
    //echo 'connected';
}

?>

