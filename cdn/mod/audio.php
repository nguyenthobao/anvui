<?php 
error_reporting(E_ALL);
require_once('class_upload_file/class.file.php');
require_once('class_upload_file/class.upload.php');
require_once('class_upload_file/class.exif.php');

$validations = array(
    'extension' => array(
        'is' => array('.mp3'), // default key
        ),
    'category' => array('audio'),
    'size' => 15 // maximum file (mb)
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
                $return['audio'] = $_NBH['part'].$file->name;
            }
            if(!$results){
                $return['status'] = false;
                $return['error'] = 'Error moving file';
            }
                   
    } else {
        $return['status'] = false;
        $return['error'] = $file->get_error();
    }
}
return $return;