<?php 

ini_set("display_errors", 1);

$imagen_url = $_GET['image_url'];

//Generamos las cabeceras
header("Content-type: image/jpeg");
header('Content-disposition: filename="'.basename($imagen_url).'"');

//Generamos las imagenes
$imagen = imagecreatefromjpeg($imagen_url);
$orig = imagecreatefromjpeg($imagen_url);

//print_r($_REQUEST);

//Ponemos en B/N
imagefilter($imagen, IMG_FILTER_GRAYSCALE);


list($width, $height) = getimagesize($imagen_url);

foreach ($_REQUEST['zone'] as $zone) {
    $zoneWidth = $zone['width'] / 100;
    $zoneHeight = $zone['height'] / 100;
    $zoneX = $zone['x'] / 100;
    $zoneY = $zone['y'] / 100;

    $zone = imagecrop($orig, ['x' => ($zoneX * $width), 'y' => ($zoneY * $height), 'width' => ($zoneWidth * $width), 'height' => ($zoneHeight * $height)]);


    imagecopy(
        $imagen,
        $zone,
        ($zoneX * $width),
        ($zoneY * $height),
        0,
        0,
        ($zoneWidth * $width),
        ($zoneHeight * $height)
    );
}


//Mostramos la imagen 
imagejpeg($imagen);

//Destruimos las imágenes
imagedestroy($imagen);
imagedestroy($orig);
imagedestroy($zone);