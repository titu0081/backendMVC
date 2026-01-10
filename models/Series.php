<?php
require_once __DIR__ . '/../models/DBConection.php';

class Series
{
    private $id_series;
    private $title;
    private $id_platform;
    private $id_director;

    public function __construct($idSeries = null, $titleSeries = null, $idPlatformSeries = null, $idDirector = null,)
    {
        if (!is_null($idSeries)) {
            $this->id_series = $idSeries;
        }
        if (!is_null($titleSeries)) {
            $this->title = $titleSeries;
        }
        if (!is_null($idPlatformSeries)) {
            $this->id_platform = $idPlatformSeries;
        }
        if (!is_null($idPlatformSeries)) {
            $this->id_platform = $idPlatformSeries;
        }
        if (!is_null($idDirector)) {
            $this->id_director = $idDirector;
        }
    }

    public function getId_series()
    {
        return $this->id_series;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getId_platform()
    {
        return $this->id_platform;
    }
    public function getId_director()
    {
        return $this->id_director;
    }

    // CRUD
    public function getAll()
    {
        $mysqli = DBConection::getConection();

        $sql = "
        SELECT 
            s.id_series,
            s.title,
            p.name AS platform,
            CONCAT(d.name, ' ', d.surname) AS director,
            GROUP_CONCAT(DISTINCT CONCAT(a.name, ' ', a.surname) SEPARATOR ', ') AS actors,
            GROUP_CONCAT(DISTINCT l.name SEPARATOR ', ') AS languages
        FROM series s
        INNER JOIN platforms p ON p.id_platform = s.id_platform
        INNER JOIN directors d ON d.id_director = s.id_director

        LEFT JOIN series_actor sa ON sa.id_series = s.id_series
        LEFT JOIN actors a ON a.id_actor = sa.id_actor

        LEFT JOIN series_language sl ON sl.id_series = s.id_series
        LEFT JOIN languages l ON l.id_language = sl.id_language

        GROUP BY s.id_series
        ";

        $query = $mysqli->query($sql);

        $data = [];

        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    public function store()
    {
        $seriesCreated = false;
        $mysqli = DBConection::getConection();

        $checkQuery = "SELECT id_series FROM series WHERE title = '" . $this->title . "' LIMIT 1";

        $checkResult = $mysqli->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            return false;
        }

        if ($resultInsert = $mysqli->query("INSERT INTO series (title, id_platform, id_director) VALUES ('$this->title', '$this->id_platform', '$this->id_director')")) {
            $seriesCreated = true;
        }

        return $seriesCreated;
    }

    public function update()
    {
        $mysqli = DBConection::getConection();

        $sql = "
            UPDATE series SET 
                title = '$this->title',
                id_platform = $this->id_platform,
                id_director = $this->id_director
            WHERE id_series = $this->id_series
        ";

        return $mysqli->query($sql);
    }

    public function delete()
    {
        $mysqli = DBConection::getConection();

        // Primero borrar relaciones
        $mysqli->query("DELETE FROM series_actor WHERE id_series = $this->id_series");
        $mysqli->query("DELETE FROM series_language WHERE id_series = $this->id_series");

        return $mysqli->query("DELETE FROM series WHERE id_series = $this->id_series");
    }

    public function getById($id)
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query("SELECT * FROM series WHERE id_series = " . (int)$id);

        if ($row = $query->fetch_assoc()) {
            return new Series(
                $row['id_series'],
                $row['title'],
                $row['id_platform'],
                $row['id_director']
            );
        }

        return null;
    }

    public function getActorsBySeries($idSeries)
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query("SELECT id_actor FROM series_actor WHERE id_series = " . (int)$idSeries);

        $actors = [];

        while ($row = $query->fetch_assoc()) {
            $actors[] = $row['id_actor'];
        }

        return $actors;
    }

    public function getLanguagesBySeries($idSeries)
    {
        $mysqli = DBConection::getConection();

        $query = $mysqli->query("SELECT id_language FROM series_language WHERE id_series = " . (int)$idSeries);

        $languages = [];

        while ($row = $query->fetch_assoc()) {
            $languages[] = $row['id_language'];
        }

        return $languages;
    }
}
