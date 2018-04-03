<?php 

class imageTransform {
    var $image;
    var $target;
    var $savefile;
    var $size;
    var $debug = false; // Show errors
    var $quality = 100; // Result image quality 
    var $enlarge = true; // Enlarge image if width or height needed is bigger than original
    var $data = array(); // Image data array
    var $forceType = false; // Force image type create
    var $allowed = array( // Valid image formats
        1 => 'gif',
        2 => 'jpg',
        3 => 'png'
    );

    /**
    * function debug (string $message)
    *
    * Print the error messages
    */
    function debug ($message) {
        if ($this->debug) {
            $debug = debug_backtrace();

            rsort($debug);

            echo $message;

            foreach ($debug as $k => $v) {
                echo "\n\n".'<br /><br />'.str_repeat('&nbsp;', (2 + $k * 2)).'FILE: '.$v['file'];
                echo "\n".'<br />'.str_repeat('&nbsp;', (2 + $k * 2)).'LINE: '.$v['line'];
            }

            echo "\n".'<br />';
        }

        return false;
    }

    /**
    * function enlarge (boolean $value)
    *
    * When you resize or crop an image, you need the width and height
    * You can disable enlarge an image if the original size is lower than
    * the needed width and height
    */
    function enlarge ($value) {
        $this->enlarge = $value;
    }

    /**
    * function forceType (integer $type)
    *
    * Force to generate the new image with a concrete type
    *
    * (1 => GIF, 2 => JPEG, 3 => PNG)
    */
    function forceType ($type) {
        $this->forceType = $type;
    }

    /**
    * function itsImage (string $image)
    *
    * Check if it's a valid image
    *
    * return false:array
    */
    function itsImage ($image) {
        
        if ($data = @getImageSize($image)) {
            return empty($this->allowed[$data[2]])?false:$data;
        } else {
            return false;
        }
    }

    

    /**
    * function inlineHeaders (string $name)
    *
    * Print the inline headers to view function
    */
    function inlineHeaders ($name) {
        header('Content-type: image/'.$this->allowed[$this->data[2]]);
        header('Content-Disposition: inline; filename="'.$name.'"');
    }

    /** 
    *
    * View online an resize/crop image. 
    */
    function view ($savefile,$mode, $image, $param) {
        $this->savefile = $savefile; 
        if (!($this->data = $this->itsImage($image))) {
            return $this->debug($image.' isn\'t a valid image');
        }

        $name = explode('/', $image);
        $name = end($name);
        $ext = explode('.', $name);
        $ext = strtolower(end($ext));
 
        list($width, $height) = explode('x', $param);

        $width = intval($width);
        $height = intval($height);  

        $this->inlineHeaders($name);

        $ok = $this->$mode($image, $width, $height, false, true);

        if ($ok == true) {
            echo file_get_contents($this->savefile);
        } else {
            return false;
        }
    }

    /**
    * function defineTarget (string $thumb, boolean $view)
    *
    * Assign a valid value to target image
    *
    * return boolean
    */
    function defineTarget ($thumb, $view) {
        if ($view) {
            $this->target = $thumb?$thumb:false;
        } elseif (empty($thumb)) {
            if (!is_writable($this->image)) {
                return $this->debug('The original image haven\'t write permissions to me: '.$this->image);
            }

            $this->target = $this->image;
        } else {
            $this->target = $thumb;
            $folder = (dirname($this->target) == '')?'./':dirname($this->target);

            if (!$this->recursive_path($folder) || !is_writable($folder)) {
                return $this->debug('Can\'t write in the target folder: '.$folder);
            }
        }

        return true;
    }

     
    /**
    * function resize (string $image, integer $width, integer $height, string $thumb = '', boolean $view = false)
    *
    * This function resize an image maintaining the image proportions.
    *
    * If the parameter $thumb it's set, instead transform the image image,
    * create a new with the location in set.
    *
    * $whith and $height set the max sizes allowed to width and height, not set the
    * sizes in the result image, the result sizes are calculated with this values.
    *
    * $view condition is used in the online image view funcion
    *
    * return boolean
    */
    function resize ($image, $width, $height, $thumb = '', $view = false) { 
        $this->image = $image;
        $this->size = array($width, $height);

        //$this->defineTarget($thumb, $view);

        return $this->_mainTransform();
    }

     
 
