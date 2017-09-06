<?php

class Functions 
{
    public static function imageresize($img, $new_width, $new_height, $extension)
    {
        switch ($extension) {
            case 'jpg':
                $copy = imagecreatefromjpeg($img);
                break;
            case 'png':
                $copy = imagecreatefrompng($img);
                break;
            case 'gif':
                $copy = imagecreatefromgif($img);
                break;
        }

        $resized_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($resized_image, $copy, 0, 0, 0, 0, $new_width, $new_height, imagesx($copy), imagesy($copy));

        switch ($extension) {
            case 'jpg':
                imagejpeg($resized_image, $img, 100);
                break;
            case 'png':
                imagepng($resized_image, $img, 0);
                break;
            case 'gif':
                imagegif($resized_image, $img, 0);
                break;
        }

        imagedestroy($copy);
        imagedestroy($resized_image);
    }  
}
