<?php

use App\Entity\User;

namespace App\Service;

use Tinypng\Bundle\EventListener;

class ImageOptimizer
{
    public function optimize($source)
    {
        $source->toFile($dir."/optimized/".$fileName);
        //unlink($dir.$fileName ) ;
    }

    public function resize($fileName) {
        $dir = 'build/uploads/pictures/';
        \Tinify\setKey("YN-tD6vaVHxYTx8XcfBLKFrlzXwwxgLi");
        $source = \Tinify\fromFile($dir.$fileName);
        $resized = $source->resize(array(
            "method" => "thumb",
            "width" => 498,
            "height" => 500,
        ));
        $resized->toFile($dir."/optimized/".$fileName);
    }
}