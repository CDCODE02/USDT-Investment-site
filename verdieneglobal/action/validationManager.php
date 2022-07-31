<?php

    trait validationManager{

        public $errors = [];

        //vlidate empty function
        private function validateEmpty(string $value, $fieldName, $key){
            if(empty($value)){
                $this->returnErrorValues($key, $fieldName.' is required');
            }
        }

        //vlidate number function
        private function validateNumber(string $value, $fieldName, $key){
            if(!is_numeric($value)){
                $this->returnErrorValues($key, $fieldName.' must be a number');
            }
        }

        //vlidate Email function
        private function validateEmail(string $value, $fieldName, $key){
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                $this->returnErrorValues($key, $fieldName.' must be an email address');
            }
        }

        //vlidate empty function
        private function validatePassword(array $value, $fieldName, $key){
            if($value[0] != $value[1]){
                $this->returnErrorValues($key, 'Passwords does not match');
            }
        }

        private function validateDateFormat(string $date, $fieldName, $key){
            //YYYY-MM-DD
            $explodedDate = explode('-', $date);//exploded date => ['YYYY', 'MM', 'DD'];
            if(count($explodedDate) != 3){
                $this->returnErrorValues($key, $fieldName.' must be of this format: YYYY-MM-DD');
                return;
            }

            if(strlen($explodedDate[0]) != 4 && $explodedDate[1] != 2 && $explodedDate[2] != 2){
                $this->returnErrorValues($key, $fieldName.' must be of this format: YYYY-MM-DD');
                return;
            }

        }

        private function returnErrorValues($key, $message){
            $error_array = [];
            if(array_key_exists($key, $this->errors)){
                $error_array = $this->errors[$key];
                $error_array[] = $message;
            }else{
                $error_array[] = $message;
            }
            $this->errors[$key] = $error_array;

        }

        public function callValidation(array $thingsToValidate){
            //['value|fieldName|key|type1,type', 'value|fieldName|key|type1,type']
            //for passwordmatch: ['value|fieldName|key|type1,type2....', 'value|fieldName|key|type1,type2...']
            for($i = 0; $i < count($thingsToValidate); $i++){

                //['value', 'fieldName', 'key','type1,type2'];
                $xplodedThiingsToValidate = explode('|', $thingsToValidate[$i]);

                //check to make sure user supplied correct format for validation
                if(count($xplodedThiingsToValidate) != 4){
                    $this->errors = [];
                    $this->errors['validation_input_error'] = 'Please make sure you supplied parameters for validation in correct format';
                    return;
                }

                //explode the last value in the array using comma as delimitter
                //['type1', 'type2'];
                $exploded_types = explode(',', $xplodedThiingsToValidate[3]);
                $this->handleValidatioByType($exploded_types, $xplodedThiingsToValidate);


            }

            if(count($this->errors) > 0){
                return false;
            }
            return true;

        }


        function handleValidatioByType($exploded_types, $xplodedThiingsToValidate){

            for($l = 0; $l < count($exploded_types); $l++){

                switch ($exploded_types[$l]){
                    case 'empty':
                        $this->validateEmpty($xplodedThiingsToValidate[0], $xplodedThiingsToValidate[1],$xplodedThiingsToValidate[2]);
                        break;
                    case 'email':
                        $this->validateEmail($xplodedThiingsToValidate[0], $xplodedThiingsToValidate[1],$xplodedThiingsToValidate[2]);
                        break;
                    case 'password-match':
                        $this->validatePassword(explode(',', $xplodedThiingsToValidate[0]), $xplodedThiingsToValidate[1],$xplodedThiingsToValidate[2]);
                        break;
                    case 'number':
                        $this->validateNumber($xplodedThiingsToValidate[0], $xplodedThiingsToValidate[1],$xplodedThiingsToValidate[2]);
                        break;
                    case 'date_format':
                        $this->validateDateFormat($xplodedThiingsToValidate[0], $xplodedThiingsToValidate[1],$xplodedThiingsToValidate[2]);
                        break;

                }

            }

        }

    }

?>

