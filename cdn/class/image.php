<?php 
error_reporting(E_ALL); 
include('mod/class/class.upload.php');

//config
$typeimage = array('jpg','gif','png','jpeg','JPG','GIF','PNG','JPEG');
$jpg_mod =  array('news','album','video');
$max = 1600;

$dir_dest = $_QC['part']; 

$file = $_FILES[$name_field];

if( in_array(getExtension($file['name']), $typeimage))
{
    $handle = new Upload($_FILES[$name_field]);
    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        if($handle->image_src_x > $max && $handle->image_src_y > $max )
        {
            $handle->image_resize = true;
            if($handle->image_src_x > $handle->image_src_y)
            {
                $handle->image_x = $max;
                $handle->image_ratio_y = true;
            }
            else
            {
                $handle->image_y = $max;
                $handle->image_ratio_x = true;
            }
        }else if ( $handle->image_src_x > $max ){
            $handle->image_resize = true;
            $handle->image_x = $max;
            $handle->image_ratio_y = true;
        }else if ($handle->image_src_y > $max ) {
            $handle->image_resize = true;
            $handle->image_y = $max;
            $handle->image_ratio_x = true;
        }
        //$name = $_QC['timestamp'].check_befor_upload($file['name']);
        $name = $_QC['timestamp'].rand(1,99);
        
        if(!empty($data['file_name']))
            $name .= $data['file_name'];
        $handle->image_background_color = null;
        if(in_array($module, $jpg_mod))
            $handle->image_convert = 'jpg';

        $handle->file_new_name_body = $name;
        $handle->jpeg_quality = 100;

         

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
        $handle->Process($dir_dest);


        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            $return['status'] = true;
            $return['img'] = $_QC['url'] . $handle->file_dst_name;
            $info = getimagesize($handle->file_dst_pathname);
            $info['size'] = round(filesize($handle->file_dst_pathname)/256)/4;
            $return['info'] = $info; 
        } else {
            $return['status'] = false;
            $return['error'] = $handle->error; 
        }  
        ////////////////////////////////////////////////////////////
        ///////////BEGIN THUMB
        ////////////////////////////////////////////////////////////
        if(is_array($data['thumb']))
        foreach ($data['thumb'] as $key => $value) {
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = $value; 
            $handle->image_convert = 'jpg';
            $handle->file_new_name_body = $name.'.jpg_'.$value;
            $handle->jpeg_quality = 80;

            $handle->Process($dir_dest);
        }
        
        ////////////////////////////////////////////////////////////
        ///////////END THUMB
        ////////////////////////////////////////////////////////////

        $handle-> Clean();

    } else {
        $return['status'] = false;
        $return['error'] = $handle->error; 
    } 
}
else
{
    $return['status'] = false;
    $return['error'] = 'dinh dang khong cho phep'; 
}


function check_befor_upload($string)
    {
        $string = str_replace(' ','_',$string);
        $string = str_replace('@','a',$string);
        $string = str_replace('%','_',$string);
        $string = str_replace('#','_',$string);
        $string = str_replace('!','_',$string);
        $string = str_replace('^','_',$string);
        $string = str_replace('&','_',$string);
        $string = str_replace('*','_',$string);
        $string = str_replace('+','_',$string);
        $string = str_replace('.'.getExtension($string),'',$string);

        
        return $string;
    }
?>