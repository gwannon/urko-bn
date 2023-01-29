<?php 

ini_set("display_errors", 0);

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
imagefilter($imagen, IMG_FILTER_CONTRAST, -50);


list($width, $height) = getimagesize($imagen_url);

foreach ($_REQUEST['zone'] as $zone) {
    $zoneSize = $zone['size'] / 100;
    $zoneX = $zone['x'] / 100;
    $zoneY = $zone['y'] / 100;

    $zone = imagecrop($orig, ['x' => ($zoneX * $width), 'y' => ($zoneY * $height), 'width' => ($zoneSize * $width), 'height' => ($zoneSize * $width)]);

    imagecopy(
        $imagen,
        $zone,
        ($zoneX * $width),
        ($zoneY * $height),
        0,
        0,
        ($zoneSize * $width),
        ($zoneSize * $width)
    );
}


//Mostramos la imagen 
imagejpeg($imagen);

//Destruimos las imágenes
imagedestroy($imagen);
imagedestroy($orig);
imagedestroy($zone);
