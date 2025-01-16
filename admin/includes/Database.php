<?php
require_once("config.php");
class Database
{
    /* properties (props)*/
    public $connection;
    /* methods (functions)*/
    public function open_db_connection(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()){
            printf("Connectie is mislukt: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function query($sql){
        $result = $this -> connection -> query($sql);
        $this ->confirm_query($result);
        return $result;
    }

    public function confirm_query($result){
        if(!$result){
            die('Query Failed'. $this -> connection -> error);
        }
    }

    /* default constructor */
    function __construct(){
        $this->open_db_connection();
    }

}
$database = new Database();
?>