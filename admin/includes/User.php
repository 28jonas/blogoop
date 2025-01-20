<?php

class User
{
    //properties
    //public,private, protected
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    //methods
    public static function find_this_query($sql, $values = []){
        global $database;
        $result = $database->query($sql,$values);
        $the_object_array = [];
        while($row = mysqli_fetch_assoc($result)){
            $the_object_array[] = self::instantie($row);
        }
        return $the_object_array;
    }

    public static function instantie($result){
        $the_object = new self();
        foreach($result as $the_attribute => $value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    public function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public static function find_all_users(){
        return self::find_this_query("SELECT * FROM users");
    }
    public static function find_user_by_id($user_id){
        //binden van parameters= ($user_id)=PREPARED STATEMENTS
        $result = self::find_this_query("SELECT * FROM users WHERE id=?",[$user_id]);
        return !empty($result) ? array_shift($result): false;
    }

}