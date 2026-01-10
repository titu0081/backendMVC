<?php
require_once __DIR__ . '/../models/DBConection.php';
class Actor
{
    private $id_actor;
    private $name;
    private $surname;
    private $birthdate;
    private $nationality;

    public function __construct($idActor = null, $nameActor = null, $surnameActor = null, $birthdateActor = null, $nationalityActor = null)
    {
        if (!is_null($idActor)) {
            $this->id_actor = $idActor;
        }
        if (!is_null($nameActor)) {
            $this->name = $nameActor;
        }
        if (!is_null($surnameActor)) {
            $this->surname = $surnameActor;
        }
        if (!is_null($birthdateActor)) {
            $this->birthdate = $birthdateActor;
        }
        if (!is_null($nationalityActor)) {
            $this->nationality = $nationalityActor;
        }
    }

    public function getId_actor()
    {
        return $this->id_actor;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getBithdate()
    {
        return $this->birthdate;
    }

    public function getNationality()
    {
        return $this->nationality;
    }

    public function setId_actor($id_actor)
    {
        $this->id_actor = $id_actor;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function getAll()
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query('SELECT * FROM actors');
        $listData = [];

        foreach ($query as $item) {
            $itemObject = new Actor($item['id_actor'], $item['name'], $item['surname'], $item['birthdate'], $item['nationality']);
            array_push($listData, $itemObject);
            #$listData[]= $itemObject; Otra forma de introducirlo en el array
        }
        return $listData;
    }

    public function store()
    {
        $actorCreated = false;
        $mysqli = DBConection::getConection();

        if ($resultInsert = $mysqli->query("INSERT INTO actors (name, surname, birthdate, nationality) 
        VALUES ('$this->name', '$this->surname', '$this->birthdate', '$this->nationality')")) {
            $actorCreated = true;
        }

        return $actorCreated;
    }

    public function update()
    {
        $actorEdited = false;
        $mysqli = DBConection::getConection();

        if ($resultEdit = $mysqli->query("UPDATE actors set name = '" . $this->name .
            "', surname = '" . $this->surname . "', birthdate = '" . $this->birthdate . "', nationality = '" . $this->nationality .
            "' WHERE id_actor = " . $this->id_actor)) {
            $actorEdited = true;
        }

        return $actorEdited;
    }


    public function delete()
    {
        $actorDeleted = false;
        $mysqli = DBConection::getConection();

        if ($resultDelete = $mysqli->query("DELETE FROM actors WHERE id_actor = " . $this->id_actor)) {
            $actorDeleted = true;
        }

        return $actorDeleted;
    }

    public function getById($id)
    {
        $mysqli = DBConection::getConection();
        $query = $mysqli->query(
            "SELECT * FROM actors WHERE id_actor = " . (int)$id
        );
        $actor = null;
        if ($row = $query->fetch_assoc()) {
            $actor = new Actor($row['id_actor'], $row['name'], $row['surname'], $row['birthdate'], $row['nationality']);
        }
        return $actor;
    }
}
