<?php
namespace modava\faq\components;

use modava\imagick\Imagick;
use yii\base\Component;

class MyUpload extends Component
{
    public static function uploadFromOnline($width, $height, $pathImage, $pathSave, $fileName = null)
    {
        $imagick = new Imagick($pathImage, true);
        if ($fileName != null) {
            $imagick->filename = $fileName;
        }
        return $imagick->resizeImage($width, $height)->saveTo($pathSave);
    }

    public static function uploadFromLocal($width, $height, $pathImage, $pathSave, $fileName = null)
    {
        $imagick = new Imagick($pathImage);
        if ($fileName != null) {
            $imagick->filename = $fileName;
        }
        return $imagick->resizeImage($width, $height)->saveTo($pathSave);
    }
}
