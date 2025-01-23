<?php

class Validation
{
    //properties
    //public,private, protected

    /*Methodes*/
    public function validation_username($username, &$errors){
        // \w equals "[0-9A-Za-z_]" valid username, alphanumeric & longer than or equals 3 chars
        if(preg_match('/^\w{3,}$/', $username)) {
            return true;
        }else{
            $errors[] = "username is to short";
            return false;
        }
    }

    public function validation_password($password, &$errors){
        if(strlen($password)){
            if(preg_match("#[\W]+#", $password)){
                return true;
            }else{
                $errors[] = "password does not have a special character";
                return false;
            }
        }else{
            $errors[] = "password is to short";
            return false;
        }
    }
}