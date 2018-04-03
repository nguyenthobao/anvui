<?php 
error_reporting(E_ALL);
require_once('class_upload_file/class.file.php');
require_once('class_upload_file/class.upload.php');
require_once('class_upload_file/class.exif.php'); // optional

$validations = array(
    'category' => array('flash'), // validate only those files within this list
    'size' => 8 // maximum of 20mb
);
// create new instance
$upload = new Upload($_FILES['file'], $validations);
// for each file
foreach ($upload->files as $file) {
    if ($file->validate()) {
            $filedata = $file->get_base64();
            // or get the GPS info ...
            $gps = $file->get_exif_gps();
            // then we move it to 'path/to/my/uploads'
            $results = $file->put($_NBH['part']);
            if ($results) {
                $return['status'] = true;
                $return['flash'] = $_NBH['part'].$file->name;
            }
            $return['error'] = $results ? '' : 'Error moving file';        
    } else {
        $return['status'] = false;
        $return['error'] = $file->get_error();
    }
}
return $return;