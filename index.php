<?php
session_start(); 
require_once('vendor/autoload.php');
use MonologLogger;
use MonologHandlerStreamHandler;
use MonologHandlerSwiftMailerHandler;
?>
<!DOCTYPE html>
<html>
<head>
<script src='controller.js'></script>
  <title>Community Jigsaw</title>
  <style>
  .image0{
    background-image:url("src/resources/active_image.jpg");
    background-position: 0px 0px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image1{
    background-image:url("src/resources/active_image.jpg");
    background-position: 120px 0px;
    height:120px;width:120px;    
    display:inline-block;
  }
  .image2{
    background-image:url("src/resources/active_image.jpg");
    background-position: 240px 0px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image3{
    background-image:url("src/resources/active_image.jpg");
    background-position: 0px 120px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image4{
    background-image:url("src/resources/active_image.jpg");
    background-position: 120px 120px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image5{
    background-image:url("src/resources/active_image.jpg");
    background-position: 240px 120px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image6{
    background-image:url("src/resources/active_image.jpg");
    background-position: 0px 240px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image7{
    background-image:url("src/resources/active_image.jpg");
    background-position: 120px 240px;
    height:120px;width:120px;
    display:inline-block;
  }
  .image8{
    background-image:url("src/resources/active_image.jpg");
    background-position: 240px 240px;
    height:120px;width:120px;
    display:inline-block;
  }
  </style>
</head>
<body>
  <h1>
  Community Jigsaw Application
  </h1>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
      <span>Upload a File:</span>
      <input type="file" name="uploadedFile" />
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>
</body>
</html>