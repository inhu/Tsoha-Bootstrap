<?php

class Category extends BaseModel {

    public $id, $player_id, $name;
    public $validators;

    function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
        public static function all() {
        $user = UserController::get_user_logged_in();
        if ($user == NULL)
            return;
        $query = DB::connection()->prepare('SELECT * FROM Category where player_id=:player_id');
        $query->execute(array('player_id' => $user->id));
        $rows = $query->fetchAll();
        $categories = array();

        foreach ($rows as $row) {
            $categories[] = new Category(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
            ));
        }
        return $categories;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare
                ('SELECT * FROM Category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $category = new Category(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'name' => $row['name'],
            ));
            return $category;
        }
        return null;
    }
    
        public static function findName($id) {
        $query = DB::connection()->prepare
                ('SELECT * FROM Category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
                return $row['name'];
        }
        return null;
    }
    
    public function save() {
        $user = UserController::get_user_logged_in();
        $query = DB::connection()->prepare('INSERT INTO Category (name, player_id) VALUES (:name, :player_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'player_id' => $user->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Category WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        if (strlen($this->name) < 2) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
        }
        return $errors;
    }
}
