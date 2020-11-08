<?php
// confirm.php, photos.phpにて使用
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

function base64_resize($base64){

    $uri = 'data://application/octet-stream;base64,'.$base64;
    list($width, $height) = getimagesize($uri);

    $new_width = 0; // 新しい横幅
    $new_height = 0; // 新しい縦幅
    $w = 200; // 最大横幅
    $h = 200; // 最大縦幅
    
    if($h < $height && $w < $width){ // 両方オーバーしていた場合
        if($w < $h){
            $new_width = $w;
            $new_height = $height * ($w / $width);
        } else if($h < $w){
            $new_width = $width * ($h / $height);
            $new_height = $h;
        } else {
            if($width < $height){
                $new_width = $width * ($h / $height);
                $new_height = $h;
            } else if($height < $width){
                $new_width = $w;
                $new_height = $height * ($w / $width);
            } else {
                $new_width = $w;
                $new_height = $h;
            }
        }
    } else if($height < $h && $width < $w){ // 両方オーバーしていない場合
        $new_width = $width;
        $new_height = $height;
    } else if($h < $height && $width <= $w){ // 縦がオーバー、横が同じか短い長さの場合
        $new_width = $width * ($h / $height);
        $new_height = $h;
    } else if($height <= $h && $w < $width){ // 横がオーバー、縦が同じか短い長さの場合
        $new_width = $w;
        $new_height = $height * ($w / $width);
    } else if($height == $h && $width < $w){ // 縦は同じ長さ、横は新しい横幅より短い
        $new_width = $width * ($h / $height);
        $new_height = $h;
    } else if($height < $h && $width == $w){ // 横は同じ長さ、縦は新しい縦幅より短い
        $new_width = $w;
        $new_height = $height * ($w / $width);
    } else { // 縦も横も新しい長さと同じ、または縦と横の長さが同じで最大サイズを超えない場合
        $new_width = $width;
        $new_height = $height;
    }
    
    
    if(!extension_loaded('gd')){
        echo "gd error";
        return false;
    }
    
    $data = base64_decode($base64);
    $im = imagecreatefromstring($data);
    if ($im == false) {
        echo "imagecreatefromstring error";
        return false;
    }

    // コピー先となる空の画像作成
    $new_image = imagecreatetruecolor(floor($new_width), floor($new_height));
    

    // GIF, PNGの場合透過処理を行う
    if(($_SESSION['image_type'] == "image/gif") || ($_SESSION['image_type'] == "image/png")){
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
    }
    
    // コピー画像を指定サイズで作成
    if (!imagecopyresampled($new_image, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height)){
        imagedestroy($im);
        imagedestroy($new_image);
        echo "imagecopy error";
        return false;
    }
    
    $file = tmpfile();
    $filename = stream_get_meta_data($file)['uri'];
    switch($_SESSION['image_type']){
        case "image/gif":
            imagegif($new_image, $filename);
            break;
        case "image/jpeg":
            imagejpeg($new_image, $filename);
            break;
        case "image/png":
            imagepng($new_image, $filename);
            break;
        default:
            break;
    }
    // 不要になった画像データの削除
    imagedestroy($im);
    imagedestroy($new_image);

    return file_get_contents($filename);
}

function sample_resize($filename){

    $imagesize = getimagesize($filename);
    list($width, $height) = getimagesize($filename);

    $new_width = 0; // 新しい横幅
    $new_height = 0; // 新しい縦幅
    $w = 200; // 最大横幅
    $h = 200; // 最大縦幅
    
    
    if($h < $height && $w < $width){ // 両方オーバーしていた場合
        if($w < $h){
            $new_width = $w;
            $new_height = $height * ($w / $width);
        } else if($h < $w){
            $new_width = $width * ($h / $height);
            $new_height = $h;
        } else {
            if($width < $height){
                $new_width = $width * ($h / $height);
                $new_height = $h;
            } else if($height < $width){
                $new_width = $w;
                $new_height = $height * ($w / $width);
            }
        }
    } else if($height < $h && $width < $w){ // 両方オーバーしていない場合
        $new_width = $width;
        $new_height = $height;
    } else if($h < $height && $width <= $w){ // 縦がオーバー、横が同じか短い長さの場合
        $new_width = $width * ($h / $height);
        $new_height = $h;
    } else if($height <= $h && $w < $width){ // 横がオーバー、縦が同じか短い長さの場合
        $new_width = $w;
        $new_height = $height * ($w / $width);
    } else if($height == $h && $width < $w){ // 縦は同じ長さ、横は新しい横幅より短い
        $new_width = $width * ($h / $heigh);
        $new_height = $h;
    } else if($height < $h && $width == $w){ // 横は同じ長さ、縦は新しい縦幅より短い
        $new_width = $w;
        $new_height = $height * ($w / $width);
    } else { // 縦も横も新しい長さと同じ、または縦と横の長さが同じで最大サイズを超えない場合
        $new_width = $width;
        $new_height = $height;
    }
    if(!extension_loaded('gd')){
        return false;
    }
    
    switch($_SESSION['image_type']){
        // 1 IMAGETYPE_GIF
        // 2 IMAGETYPE_JPEG
        // 3 IMAGETYPE_PNG
        case "image/gif":
            $im = imagecreatefromgif($filename);
            break;
        case "image/jpeg":
            $im = imagecreatefromjpeg($filename);
            break;
        case "image/png":
            $im = imagecreatefrompng($filename);
            break;
        default:
            throw new RuntimeException('対応していないファイル形式です。: ', $_SESSION['image_type']);
    }
    
    // コピー先となる空の画像作成
    $new_image = imagecreatetruecolor($new_width, $new_height);
    

    // GIF, PNGの場合透過処理を行う
    if(($_SESSION['image_type'] == "image/gif") || ($_SESSION['image_type'] == "image/png")){
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
    }
    
    // コピー画像を指定サイズで作成
    if (!imagecopyresampled($new_image, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height)){
        imagedestroy($im);
        imagedestroy($new_image);
        return false;
    }
    
    switch($_SESSION['image_type']){
        case "image/gif":
            imagegif($new_image, $filename);
            break;
        case "image/jpeg":
            imagejpeg($new_image, $filename);
            break;
        case "image/png":
            imagepng($new_image, $filename);
            break;
        default:
            break;
    }
    $_SESSION['image_data'] = file_get_contents($filename);
//    $_SESSION['image_data'] = $new_image; // $resultを$_SESSION['image_data']に上書き

    // 不要になった画像データの削除
    imagedestroy($im);
    imagedestroy($new_image);
    
    return true;
}
?>