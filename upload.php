<?php
include('index.php');

require __DIR__ . '/vendor/autoload.php';
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
$target_dir = "src/resources/";
$target_file = $target_dir . basename($_FILES["uploadedFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler($target_dir.'jigsaw.log', Logger::DEBUG));

// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {
  // print_r($_FILES);
  $check = getimagesize($_FILES["uploadedFile"]["tmp_name"]);
  if($check !== false) {
    $logger->info("File is an image - " . $check["mime"] . ".\n\r");
    echo "File is an image - " . $check["mime"] . ".\n\r";
    $uploadOk = 1;
  } else {
    $logger->info("File is not an image.\n\r");
    echo "File is not an image.\n\r";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    $logger->info("Sorry, file already exists.\n\r");
    echo "Sorry, file already exists.\n\r";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["uploadedFile"]["size"] > 500000) {
    $logger->info("Sorry, your file is too large.\n\r");
    echo "Sorry, your file is too large.\n\r";
  $uploadOk = 0;
}

// Allow certain file formats
// echo('hi' . $imageFileType);
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $logger->info("Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n\r");
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n\r";
  $uploadOk = 0;
}
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $logger->info("Sorry, your file was not uploaded.\n\r");
      echo "Sorry, your file was not uploaded.\n\r";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)) {
      $logger->info("The file ". htmlspecialchars( basename( $_FILES["uploadedFile"]["name"])). " has been uploaded.\n\r");
      // echo "The file ". htmlspecialchars( basename( $_FILES["uploadedFile"]["name"])). " has been uploaded.\n\r";


      $filename = 'active_image.jpg';

      $width = 360; 
      $height = 360; 
        
      // Get image dimensions 
      list($width_orig, $height_orig) = getimagesize($target_file); 
        
      // Resample the image 
      $image_p = imagecreatetruecolor($width, $height); 
      $image = imagecreatefromjpeg($target_file); 
      imagecopyresized($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig); 
        
      imagejpeg($image_p,$target_dir.$filename, 100);
      
      GenerateImages($target_dir,$filename);

} else {
    $logger->info("Sorry, there was an error uploading your file.\n\r");
    echo "Sorry, there was an error uploading your file.\n\r";
  }
}

function GenerateImages($target_dir,$FileName){
$viewLoadString =[];
//   $im = imagecreatefromjpeg($target_dir.$FileName);
// $counter = 0;
//   for($j = 0; $j<=2; $j++){
//     for($i = 0; $i<=2; $i++){
//     $im2 = imagecrop($im, ['x' => 120*$i, 'y' => 120*$j, 'width' => 120, 'height' => 120]);
//     imagejpeg($im2,$target_dir.$i.$j.'.jpg', 100);
//     $viewLoadString [$counter]= "<div onclick='ClickTile(this);' style='background-image:url(".$target_dir.$i.$j.'.jpg'.");height:120px;width:120px;display:inline-block;border:1px solid black;'></div>&nbsp;";
//   $counter++;
// }
// }

$numbers = range(0, 8);
shuffle($numbers);
$view = "";
$counter = 0;
foreach($numbers as $number){
  $view = $view.'<div class="image'.($number+1).'" onclick="ClickTile(this);"></div>&nbsp;';
  if($counter == 2 || $counter == 5){
    $view = $view.'<br>';  
  }
  $counter++;
}
echo($view);
}

?>