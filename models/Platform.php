<?php
require_once __DIR__ . '/../models/DBConection.php';
class Platform
{
    private $id_platform;
    private $name;

    public function __construct($idPlatform = null, $namePlatform = null)
    {
        if (!is_null($idPlatform)) {
            $this->id_platform = $idPlatform;
        }
        if (!is_null($namePlatform)) {
            $this->name = $namePlatform;
        }
    }

    public function getId_platform()
    {
        return $this->id_platform;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId_platform($id_platform)
    {
        $this->id_platform = $id_platform;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAll()
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query('SELECT * FROM platforms');
        $listData = [];

        foreach ($query as $item) {
            $itemObject = new Platform($item['id_platform'], $item['name']);
            array_push($listData, $itemObject);
            #$listData[]= $itemObject; Otra forma de introducirlo en el array
        }
        return $listData;
    }

    public function store()
    {
        $platformCreated = false;
        $mysqli = DBConection::getConection();

        $checkQuery = "SELECT id_platform FROM platforms WHERE name = '" . $this->name . "' LIMIT 1";

        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            return false;
        }

        //Tarea: Comprobar que no existe otra plataforma con el mismo nombre
        if ($resultInsert = $mysqli->query("INSERT INTO platforms (name) VALUES ('$this->name')")) {
            $platformCreated = true;
        }

        return $platformCreated;
    }

    public function update()
    {
        $platformEdited = false;
        $mysqli = DBConection::getConection();

        if ($resultEdit = $mysqli->query("UPDATE platforms set name = '" . $this->name . "' WHERE id_platform = " . $this->id_platform)) {
            $platformEdited = true;
        }

        return $platformEdited;
    }

    public function delete()
    {
        $platformDeleted = false;
        $mysqli = DBConection::getConection();

        if ($resultDelete = $mysqli->query("DELETE FROM platforms WHERE id_platform = " . $this->id_platform)) {
            $platformDeleted = true;
        }

        return $platformDeleted;
    }

    //Funcion para obtener una plataforma por su ID
    public function getById($id)
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query(
            "SELECT * FROM platforms WHERE id_platform = " . (int)$id
        );

        $platform = null;

        if ($row = $query->fetch_assoc()) {
            $platform = new Platform($row['id_platform'], $row['name']);
        }

        return $platform;
    }
}
