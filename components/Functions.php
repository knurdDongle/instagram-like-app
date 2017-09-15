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
                return "Несколько секунд назад";
                break;
            case ($diff < 60):
                return "$diff секунд назад";
                break;
            case ($diff < 3600):
                $echoTime = $diff / 60;
                return "$echoTime минут назад";
                break;
            case ($diff < 12800): 
                $echoTime = $diff / 60 / 60;
                return "$echoTime часов назад";
                break;
            default: 
                return $date;
                break;
        } 
        
    }
}
