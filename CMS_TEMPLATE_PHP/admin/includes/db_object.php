<?php

class Db_object {

    public static function find_all(){

        return static::find_by_query("SELECT * FROM ".static::$db_table);

    }

    public static function find_by_id($id){
        $result_set = static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id = $id limit 1");

        return !empty($result_set) ? array_shift($result_set) : false;
    }

    public static function find_by_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while($row = mysqli_fetch_array($result_set)){
            $object_array[] = static::instantation($row);
        }
        return $object_array;
    }

    public static function instantation($array){

        $calling_class = get_called_class();

        $user = new $calling_class;

        foreach ($array as $attribute => $value){
            if($user->has_the_attribute($attribute)){
                $user->$attribute = $value;
            }
        }
        return $user;
    }

    private function has_the_attribute($attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    protected function properties(){

        $properties = array();

        foreach (static::$db_table_fields as $db_field) {

            if(property_exists($this, $db_field)){

                $properties[$db_field] = $this->$db_field;

            }

        }
        return $properties;
    }
    protected function clean_properties(){

        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {

            $clean_properties[] = $database->escape_string($value);

        }

        return $clean_properties;

    }

    public function create(){

        global $database;
        $properties = $this->properties();

        $sql = "INSERT INTO " .static::$db_table. "(".implode("," , array_keys($properties)).") VALUES ('".implode("','" , array_values($properties))."')";
        if($database->query($sql)){

            $this->id = $database->the_insert_id();

            return true;

        } else {

            return false;

        }

    }

    public function update(){

        global $database;
        $properties = $this->properties();
        $properties_pair = array();

        foreach ($properties as $key => $value){

            $properties_pair[] = "{$key}='{$value}'";

        }

        $sql = "UPDATE " .static::$db_table. " SET ".implode(",", $properties_pair)." WHERE id = '$this->id'";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function delete() {
        global $database;
        $sql = "DELETE FROM " .static::$db_table. " WHERE id = '$this->id' ";

        $database->query($sql);
    }

    public function save(){

        return isset($this->id) ? $this->update() : $this->create();

    }

}
