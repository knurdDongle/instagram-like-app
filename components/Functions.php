<?php

class Functions 
{
    public static function imageresize($img, $extension)
    {
        imagepng(imagecreatefromstring(file_get_contents($img)), $img);
        $size = getimagesize($img);
        $src = imagecreatefrompng($img);
        $dst = imagecreatetruecolor(800, 800);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, 800, 800, $size[0], $size[1]);
        imagepng($dst, $img, 0);
        imagedestroy($src);
    }  

    public static function removeExtension($photo)
    {
        $photo = explode('.', $photo);

        return array_shift($photo);
    }

    public static function ceilTime($date) 
    {
        $currentTime = time() + 3600;
        $creatingTime = strtotime($date);

        switch ($diff = $currentTime - $creatingTime)
        {
            case ($diff < 10): 
                return "A few seconds ago";
                break;
            case ($diff < 60):
                return "$diff seconds ago";
                break;
            case ($diff < 3600):
                $echoTime = round($diff / 60);
                return "$echoTime minutes ago";
                break;
            case ($diff < 12800): 
                $echoTime = round($diff / 60 / 60);
                return "$echoTime hours ago";
                break;
            default: 
                return date("F j, Y, g:i a", strtotime($date));
                break;
        } 
        
    }
}
