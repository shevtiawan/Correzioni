<?php
class JqImgcropComponent extends Object {
    function uploadGallery($image, $image_dir, $prefix, $image_setting){
      $upload_dir = WWW_ROOT.str_replace("/", DS, $image_dir);
      if(!isset($image_setting['image_large_size']))
        $image_setting['image_large_size'] = 1024;
      if(!isset($image_setting['image_medium_size']))
        $image_setting['image_medium_size'] = 600;
      if(!isset($image_setting['image_thumbnail_size']))
        $image_setting['image_thumbnail_size'] = 80;
      
      if(!is_dir($upload_dir)){
        if(!@mkdir($upload_dir,0777,true))
        {
          return false;exit();
        }
      }
      
      $max_file = "1457280";                         // Approx 1MB
      $imageName =  preg_replace("/\W/", "_", $image["name"]);
      $file_ext = substr($image["name"], strrpos($image["name"], ".") + 1);
      $imageName = $prefix.basename(str_replace("_".$file_ext,"",$imageName)).".".$file_ext;
      $uploadTarget = $upload_dir.DS.$imageName;
      $bigImagePath = $upload_dir.DS."big_".$imageName;
      $mediumImagePath = $upload_dir.DS."medium_".$imageName;
      $smallImagePath = $upload_dir.DS."thumbnail_".$imageName;
      
      if (isset($image['name'])){
            move_uploaded_file($image["tmp_name"], $uploadTarget );
            $width = $this->getWidth($uploadTarget);
            $height = $this->getHeight($uploadTarget);
            copy($uploadTarget, $mediumImagePath);
            copy($uploadTarget, $smallImagePath);
            copy($uploadTarget, $bigImagePath );
            unlink($uploadTarget);
            //BIG IMAGE SIZE
            if ($width > $image_setting['image_large_size']){
              $scale = $image_setting['image_large_size']/$width;
              $this->resizeImage($bigImagePath, $width, $height, $scale);
            }else{
              $scale = 1;
              $this->resizeImage($bigImagePath, $width, $height, $scale);
            }
            
            //MEDIUM IMAGE SIZE
            if ($width > $image_setting['image_medium_size']){
              $scale = $image_setting['image_medium_size']/$width;
              $uploaded = $this->resizeImage($mediumImagePath, $width, $height, $scale);
            }else{
              $scale = 1;
              $uploaded = $this->resizeImage($mediumImagePath, $width, $height, $scale);
            }
            
            //THUMBNAIL IMAGE SIZE
            if ($width > $image_setting['image_thumbnail_size']){
              $scale = $image_setting['image_thumbnail_size']/$width;
              $uploaded = $this->resizeImage($smallImagePath, $width, $height, $scale);
            }else{
              $scale = 1;
              $uploaded = $this->resizeImage($smallImagePath, $width, $height, $scale);
            }
      }
      
      return array('imagePath' => $image_dir, 'imageName' => $imageName);
    }
    
    function uploadImage($uploadedInfo, $uploadTo, $prefix, $subfolder, $max_width){
        $upload_path = $uploadTo.$subfolder;
        $upload_dir = WWW_ROOT.str_replace("/", DS, $upload_path);

        if(!is_dir($upload_dir)){
          if(!@mkdir($upload_dir,0777,true))
          {
            return false;exit();
          }
        }

        $max_file = "1457280";                         // Approx 1MB
        $userfile_name = preg_replace("/\W/", "_", $uploadedInfo["name"]);
        $userfile_tmp =  $uploadedInfo["tmp_name"];
        $userfile_size = $uploadedInfo["size"];
        $file_ext = substr($uploadedInfo["name"], strrpos($uploadedInfo["name"], ".") + 1);
        $filename = $prefix.basename(str_replace("_".$file_ext,"",$userfile_name)).".".$file_ext;
        $uploadTarget = $upload_dir.DS.$filename;

        if(empty($uploadedInfo)) {
          return false;
        }

        if (isset($uploadedInfo['name'])){
            move_uploaded_file($userfile_tmp, $uploadTarget );
            //chmod($uploadTarget , 0777);
            $width = $this->getWidth($uploadTarget);
            $height = $this->getHeight($uploadTarget);
            // Scale the image if it is greater than the width set above
            if($max_width > 0){
              if ($width > $max_width){
                $scale = $max_width/$width;
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
              }else{
                $scale = 1;
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
              }
            }
        }
        return array('imagePath' => $upload_path.$filename, 'imageName' => $filename, 'imageWidth' => $this->getWidth($uploadTarget), 'imageHeight' => $this->getHeight($uploadTarget));
    }

    function getHeight($image) {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }
    function getWidth($image) {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }

    function resizeImage($image,$width,$height,$scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        if($ext == "png" || $ext == "PNG"){
            imagepng($newImage,$image,0);
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
            imagejpeg($newImage,$image,90);
        }elseif($ext == "gif" || $ext == "GIF"){
            imagegif($newImage,$image);
        }
        chmod($image, 0777);
        return $image;
    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
        }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);

        if($ext == "png" || $ext == "PNG"){
            imagepng($newImage,$thumb_image_name,0);
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
            imagejpeg($newImage,$thumb_image_name,90);
        }elseif($ext == "gif" || $ext == "GIF"){
            imagegif($newImage,$thumb_image_name);
        }

        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    function cropImage($thumb_width, $x1, $y1, $x2, $y2, $w, $h, $thumbLocation, $imageLocation){
        $scale = $thumb_width/$w;
        $cropped = $this->resizeThumbnailImage(WWW_ROOT.str_replace("/", DS,$thumbLocation),WWW_ROOT.str_replace("/", DS,$imageLocation),$w,$h,$x1,$y1,$scale);
        return $cropped;
    }
}
?>
