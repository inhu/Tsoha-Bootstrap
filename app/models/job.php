<?php

class Job extends BaseModel {

    public $id, $player_id, $category_id, $name, $done,
            $description, $importance, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Job');
        $query->execute();
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
        $query = DB::connection()->prepare('INSERT INTO Job (name, description, importance, added) VALUES (:name, :description, :importance, NOW()) RETURNING id');
        $query->execute(array('name' => $this->name, 'description' => $this->description, 'importance' => $this->importance));
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

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors = 'Nimi ei saa olla tyhjä';
        }
        if (strlen($this->name) < 2) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
        }
    }

}
