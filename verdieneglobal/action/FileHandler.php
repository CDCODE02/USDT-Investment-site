<?php

trait FileHandler {

    public function FileUploader($fileIndex = 'passport', $allowedFiletypes = ['jpg', 'png', 'gif', 'jpeg'], $maxFileSize = 1000000, $maxFileSizeString = '1megabyte', $filePath = '../images/image_uploads/'){

        $fileName = $_FILES[$fileIndex]['name'];
        $fileSize = $_FILES[$fileIndex]['size'];
        //$fileType = $_FILES[$fileIndex]['type'];
        $temporalName = $_FILES[$fileIndex]['tmp_name'];

        //validate the file
        if(empty($fileName)){
            return ['error_code'=>1, 'error'=>'Please upload a file'];
        }

        if($fileSize > $maxFileSize){
            return ['error_code'=>1, 'error'=>'file size cannot be greater than '.$maxFileSizeString];
        }

        //passport.png => ['passport', 'png']
        $explodedFileName = explode('.', $fileName);
        $lengthOfArray = count($explodedFileName);
        $extension = $explodedFileName[$lengthOfArray - 1];

        if(!in_array(strtolower($extension), $allowedFiletypes)){
            return ['error_code'=>1, 'error'=>'Please upload required file type: '.$this->createFiletypesForErrorMessage($allowedFiletypes)];
        }

        //rename the file
        $name = time().uniqid().'.' . $extension;

        //upload the file
        if(move_uploaded_file($temporalName, $filePath.$name)){
            return ['error_code'=>0, 'data'=>$name];
        }
        return ['error_code'=>1, 'error'=>'Image upload failed'];


    }

    function createFiletypesForErrorMessage($allowedFiletypes){
        $string = '';
        for($i = 0; $i < count($allowedFiletypes); $i++){

            $string .= $allowedFiletypes[$i].' file, ';

        }
        return rtrim($string, ',');

    }

}
?>
