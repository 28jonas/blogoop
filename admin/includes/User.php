<?php

class User
{
    /*properties*/
    /*public, private, protected*/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    /*Methods*/
    public static function find_this_query($sql, $values=[]){
        global $database;
        $result = $database->query($sql, $values);
        return $result;
    }

    public static function find_all_users(){
        /*global $database;*/
        /*$result = $database -> query("SELECT * FROM users");
        return $result; deze twee vervangen door rij hieronder*/
        return self::find_this_query("SELECT * FROM users");

    }

    public static function find_user_by_id($user_id){
        /*zorgt voor connectie met database*/
        /*global $database;*/
        /*userid sanitizen (in samenwerking met prepared statements eigenlijk niet meer nodig)*/
        /*$user_id = $database->escape_string($user_id);*/
        /*binden van parameters = ($user_id) = prepared statements*/
        /*$result = $database -> query("SELECT * FROM users WHERE id =?", [ $user_id ]);
        return $result;*/
        return self::find_this_query("SELECT * FROM users WHERE id =?", [ $user_id ]);
    }

}