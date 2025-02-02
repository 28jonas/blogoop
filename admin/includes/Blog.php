<?php

class Blog extends Db_object
{
    /*properties*/
    protected static $table_name = 'blogs';
    public $id;
    public $author_id;
    public $photo_id;
    public $title;
    public $description;
    public $created_at;
    public $deleted_at;

    /*methods*/
    public function get_properties(){
        return[
            'id'=> $this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'photo_id'=>$this->photo_id,
            'author_id'=>$this->author_id,
            'created_at'=>$this->created_at,
            'deleted_at'=>$this->deleted_at,
        ];
    }
}