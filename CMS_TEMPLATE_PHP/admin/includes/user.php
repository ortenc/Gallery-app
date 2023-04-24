<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','first_name','last_name','user_image');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $user_image;
    public $upload_directory = "photos";
    public $image_placeholder = "http://palcehold.it/400x400&text=image";
    public $errors = array();
    public $upload_errors = array(
        UPLOAD_ERR_OK         => 'There is no error',
        UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive',
        UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive',
        UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload',
    );


    public function set_file($file)
    {

        if (empty($file) || !$file || !is_array($file)) {

            $this->errors[] = "There was no file uploaded here";

            return false;

        } elseif ($file['error'] != 0) {

            $this->errors[] = $this->upload_errors[$file['error']];

        } else {

            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];

        }

    }
    public static function verify_user($username,$password) {

        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $result_set = "SELECT * FROM ".self::$db_table." WHERE username = '$username' and password = '$password'";
        $result_array = self::find_by_query($result_set);
        return !empty($result_set) ? array_shift($result_array) : false;

    }

    public function user_image(){

        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;

    }

    public function save_photo()

    {
        if ($this->id) {

            $this->update();

        } else {

            if (!empty($this->errors)) {

                return false;

            }

            if (empty($this->user_image || empty($this->tmp_path))) {

                $this->errors[] = "the file was not available";

                return false;

            }

            $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;

            if (file_exists($target_path)) {

                $this->create();

                return true;

            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {

                if ($this->create()) {

                    unset($this->tmp_path);

                    return true;

                } else {

                    $this->errors[] = "the file directory probably does not have permission";

                    return false;

                }

            }

            $this->create();

        }
    }

}
