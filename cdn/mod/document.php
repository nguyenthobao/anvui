<?php 
error_reporting(E_ALL);
require_once('class_upload_file/class.file.php');
require_once('class_upload_file/class.upload.php');
require_once('class_upload_file/class.exif.php'); // optional
$date = date("Y/m/d");
// if (!is_dir($_NBH['part'].'document/'.$data['idw'])) {
//     mkdir($_NBH['part'].'document/'.$data['idw']);
//     chmod($_NBH['part'].'document/'.$data['idw'],0775);
// }
$date = date('Y/m/d');
$dir = $_NBH['part'].'document/'.$data['idw'].'/'.$date;


    function rmkdir($path, $mode = 0777) {
        return is_dir($path) || ( rmkdir(dirname($path), $mode) && _mkdir($path, $mode) );
    }

    function _mkdir($path, $mode = 0777) {
        $old = umask(0);
        $res = @mkdir($path, $mode);
        umask($old);
        return $res;
    }
rmkdir($dir);
$_NBH['part'] = $dir.'/';

$validations = array(
    'category' => array('document'),
    'size' => 5
);
// create new instance
$upload = new Upload($_FILES['file'], $validations);
// for each file
foreach ($upload->files as $file) {
    if ($file->validate()) {
            $filedata = $file->get_base64();
            //$gps = $file->get_exif_gps();
            $results = $file->put($_NBH['part']);
            if ($results) {
                $return['status'] = true;
                $return['document'] = $_NBH['part'].$file->name;
            }
            $return['error'] = $results ? '' : 'Error moving file';        
    } else {
        $return['status'] = false;
        $return['error'] = $file->get_error();
    }
}
return $return;