    /**
    * function crop (string $image, integer $width, integer $height, string $thumb = '', boolean $view = false)
    *
    * Cut the image with the desired size. First the image is reduced or enlarged and after it's crop.
    *
    * If the parameter $thumb it's set, instead transform the image image,
    * create a new with the location in set.
    *
    * $view condition is used in the online image view funcion
    *
    * return boolean
    */
    function crop ($image, $width, $height, $thumb = '', $view = false) {
         

        $this->image = $image;
        $this->size = array($width, $height);

        //$this->defineTarget($thumb, $view);

        if ($width == $height) {
            $less = ($this->data[0] > $this->data[1]) ? $this->data[1] : $this->data[0];
            $width = $height = $less;
            $posX = intval(($this->data[0] / 2) - ($less / 2));
            $posY = intval(($this->data[1] / 2) - ($less / 2));
        } elseif ($width > $height) {
            list($height, $width, $posX, $posY) = $this->cropSize($this->data[1], $this->data[0], $height, $width);

            if ($posY < 0) {
                list($width, $height, $posY, $posX) = $this->cropSize($this->data[0], $this->data[1], $this->size[0], $this->size[1]);
            }
        } elseif ($width < $height) {
            list($width, $height, $posY, $posX) = $this->cropSize($this->data[0], $this->data[1], $width, $height);

            if ($posX < 0) {
                list($height, $width, $posX, $posY) = $this->cropSize($this->data[1], $this->data[0], $this->size[1], $this->size[0]);
            }
        }

        return $this->_mainTransform($posX, $posY, $width, $height, false);
    }

    /**
    * function cropSize (integer $sourceX, integer $sourceY, integer $targetX, integer $targetY)
    *
    * Calculate the size and coords to the crop action
    *
    * return array
    */
    function cropSize ($sourceX, $sourceY, $targetX, $targetY) {
        $sizeX = round(($sourceX * $targetX) / (($sourceX * $targetY) / $sourceY));
        $sizeY = $sourceY;
        $coordX = 0;
        $coordY = intval(($sourceX / 2) - ($sizeX / 2));

        return array($sizeX, $sizeY, $coordX, $coordY);
    }

     

    /**
    * function _mainTransform (integer $posX=0, integer $posY=0, integer $width=0, integer $height=0, boolean $proportions = true)
    *
    * Process the image transform
    *
    * return boolean
    */
    function _mainTransform ($posX=0, $posY=0, $width=0, $height=0, $proportions = true) {
        $newImage = $this->imageDefine();

        if (!$newImage) {
            return $this->debug($this->image.' isn\'t JPG, GIF nor PGN');
        }

        if ($proportions) {
            list($dX, $dY) = $this->proportions($this->data[0], $this->data[1]);
            list($width, $height) = array($this->data[0], $this->data[1]);
        } else {
            list($dX, $dY) = array($this->size[0], $this->size[1]);
        }

        list($posX, $posY) = $this->maxSize($posX, $posY, $width, $height);

        $thumb = $this->transparency($newImage, imageCreateTrueColor($dX, $dY));

        imageCopyResampled($thumb, $newImage, 0, 0, $posX, $posY, $dX, $dY, $width, $height);
        
        if ($this->imageCreate($thumb)) {
            return true;
        } else {
            return $this->debug('A problem occours creating the image. I can\'t finish the task.');
        }
    }

    /**
    * function imageDefine (void)
    *
    * Check the image format and create a new image with the same format
    *
    * return resource
    */
    function imageDefine () {
        switch ($this->data[2]) {
            case 1:
                return imageCreateFromGIF($this->image);
            case 2:
                return imageCreateFromJPEG($this->image);
            case 3:
                return imageCreateFromPNG($this->image);
            default:
                return false;
        }
    }

