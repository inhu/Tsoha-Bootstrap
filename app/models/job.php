<?php

class Job extends BaseModel {

    public $id, $player_id, $category_id, $name, $done,
            $description, $importance, $added;
    public $validators;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description', 'validate_importance');
    }

    public static function all() {
        $user = UserController::get_user_logged_in();
        if ($user == NULL)
            return;
        $query = DB::connection()->prepare('SELECT * FROM Job where player_id=:player_id');
        $query->execute(array('player_id' => $user->id));
        $rows = $query->fetchAll();
        $jobs = array();

        foreach ($rows as $row) {
            $jobs[] = new Job(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'category_id' => $row['category_id'],
                'name' => $row['name'],
                'done' => $row['done'],
                'description' => $row['description'],
                'importance' => $row['importance'],
                'added' => $row['added']
            ));
        }
        return $jobs;
    }

    public static function find($id) {
        $query = DB::connection()->prepare
                ('SELECT * FROM Job WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $job = new Job(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'category_id' => $row['category_id'],
                'name' => $row['name'],
                'done' => $row['done'],
                'description' => $row['description'],
                'importance' => $row['importance'],
                'added' => $row['added']
            ));
            return $job;
        }
        return null;
    }

    public function save() {
        $user = UserController::get_user_logged_in();
        $query = DB::connection()->prepare('INSERT INTO Job (name, description, importance, added, player_id) VALUES (:name, :description, :importance, NOW(), :player_id) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'importance' => $this->importance, 'player_id' => $user->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Job WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function done() {
        $query = DB::connection()->prepare('UPDATE Job SET done=TRUE WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('Update Job SET'
                . ' name=:name, description=:description, importance=:importance'
                . ' WHERE id = :id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'importance' => $this->importance, 'id' => $this->id));
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

    public function validate_description() {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            $errors[] = 'Kuvaus ei saa olla tyhjä';
        }
        return $errors;
    }

    public function validate_importance() {
        $errors = array();
        if (!is_numeric($this->importance)) {
            $errors[] = 'Tärkeyden on oltava numero';
        }
        return $errors;
    }

}
