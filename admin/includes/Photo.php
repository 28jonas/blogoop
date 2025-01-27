<?php

class Photo extends Db_object
{
    protected static $table_name = 'photos';
    public $id;
    public $title;
    public $description;
    public $filename;
    public $size;
    public $type;

    public $tmp_path;
    public $upload_directory = "assets/images/photos";
    public $errors = array(); //of []
    public $upload_errors_array = [
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE=>"The uploaded file exceeds the upload max_filesize from php.ini",
        UPLOAD_ERR_FORM_SIZE=>"The uploaded file exceeds MAX_FILE_SIZE in php.ini voor een html form",
        UPLOAD_ERR_NO_FILE=>"No file uploaded",
        UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR=>"Missing temp folder",
        UPLOAD_ERR_CANT_WRITE=>"Failed to write to disk",
        UPLOAD_ERR_EXTENSION=>"A php extension stopped your upload",

    ];


    /**
     * Retrieves the properties of the Photo object as an associative array.
     *
     * @return array An associative array containing the properties of the Photo object:
     *               - 'id': The ID of the photo.
     *               - 'title': The title of the photo.
     *               - 'description': The description of the photo.
     *               - 'filename': The filename of the photo.
     *               - 'size': The size of the photo.
     *               - 'type': The type of the photo.
     */
    public function get_properties(){
        return[
            'id'=> $this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'filename'=>$this->filename,
            'size'=>$this->size,
            'type'=>$this->type
        ];
    }
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[]="No file uploaded";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[]= $this->upload_errors_array['error'];
            return false;
        }else{
            $date = date('Y_m_d_H_i_s');
            $without_extension  = pathinfo(basename($file['name']), PATHINFO_FILENAME);
            $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);
            $this->filename = $without_extension.$date.'.'.$extension;
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmp_path= $file['tmp_name'];
            return true;
        }
    }
    public function save(){
        $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;

        if($this->id){
            $this->update();
            if(move_uploaded_file($this->tmp_path,$target_path)){
                if($this->create()){//aanmaken in de database
                    unset($this->tmp_path);
                    return true;
                }
            }
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[]="File not available";
                return false;
            }
            if(file_exists($target_path)){
                $this->errors[]= "File {$this->filename} EXISTS!";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                //uploaden in de images map
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[]= "This folder has no write rights";
                return false;
            }

        }
    }

}