    /**
    * function imageCreate (resource $thumb)
    *
    * Create a new image from the $thumb resource
    *
    * return booelan
    */
    function imageCreate ($thumb) {
        if ($this->data[2] == 1) {
            $ok = imageGIF($thumb, $this->savefile, $this->quality); 
        } elseif ($this->data[2] == 3) {
            $quality = 10 - round($this->quality / 10);
            $quality = (($quality < 0)?0:(($quality > 9)?9:$quality));

            $ok = imagePNG($thumb, $this->savefile, $quality); 
        } else {
            $ok = imageJPEG($thumb, $this->savefile, $this->quality); 
        }

        if ($ok) {
            imageDestroy($thumb);

            return true;
        } else {
            return false;
        }
    }

    /**
    * function transparency (resource $original, resource $new)
    *
    * Check and aply the transparency to an image
    *
    * return resource
    */
    function transparency ($original, $new) {
        return $new;
        if (($this->data[2] !== 1) && ($this->data[2] !== 3)) {
            return $new;
        }

        $trans_index = imagecolortransparent($original);

        if ($trans_index >= 0) {
            $trans_color = imagecolorsforindex($original, $trans_index);
            $trans_index = imagecolorallocate($new, $trans_index['red'], $trans_index['green'], $trans_index['blue']);

            imagefill($new, 0, 0, $trans_index);
            imagecolortransparent($new, $trans_index);
        } else if ($this->data[2] === 3) {
            imagealphablending($new, false);

            $colorTransparent = imagecolorallocatealpha($new, 0, 0, 0, 127);

            imagefill($new, 0, 0, $colorTransparent);
            imagesavealpha($new, true);
        }

        return $new;
    }

    /**
    * function proportions (integer $width, integer $height)
    *
    * Calculate the image proportions to a scalable image
    *
    * return array
    */
    function proportions ($width, $height) {
        if ($width > $height) {
            $n_width = $this->size[0];
            $n_height = round(($n_width * $height) / $width);
        } elseif ($height > $width) {
            $n_height = $this->size[1];
            $n_width = round(($n_height * $width) / $height);
        } elseif ($this->size[0] > $this->size[1]) {
            $n_width = $this->size[1];
            $n_height = $this->size[1];
        } else {
            $n_width = $this->size[0];
            $n_height = $this->size[0];
        }

        if ($n_width > $this->size[0]) {
            $n_width = $this->size[0];
            $n_height = round(($n_width * $height) / $width);
        }

        if ($n_height > $this->size[1]) {
            $n_height = $this->size[1];
            $n_width = round(($n_height * $width) / $height);
        }

        return array($n_width,$n_height);
    }

    /**
    * function maxSize (integer $posX, integer $posY, integer $width, integer $height)
    *
    * Calculate the image position from the image area
    *
    * return array
    */
    function maxSize ($posX, $posY, $width, $height) {
        $posX = (($posX + $width) > $this->data[0])?($this->data[0] - $width):$posX;
        $posX = ($posX < 0)?0:$posX;
        $posY = (($posY + $height) > $this->data[1])?($this->data[1] - $height):$posY;
        $posY = ($posY < 0)?0:$posY;
        
        return array($posX,$posY);
    }

    /**
    * function recursive_path (string $target)
    *
    * Create a recursive folder
    *
    * return boolean
    */
    function recursive_path ($target) {
        if (is_dir($target)) {
            return true;
        }

        $dirs = explode('/', $target);
        $dir = '';

        foreach ($dirs as $part) {
            if (empty($part) || ($part == '.')) {
                continue;
            }

            $dir .= '/'.$part;

            if (($part == '..') || is_dir($dir)) {
                continue;
            } else if (!@mkdir($dir, 0755)) {
                return $this->debug('Can\'t write in the target folder: '.$dir);
            }
        }
 

        return is_dir($target);
    }
}

// Load class
$imageTransform = new imageTransform;
?>
