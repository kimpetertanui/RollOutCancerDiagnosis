<?php

class Extras
{
 
    function __construct()  { }
 
    function __destruct() { }
 
    function encryptQuery1($keySalt, $qry, $val, $landing_page){

         //making query string
        $qryStr = "$qry=".$val; 

        //this line of code encrypt the query string
        $query = base64_encode(
                        urlencode( 
                                mcrypt_encrypt(
                                    MCRYPT_RIJNDAEL_256, 
                                    md5($keySalt), 
                                    $qryStr, 
                                    MCRYPT_MODE_CBC, 
                                    md5(md5($keySalt))
                                )
                            )
                        );    

        $link = "$landing_page?".$query;

        return $link;
    }

    function decryptQuery1($keySalt, $qryStr){

        //this line of code decrypt the query string
        $queryString = rtrim(
                            mcrypt_decrypt(
                                    MCRYPT_RIJNDAEL_256, 
                                    md5($keySalt), 
                                    urldecode(base64_decode($qryStr)), 
                                    MCRYPT_MODE_CBC, 
                                    md5(md5($keySalt))), 
                                    "\0");   

        parse_str($queryString);

        $val = explode('=', $queryString);

        $count = count($val);

        if($count == 2)
            return $val[1];

        return null;
    }


    function encryptQuery2($keySalt, $qry1, $val1, $qry2, $val2, $landing_page){

        //making query string
        $qryStr = "$qry1=".$val1."&$qry2=".$val2;  

        //this line of code encrypt the query string
        $query = base64_encode(
                        urlencode( 
                                mcrypt_encrypt(
                                    MCRYPT_RIJNDAEL_256, 
                                    md5($keySalt), 
                                    $qryStr, 
                                    MCRYPT_MODE_CBC, 
                                    md5(md5($keySalt))
                                )
                            )
                        );    

        $link = "$landing_page?".$query;

        return $link;
    }


    function decryptQuery2($keySalt, $qryStr){

        //this line of code decrypt the query string
        $queryString = rtrim(
                            mcrypt_decrypt(
                                    MCRYPT_RIJNDAEL_256, 
                                    md5($keySalt), 
                                    urldecode(base64_decode($qryStr)), 
                                    MCRYPT_MODE_CBC, 
                                    md5(md5($keySalt))), 
                                    "\0");   

        parse_str($queryString);

        $amp = explode('&', $queryString);
        $ampCount = count($amp);
        
        if($ampCount == 2) {
            $equal1 = explode('=', $amp[0]);
            $equal2 = explode('=', $amp[1]);

            $equalCount1 = count($equal1);
            $equalCount2 = count($equal2);

            if($equalCount1 == 2 && $equalCount2 == 2) {
                $val = array();
                $val[0] = $equal1[1];
                $val[1] = $equal2[1];

                return $val;
            }

        }

        return null;
    }


    function removeHttp($str) {
        
        $prefix = 'http://';
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            $str = substr($str, strlen($prefix));
        }

        $prefix = 'https://';
        if (substr($str, 0, strlen($prefix)) == $prefix) {
            $str = substr($str, strlen($prefix));
        }

        return $str;
    }

    function uploadFile($key, $prefix) {

        $desired_dir = Constants::IMAGE_UPLOAD_DIR;
        $errors= array();
        $count=count($_FILES[$key]["name"]);
        $file_name = $_FILES[$key]['name'];
        $file_size = $_FILES[$key]['size'];
        $file_tmp = $_FILES[$key]['tmp_name'];
        $file_type= $_FILES[$key]['type'];
        // if($file_size > 2097152){
        //     $errors[]='File size must be less than 2 MB';
        // }    

        $timestamp =  uniqid();
        $temp = explode(".", $_FILES[$key]["name"]);
        $extension = end($temp);

        $extension = "";
        $image_info = getimagesize($_FILES[$key]["tmp_name"]);
        switch ($image_info['mime']) {
            case 'image/gif':
                $extension = 'gif';
                break;
            case 'image/jpeg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            default:
                return "";
                break;
        }

        $new_file_name = $desired_dir."/".$prefix.$timestamp.".".$extension;
        if(empty($errors)==true) {
            if(is_dir($desired_dir)==false) {
                // Create directory if it does not exist
                mkdir("$desired_dir", 0700);        
            }
            if(is_dir($file_name)==false) {
                // rename the file if another one exist
                move_uploaded_file($file_tmp, $new_file_name);
            }
            else {                                   
                $new_dir = $new_file_name.time();
                rename($file_tmp, $new_dir) ;               
            }
            return Constants::ROOT_URL.$new_file_name;
        }
        else {
            return "";
        }
    }

}
 
?>