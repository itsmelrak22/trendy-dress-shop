<?php
$url=$_POST['url'];

// Path to the main image (T-shirt image)
$mainImage = '../'.$url;

// Path to the logo image
$logoImage = '../admin_area/product_images/das2.PNG';

// Desired width and height of the logo image
$logoWidthNew = 130; // Adjust the value as needed
$logoHeightNew = 130; // Adjust the value as needed

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
$outputImage = '../output3.jpg';
imagejpeg($main, $outputImage);

// Clean up memory
imagedestroy($main);
echo $outputImage;

?>