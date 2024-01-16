<?php
session_start();
$url=$_POST['url'];
$widthAdd=0;
$widthInit=0;
if(isset($_POST['add']) || isset($_SESSION['last_width1'])){
    if(isset($_POST['add'])){
        $widthAdd=$_POST['add'] + $_SESSION['last_width1'];
    }else{
        $widthAdd= $_SESSION['last_width1'];
    }
  
}else{
    $widthAdd=150;
}
// Path to the main image (T-shirt image)
$mainImage = '../'.$url;

$logoImage = $_FILES['image_logo']['tmp_name'];
// Desired width and height of the logo image
$logoWidthNew = $widthAdd; // Adjust the value as needed
$logoHeightNew = $widthAdd; // Adjust the value as needed
$_SESSION['last_width1']=$logoWidthNew;
// Load the main image
$main = imagecreatefromjpeg($mainImage);

// Load the logo image
$logo = imagecreatefrompng($logoImage);

// Get the original dimensions of the logo image
$logoWidth = imagesx($logo);
$logoHeight = imagesy($logo);

// Create a new image with transparent background
$logoResized = imagecreatetruecolor($logoWidthNew, $logoHeightNew);
imagealphablending($logoResized, false);
imagesavealpha($logoResized, true);
$transparentColor = imagecolorallocatealpha($logoResized, 0, 0, 0, 127);
imagefill($logoResized, 0, 0, $transparentColor);

// Resize and merge the logo image while preserving transparency
imagecopyresampled($logoResized, $logo, 0, 0, 0, 0, $logoWidthNew, $logoHeightNew, $logoWidth, $logoHeight);
imagedestroy($logo);

// Enable alpha blending for the main image
imagealphablending($main, true);

// Calculate the position to place the logo on the main image
$positionX = imagesx($main) - $logoWidthNew - 350; // Adjust the values as needed
$positionY = imagesy($main) - $logoHeightNew - 440; // Adjust the values as needed

// Merge the logo image onto the main image
imagecopy($main, $logoResized, $positionX, $positionY, 0, 0, $logoWidthNew, $logoHeightNew);
imagedestroy($logoResized);


// Save the final image to a file
$outputImage = '../output'.rand(10,100).'.jpg';

imagejpeg($main, $outputImage);

// Clean up memory
imagedestroy($main);


if (isset($_SESSION['lastImageurl1'])){
    // echo 'LAST ImAGE: '.$_SESSION['lastImageurl'];
    if (file_exists($_SESSION['lastImageurl1'])) {
        if (unlink( $_SESSION['lastImageurl1'])) {
            echo "Image deleted successfully.";
        } else {
            echo "Failed to delete the image.";
        }
    } else {
        echo "Image not found.";
    }
}
$_SESSION['lastImageurl1']=$outputImage;
echo $outputImage;
?>