<?php

class User extends BaseModel {

    public $id, $name, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
        //$this->validators = array('validate_name', 'validate_description', 'validate_importance');
    }

    public static function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            return new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        } else {
            // Käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare
                ('SELECT * FROM Player WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $job = new Job(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $job;
        }
        return null;
    }

}
